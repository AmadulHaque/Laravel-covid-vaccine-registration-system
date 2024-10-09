<?php


namespace App\Traits;

use App\Models\Registration;
use Carbon\Carbon;

trait VaccineScheduler
{

    public function getNextAvailableDate($center)
    {
        $lastScheduled = Registration::where('vaccine_center_id', $center->id)
            ->orderBy('scheduled_date', 'desc')
            ->first();

        $nextDate = [
            'status' => 'ok',
            'date'   => now()->nextWeekday()
        ];
        
        if ($lastScheduled) {
            $nextDate = $this->calculateNextDate($lastScheduled, $center);
        }

        return $nextDate;
    }


    private function calculateNextDate($lastScheduled, $center)
    {
        $date = Carbon::parse($lastScheduled->scheduled_date);
        $countOnDate = Registration::where('vaccine_center_id', $center->id)
            ->whereDate('scheduled_date','2024-10-10')
            ->count();

        if ($countOnDate >= $center->daily_limit) {
            return [
                'status' => 'full',
                'date'   =>  null
            ]; 
        }
        return [
            'status' => 'ok',
            'date'   => $date->toDateString()
        ]; 
    }
}
