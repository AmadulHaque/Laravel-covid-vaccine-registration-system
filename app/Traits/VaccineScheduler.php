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

        $nextDate = now()->nextWeekday();

        if ($lastScheduled) {
            $nextDate = $this->calculateNextDate($lastScheduled, $center);
        }

        return $nextDate;
    }


    private function calculateNextDate($lastScheduled, $center)
    {
        $date = Carbon::parse($lastScheduled->scheduled_date);
        $countOnDate = Registration::where('vaccine_center_id', $center->id)
            ->where('scheduled_date', $date->toDateString())
            ->count();

        if ($countOnDate >= $center->daily_limit) {
            $date = $date->nextWeekday();
        }

        return $date->toDateString();
    }
}
