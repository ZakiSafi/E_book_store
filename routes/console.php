<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Schedule the command to run daily
Artisan::command('schedule:run', function (Schedule $schedule) {
    $schedule->command('app:check-overdue-books')->daily();
});
