<?php

namespace App\Containers\Vendor\SocialAuth\SocialAuthProviders;

use App\Containers\Vendor\SocialAuth\Abstracts\SocialAuthProvider;
use Laravel\Socialite\Facades\Socialite;

class TwitterSocialAuthProvider extends SocialAuthProvider
{
    public function getUser()
    {
        return Socialite::driver($this->request->provider)->stateless()->userFromTokenAndSecret($this->request->oauth_token, $this->request->oauth_secret);
    }
}
