<?php

/**
 * @apiGroup           SocialAuth
 * @apiName            socialAuthCallback
 * @api                {get} /v1/auth/{provider}/redirect Auth Callback
 * @apiDescription     This route is for receiving the callback from the provider after authentication
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 */

use App\Containers\Vendor\SocialAuth\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('auth/{provider}/callback', [Controller::class, 'callback'])
    ->name('web_socialAuth_callback');
