<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('queue:work --stop-when-empty')->everyMinute();
Schedule::command('attachments:clean portfolio')->weekly();
Schedule::command('attachments:clean service')->weekly();
Schedule::command('attachments:clean proposal')->weekly();
Schedule::command('attachments:clean project')->weekly();
Schedule::command('invitations:cleanup')->daily();
