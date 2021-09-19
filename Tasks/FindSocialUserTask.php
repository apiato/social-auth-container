<?php

namespace Apiato\Containers\SocialAuth\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use Apiato\Core\Abstracts\Tasks\Task;

class FindSocialUserTask extends Task
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($socialProvider, $socialId)
    {
        return $this->repository->findWhere([
            'social_provider' => $socialProvider,
            'social_id' => $socialId,
        ])->first();
    }
}
