<?php

use App\UseCases\SendPostNotificationUseCase;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('notify', function () {

    $useCase = app(SendPostNotificationUseCase::class);

    $useCase->execute([]);

});
