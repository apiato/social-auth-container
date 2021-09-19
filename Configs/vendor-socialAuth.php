<?php

return [

    /*
     * This container already provides 3 provider. You can implement and add your SocialAuthProvider here.
     *
     * The class you want to use as a SocialAuthProvider needs to implement the
     * `Apiato\Containers\SocialAuth\Contracts\SocialAuthProvider` contract.
     */

    'providers' => [
        'google' => Apiato\Containers\SocialAuth\SocialAuthProviders\GoogleSocialAuthProvider::class,
        'facebook' => Apiato\Containers\SocialAuth\SocialAuthProviders\FacebookSocialAuthProvider::class,
        'twitter' => Apiato\Containers\SocialAuth\SocialAuthProviders\TwitterSocialAuthProvider::class,
    ]
];
