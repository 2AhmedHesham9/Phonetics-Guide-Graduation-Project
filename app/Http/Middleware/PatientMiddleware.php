<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PatientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::guard('patient');
        if (!$auth->check()) {
            return Response()->json(['message' => 'Unauthorized'], 401);
        }


        if ($auth->user()->role !== 'patient') {
            // Log::warning('Unauthorized access attempt by user: ' .  $auth->user()->email);
            return response()->json(['message' => 'Forbidden: Only patients can access this resource'], 403);
        }
        return $next($request);
    }
}
