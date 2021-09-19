<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\AppSection\User\Models\User;
use Apiato\Core\Abstracts\Tasks\Task;
use Laravel\Passport\PersonalAccessTokenResult;

class ApiLoginFromUserTask extends Task
{
    public function run(User $user): PersonalAccessTokenResult
    {
        return $user->createToken('social');
    }
}
