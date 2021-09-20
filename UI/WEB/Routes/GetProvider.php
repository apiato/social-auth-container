<?php

/**
 * @apiGroup           SocialAuth
 * @apiName            socialAuthAll
 * @api                {post} /v1/auth/{provider} Auth for all Providers
 * @apiDescription     Test endpoint to get the social auth token
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 */

use App\Containers\Vendor\SocialAuth\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('auth/{provider}', [Controller::class, 'redirectAll'])
    ->name('web_socialAuth_redirect');

