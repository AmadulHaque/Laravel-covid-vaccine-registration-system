<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VaccineCenter;
use App\Services\VaccineService;
use App\Http\Requests\VaccineRegisterRequest;

class VaccineController extends Controller
{
    protected $vaccineService;

    public function __construct(VaccineService $vaccineService)
    {
        $this->vaccineService = $vaccineService;
    }


    public function showRegistrationForm()
    {
        $centers = VaccineCenter::all();
        return view('vaccine.register', compact('centers'));
    }

    
    public function register(VaccineRegisterRequest $request)
    {
        $userData = $request->validated();
        $centerId = $request->center_id;
        unset($userData['center_id']);

        $user = $this->vaccineService->registerUser($userData, $centerId);
        if ($user) {
            return redirect()->route('vaccine.status', ['nid' => $user->nid])
                                ->with('message', 'Registration successful! Check your vaccination status.');
        } else {
            return redirect()->back()->withErrors(['registration' => 'Registration failed. Please try again.']);
        }
    }



    public function checkStatus(Request $request)
    {
        $nid = $request->nid;
        $user = User::with('registration')->where('nid', $nid)->first();

        if (!$user) {
            return view('vaccine.status', ['status' => 'Not registered']);
        }

        return view('vaccine.status', [
            'status' => $user->registration->status,
            'scheduledDate' => optional($user->registration)->scheduled_date,
        ]);
    }


}