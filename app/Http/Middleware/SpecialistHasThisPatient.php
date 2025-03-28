<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SpecialistHasThisPatient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $specialist = Auth::guard('specialist')->user();
        $patient_id = $request->route('patient_id');
        // return response()->json($patient_id);
        $hasPatient  = $specialist->patients()->where('patients.id', $patient_id)->exists();
        if (!$hasPatient) {
            return response()->json(["message" => "No Access to this patient"]);
        }
        return $next($request);
    }
}
