
# COVID Vaccine Registration System

## Overview


This project is a COVID Vaccine Registration System developed using Laravel. The application allows users to register for vaccination, select a vaccine center, and schedule their vaccination based on availability. It follows a first-come, first-served approach, ensuring vaccinations are scheduled only for weekdays (Sunday to Thursday).



## Features

- **User registration with NID for vaccination.**
- **Selection of a vaccine center (with a daily capacity limit per center).**
- **Scheduling based on first-come, first-served for weekdays.**
- **Notifications sent via email at 9 PM on the night before the scheduled vaccination date.**
- **Status search page (for viewing registration, scheduling, and vaccination statuses).**
- **Efficient handling of center capacity limits.**
- **Unit tests to ensure functionality.**


## Technologies Used

- **Backend: PHP 8, Laravel 10**
- **Frontend:Blade,Tailwind CSS**
- **Build Tool: Vite (for building assets)**
- **Database: MySQL**
- **Testing: PHPUnit**


## Prerequisites

- **PHP ^8.2**
- **Laravel ^11.9**
- **Composer**
- **Node.js and npm**
- **MySQL**

## Installation

1.Clone the repository:

        git clone https://github.com/AmadulHaque/Laravel-covid-vaccine-registration-system 

cd Laravel-covid-vaccine-registration-system


2.Install PHP dependencies:

        composer install


3.Install Node.js dependencies:

        npm install

4.Copy the .env.example to .env:

        cp .env.example .env

5.Set up your environment variables in .env, including:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database
        DB_USERNAME=your_username
        DB_PASSWORD=your_password
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=your_mailtrap_username
        MAIL_PASSWORD=your_mailtrap_password

6.Generate application key:

        php artisan key:generate

7.Run migrations and seed the database:

        php artisan migrate --seed

The seeders will populate the database with initial vaccine centers.

## Running the Application

1.Build front-end assets using Vite:

        npm run build

2.Start the Laravel development server:

        php artisan serve

By default, the app will run on http://localhost:8000.


## Usage
### Registration

- **Visit http://localhost:8000/registration to register for the vaccine.**
- **Users must provide their name, email, and NID, and select a vaccine center.**

### Check Status

- **Go to http://localhost:8000/status to check your vaccination status using your NID.**

### Email Notification System

The application includes an email notification system to notify users about their scheduled vaccination appointment.

#### How It Works

- **A Laravel command (vaccine:send-reminder-emails) is scheduled to run every day at 9 PM. This command sends an email reminder to all users who are scheduled for vaccination the following day.**

- **The email contains the user's name, vaccine center details, and the scheduled date.**

### Set Up the Cron Job

Ensure the Laravel scheduler is running on your server. Add this to your crontab:

        * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

### Testing the Command
You can manually run the command to test it before scheduling it:

        php artisan vaccine:send-reminder-emails 


## Future Improvements: Adding SMS Notifications

### Install an SMS Provider SDK:

We would need to integrate an SMS service provider like Twilio, Nexmo, or Plivo. Install the appropriate package via Composer:

            composer require twilio/sdk


### Create an SMS Notification Service:

    A new service class would be created to handle sending SMS messages. This would follow the same structure as our email service (e.g., VaccineEmail),



### Testing

We have written unit tests to ensure the system works as expected. You can run the tests using the following command:

        php artisan test

### Sample tests include:

- **Ensuring users can't register twice.**
- **Handling cases where a vaccine center is full.**
- **Ensuring scheduling respects weekday-only scheduling.**