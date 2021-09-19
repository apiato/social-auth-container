<?php

/**
 * @apiGroup           SocialAuth
 * @apiName            socialAuthAll
 * @api                {post} /v1/auth/{provider} Auth for all Providers
 * @apiDescription     After getting the User Token from provider (e.g. google), call this Endpoint like this `/v1/auth/google`
 * passing the user token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 * For testing purposes use this endpoint `auth/google` to get the token.
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
"data": {
"object": "User",
"id": "YJ5evQ20Jyzx68dK",
"name": "Mohammad Alavi",
"email": "mohammad.alavi1990@gmail.com",
"confirmed": null,
"nickname": null,
"gender": null,
"birth": null,
"social_auth_provider": "google",
"social_id": "113834952367767922133",
"social_avatar": {
"avatar": "https:\/\/lh6.googleusercontent.com\/-OSItz6IHbSw\/AAAAAAAAAAI\/AAAAAAAAAAA\/AMZuucltEs_yNz42qhe1FCJmhG4cm5m-_A\/s96-c\/photo.jpg",
"original": "https:\/\/lh6.googleusercontent.com\/-OSItz6IHbSw\/AAAAAAAAAAI\/AAAAAAAAAAA\/AMZuucltEs_yNz42qhe1FCJmhG4cm5m-_A\/s96-c\/photo.jpg"
},
"created_at": "2021-03-31T06:37:28.000000Z",
"updated_at": "2021-03-31T06:37:28.000000Z",
"readable_created_at": "1 second ago",
"readable_updated_at": "1 second ago"
},
"meta": {
"include": [
"roles"
],
"custom": {
"token_type": "personal",
"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDE1YmY3ZTNmNWNkNWMzYzc4MDEyMjg1YWJmOTc0OWYyY2U1MDA2N2RkMzRkNGMzNDg5MDc5YTcyN2IwM2I4MzVhYjk4NGYzNTA1NWI5ZWQiLCJpYXQiOjE2MTcxNzI2NDkuMDM1NjI2LCJuYmYiOjE2MTcxNzI2NDkuMDM1NjMzLCJleHAiOjE2NDg3MDg2NDkuMDA3NjY2LCJzdWIiOiI3OSIsInNjb3BlcyI6W119.RBX2_q2SEyMBjk7-LKnZ1aLbvpGPbWvF20M5Ti2CGXX8Jj_QPev7VOWEJOTQ826FOraGvEl2fJn7y2qo-1mTk0Jm_ut_4M03sz0dRsi-DnS7ifupvlzKL6epUoI6Nt_2wmuT6jMx1Z2SpcqEOwVxchca2phi2juo5hLdEkN65lw0w7l3mhvWtOHkF1jqyNTlMRXBKrdna56YTRupbG5ye5wWh7g0FsQgJpPZEXtH3zP_dp-UUguTAzNDUBG6PDk7_Mts4pMH1JX4gARm0tEyOU9fXVSVF8Ewk_uKlxtoDbod6FZMct6A5zQuVsXf5P2rVxOaIjEb5neFSjJyQAHZcTBdPmMGCx-UDk14ARZQlPjogpuiEOcNL-xJqqkndlmEPWYUtuy0MfI1qzdrkt69QvmCOx7L8J8o9EXlfmZdbpZKtQ0BXW_7ZyweNdJq5x6zR0FZsHMC3A_PV9zzgK43tciA2fxbcWixXC8uP-BvUyv1tdvYtLTtGo-_edVQMIA-8tDqmJfqKx18A7jW75t4yQZlNXq6gEos9q3etfK0KNg3Nys-mYG7Z0RhrafYCNx53qipJ_6zroXdRo3c-ZappXeUn5pqwBse7eOvbtsIondp_uH_C0YzUUXQJPjfAv_q4PPdslvCKqCo3sHPfkzIlGoiCjp6a-rjN5Yr4I7P2pc"
}
}
}
 */

use App\Containers\Vendor\SocialAuth\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('auth/{provider}', [Controller::class, 'authenticateAll'])->name('api_socialAuth_social_auth');
