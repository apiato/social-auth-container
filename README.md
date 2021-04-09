# [Apiato](https://github.com/apiato/apiato) Social Authentication Container

An Apiato container which adds social authentication functionality using Laravel
Socialite



- [Installation](#installation)
- [Default Supported Auth Provide](#default-supported-auth-provide)
- [How Social Authentication Works](#how-social-authentication-works)
- [Setup Social Authentication](#Setup-Social-Authentication)
- [Support new Auth Provide](#support-new-auth-provide)

Under the hood this container uses [Laravel Socialite](https://github.com/laravel/socialite).

<a name="installation"></a>

## Installation

Add this to your  `app/composer.json` then run `composer update`

```
"mohammad-alavi/apiato-social-auth": "^2.0.0"
```
Now run `php artisan migrate`

And optionally add this to your user transformer to add social auth fields to your user repsonses:
```php
'social_auth_provider' => $user->social_provider,
    'social_nickname' => $user->social_nickname,
    'social_id' => $user->social_id,
    'social_avatar' => [
        'avatar' => $user->social_avatar,
        'original' => $user->social_avatar_original,
```


<a name="default-supported-auth-provide"></a>

## Default Supported Auth Provide

* Google
* Facebook
* Twitter

<a name="how-social-authentication-works"></a>

## How Social Authentication Works

1. The Client (Mobile or Web) sends a request to the Social Auth Provider (Facebook, Twitter..).
2. The Social Auth Provider returns a Code (Tokens).
3. The Client makes a call to the server (our server) and passes the Code (Tokens) retrieved from the Provider.
4. The Server fetches the user data from the Social Auth Provider using the received Code (Tokens).
5. The Server create new User from the collected social data and return the Authenticated User (If the user already
   created then it just returns it).

<a name="Setup-Social-Authentication"></a>

## Setup Social Authentication

1) Create an App on the supported Social Auth provider.

- For Facebook: [https://developers.facebook.com/apps](https://developers.facebook.com/apps)
- For Twitter: [https://apps.twitter.com/app](https://apps.twitter.com/app)
- For
  Google: [https://console.developers.google.com/apis/credentials](https://console.developers.google.com/apis/credentials)

For the callback URL you can use this Apiato web endpoint `http://apiato.test/auth/{provider}/callback` *(replace the
provider with any of the supported providers `facebook`, `twitter`,..)*.

2) Set the Tokens and Secrets in the `.env` file

```php
    'facebook' => [
        'client_id'     => env('AUTH_FACEBOOK_CLIENT_ID'), // App ID
        'client_secret' => env('AUTH_FACEBOOK_CLIENT_SECRET'), // App Secret
        'redirect'      => env('AUTH_FACEBOOK_CLIENT_REDIRECT'),
    ],

    'twitter' => [
        'client_id'     => env('AUTH_TWITTER_CLIENT_ID'), // Consumer Key (API Key)
        'client_secret' => env('AUTH_TWITTER_CLIENT_SECRET'), // Consumer Secret (API Secret)
        'redirect'      => env('AUTH_TWITTER_CLIENT_REDIRECT'),
    ],

    'google' => [
        'client_id'     => env('AUTH_GOOGLE_CLIENT_ID'), // Client ID
        'client_secret' => env('AUTH_GOOGLE_CLIENT_SECRET'), // Client secret
        'redirect'      => env('AUTH_GOOGLE_CLIENT_REDIRECT'),
    ],
```

3) Make a request from your client to get the `oauth` info. **Each Social provider returns different response and keys**

For testing purposes Apiato provides a web endpoint (`http://apiato.test/auth/{provider}` ) to act as a client.

Use that endpoint from your browser *(replace the provider with any of the supported providers `facebook`, `twitter`
,..)* to get the `oauth` info.

Example Twitter Response:

```text
User {
  tokentoken: "121212121-121212121"
  tokentokenSecret: "34343434343434343343434343"
  tokenid: "777777777"
  tokennickname: "Mahmoud_Zalt"
  tokenname: "Mahmoud Zalt"
  tokenemail: null
  tokenavatar: "http://pbs.twimg.com/profile_images/88888888/PENrcePC_normal.jpg"
  tokenuser:
  token"avatar_original": "http://pbs.twimg.com/profile_images/9999999/PENrcePC.jpg"
}
```

NOTE: This step should be done by your client App, which could be a Web, Mobile or other kind of client Apps.

4) Use the `oauth` info to make a call from your server to the Social Provider in order to get the User info.

Example Getting Twitter User: **Twitter requires the `oauth_token` and `oauth_secret`, other Providers might only
require the `oauth_token`**

```text
POST /v1/auth/twitter HTTP/1.1
Host: api.apiato.test
Content-Type: application/x-www-form-urlencoded
Accept: application/json

oauth_token=121212121-121212121&oauth_secret=34343434343434343343434343
```

Note: For Facebook send only the `oauth_token` which is named as `access_token` in the facebook response. For more
details about the parameters checkout the generated documentation or
visit `app/Containers/VendorSection/Socialauth/UI/API/Routes/AuthenticateAll.v1.private.php`

5) The endpoint above should return the User and his Personal Access Token.

Example Twitter Response:

```json
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
```

<a name="support-new-auth-provide"></a>

## Support new Auth Provider

1) Copy the container from `VendorSection` to a section of your project and fix the namespaces.
2) Pick an Auth Provider from the supported providers by [Socialite](https://socialiteproviders.github.io/).
2) Go to `app/Containers/YourSection/Socialauth/Tasks/FindUserSocialProfileTask.php` and support your provider.
