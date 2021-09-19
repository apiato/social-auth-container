<?php

namespace App\Containers\SocialAuth\Abstracts;

use App\Containers\SocialAuth\Contracts\SocialAuthProvider as SocialAuthProviderContract;
use App\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use Laravel\Socialite\Facades\Socialite;

abstract class SocialAuthProvider implements SocialAuthProviderContract
{
    public function __construct(
        protected ApiAuthenticateRequest $request
    ) {
    }

    public function getUser()
    {
        return Socialite::driver($this->request->provider)->stateless()->userFromToken($this->request->oauth_token);
    }
}
