<?php

namespace App\Containers\Vendor\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use Laravel\Passport\PersonalAccessTokenResult;

class ApiLoginFromUserTask extends Task
{
    public function run($user): PersonalAccessTokenResult
    {
        return $user->createToken('social');
    }
}
