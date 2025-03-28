<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::guard('admin');
        if (!$auth->check()) {
            return Response()->json(['message' => 'Unauthorized'], 401);
        }


        if ($auth->user()->role !== 'admin') {
            // Log::warning('Unauthorized access attempt by user: ' .  $auth->user()->email);
            return response()->json(['message' => 'Forbidden: Only admins can access this resource'], 403);
        }
        return $next($request);
    }
}
