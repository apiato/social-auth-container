<?php

use App\Containers\Vendor\SocialAuth\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('auth/{provider}/callback', [Controller::class, 'handleCallbackAll'])
    ->name('web_socialAuth_callback');
