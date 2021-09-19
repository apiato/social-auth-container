<?php

namespace Apiato\Containers\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use Apiato\Containers\SocialAuth\Contracts\SocialAuthProvider;

class FindUserSocialProfileTask extends Task
{
    public function run(SocialAuthProvider $provider)
    {
        return $provider->getUser();
    }
}
