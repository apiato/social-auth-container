<?php

return [

    /*
     * This container already provides 3 provider. You can implement and add your SocialAuthProvider here.
     *
     * The class you want to use as a SocialAuthProvider needs to implement the
     * `App\Containers\SocialAuth\Contracts\SocialAuthProvider` contract.
     */

    'providers' => [
        'google' => App\Containers\SocialAuth\SocialAuthProviders\GoogleSocialAuthProvider::class,
        'facebook' => App\Containers\SocialAuth\SocialAuthProviders\FacebookSocialAuthProvider::class,
        'twitter' => App\Containers\SocialAuth\SocialAuthProviders\TwitterSocialAuthProvider::class,
    ],
];
