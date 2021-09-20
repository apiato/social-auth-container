<?php

namespace App\Containers\Vendor\SocialAuth\UI\WEB\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Controller extends WebController
{
    public function redirect($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider): User
    {
        return Socialite::driver($provider)->user();
    }
}
