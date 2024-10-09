<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\VaccineCenter;
use App\Models\Registration;
use App\Services\VaccineService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Carbon\Carbon;

class VaccineServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $vaccineService;

    public function setUp(): void
    {
        parent::setUp();
        $this->vaccineService = app(VaccineService::class);
    }


    public function test_register_user_successfully()
    {
        // Arrange: Create a vaccine center
        $center = VaccineCenter::create(['name' => 'Immunization Center','daily_limit' => 50]);

        # Prepare user data
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'nid' => '1234567890',
        ];

        # Act: Register the user
        $user = $this->vaccineService->registerUser($userData, $center->id);

        # Assert: Check user and registration created successfully
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $this->assertDatabaseHas('registrations', ['user_id' => $user->id, 'vaccine_center_id' => $center->id]);

    }

 
    public function test_registration_fails_if_center_is_full()
    {
        // Arrange: Create a vaccine center
        $center = VaccineCenter::create(['name' => 'Immunization Center','daily_limit' => 1]);

        // Prepare user data
        $userDataOne = [
            'name'  => 'Halim Islam',
            'email' => 'halim@test.com',
            'nid'   => '1234567891',
        ];

        $userDataTwo = [
            'name'  => 'Karim islam',
            'email' => 'karim@test.com',
            'nid'   => '1234567892',
        ];

        // Act: Register the first user (This should succeed)
        $userOne = $this->vaccineService->registerUser($userDataOne, $center->id);

        // Act: Register the second user after the capacity is reached
        $userTwo = $this->vaccineService->registerUser($userDataTwo, $center->id);
        

        // Assert: First user should be successfully scheduled
        $this->assertInstanceOf(User::class, $userOne);
        $this->assertDatabaseHas('registrations', [
            'user_id'           => $userOne->id,
            'vaccine_center_id' => $center->id,
            'status'            => VACCINE_STATUS_ID['Scheduled'],
            'scheduled_date'    => Carbon::now()->nextWeekday()->toDateString(),
        ]);


       // Assert: Second user should be be Not Scheduled
        $this->assertInstanceOf(User::class, $userTwo);
        $this->assertDatabaseHas('registrations', [
            'user_id'           => $userTwo->id,
            'vaccine_center_id' => $center->id,
            'status'            => VACCINE_STATUS_ID['Not scheduled'],
            'scheduled_date'    => null,
        ]);

    }


    public function test_registration_status_check()
    {
        // Arrange: Create a vaccine center
        $center = VaccineCenter::create(['name' => 'Immunization Center','daily_limit' => 50]);

        // Prepare user data
        $userData = [
            'name' => 'AmadulHaque',
            'email' => 'amadul@test.com',
            'nid' => '1234567891',
        ];

       # Act: Register the user
       $user = $this->vaccineService->registerUser($userData, $center->id);


        # Assert: Check user and registration created successfully
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['email' => 'amadul@test.com']);
        $this->assertDatabaseHas('registrations', [
            'user_id' => $user->id, 
            'vaccine_center_id' => $center->id,  
            'status' => VACCINE_STATUS_ID['Scheduled']
        ]);

    }


}
