<?php

/**
 * @apiGroup           SocialAuth
 * @apiName            socialAuthAll
 * @api                {post} /v1/auth/{provider} Auth for all Providers
 * @apiDescription     After getting the User Access Token from the provider (e.g. Google), call this Endpoint like this
 * `/v1/auth/google` passing the access token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           oauth_token  token provided by the social provider
 * @apiParam           [oauth_secret] some providers like Twitter provide this
 *
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK
{
    // here we will return a User transformer response
    // you can set the transformer in vendor-socialAuth config (you have to publish it first -> vendor:publish)
}
 */

use App\Containers\Vendor\SocialAuth\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('auth/{provider}', [Controller::class, 'authenticateAll'])->name('api_socialAuth_social_auth');
