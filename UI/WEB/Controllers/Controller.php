<?php

namespace Apiato\Containers\SocialAuth\UI\WEB\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Controller extends WebController
{
    public function redirectAll($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallbackAll($provider): User
    {
        return Socialite::driver($provider)->user();
    }
}
