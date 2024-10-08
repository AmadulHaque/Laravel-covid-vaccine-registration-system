<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Registration;
use App\Models\VaccineCenter;
use App\Traits\VaccineScheduler;
use Illuminate\Support\Facades\DB;

class VaccineService
{
    use VaccineScheduler;


    public function registerUser($userData, $centerId)
    {
        try {
            return DB::transaction(function () use ($userData, $centerId) {

                $user = User::create($userData);

                $center = VaccineCenter::findOrFail($centerId);
                $scheduledDate = $this->getNextAvailableDate($center);
        
                Registration::create([
                    'user_id'           => $user->id,
                    'vaccine_center_id' => $center->id,
                    'scheduled_date'    => $scheduledDate,
                    'status'            => 3,
                ]);
        
                return $user;
            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
