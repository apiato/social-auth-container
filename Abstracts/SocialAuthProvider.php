<?php

namespace Apiato\Containers\SocialAuth\Abstracts;

use Apiato\Containers\SocialAuth\Contracts\SocialAuthProvider as SocialAuthProviderContract;
use Apiato\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
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
