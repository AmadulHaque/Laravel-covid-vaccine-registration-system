<?php

namespace App\Console\Commands;

use Carbon\Carbon; 
use App\Mail\VaccineEmail;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class VaccineReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:send-reminder-emails ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $registrations = Registration::with('user')
            ->where('scheduled_date', $tomorrow)
            ->where('status', VACCINE_STATUS_ID['Scheduled'])
            ->get();

    
    
        foreach ($registrations as $registration) {
            $user = $registration->user;
            $center = $registration->vaccineCenter;
            Mail::to($user->email)->send(new VaccineEmail($user, $center, $registration->scheduled_date));
            $this->info('Reminder email sent to: ' . $user->email);
        }
        
    }
}
