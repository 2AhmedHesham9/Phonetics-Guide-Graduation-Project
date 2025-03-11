<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\PatientSpecialist;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class ActivePatientWithSpecialist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $patient_specialsit = Patient::with('specialist')->select('id')->where('specified_id', $request->specified_id)->first();


        $response = PatientSpecialist::select('status', 'specialist_id')->where('patient_id', '=', $patient_specialsit->id)->first();

        if (Auth::guard('specialist')->user()->id == $response->specialist_id) {

            return Response()->json("Patient already with You");
        }
        if ($response->status == 'active') {

            return Response()->json(
                "already with a Specialist u can not add him before cancel with the old"
            );
        }
        return $next($request);
    }
}
