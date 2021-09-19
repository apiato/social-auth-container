<?php

namespace App\Containers\Vendor\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\Vendor\SocialAuth\Contracts\SocialAuthProvider;

class FindUserSocialProfileTask extends Task
{
    public function run(SocialAuthProvider $provider)
    {
        return $provider->getUser();
    }
}
