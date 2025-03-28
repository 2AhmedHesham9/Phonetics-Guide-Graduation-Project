<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottleRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 60, $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return $this->buildTooManyAttemptsResponse($key, $maxAttempts, $decayMinutes);
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        $response = $next($request);

        return $this->addHeaders(
            $response,
            $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts)
        );
    }

    /**
     * Resolve request signature.
     */
    protected function resolveRequestSignature(Request $request)
    {
        return sha1(
            $request->method() .
                '|' . $request->server('SERVER_NAME') .
                '|' . $request->path() .
                '|' . $request->ip()
        );
    }

    /**
     * Create a 'too many attempts' response.
     */
    protected function buildTooManyAttemptsResponse($key, $maxAttempts, $decayMinutes)
    {
        $retryAfter = RateLimiter::availableIn($key);

        return response()->json([
            'message' => 'Too many login attempts. Please try again in ' . ceil($retryAfter / 60) . ' minute(s).',
            'retry_after' => $retryAfter,
            // 'attempts_remaining' => 0
        ], 429);
    }

    /**
     * Add the limit header information to the response.
     */
    protected function addHeaders(Response $response, $maxAttempts, $remainingAttempts)
    {
        $response->headers->add([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
        ]);

        return $response;
    }

    /**
     * Calculate the number of remaining attempts.
     */
    protected function calculateRemainingAttempts($key, $maxAttempts)
    {
        return max(0, $maxAttempts - RateLimiter::attempts($key));
    }
}
