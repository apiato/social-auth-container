<?php

namespace App\Containers\Vendor\SocialAuth\Tasks;

use App\Containers\Vendor\SocialAuth\Exceptions\UpdateResourceFailedException;
use Apiato\Core\Abstracts\Tasks\Task;

class UpdateUserSocialProfileTask extends Task
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(config('vendor-socialAuth.user.repository'));
    }

    /**
     * @throws UpdateResourceFailedException
     */
    public function run(
        $userId,
        $token = null,
        $expiresIn = null,
        $refreshToken = null,
        $tokenSecret = null,
        $avatar = null,
        $avatar_original = null,
        $provider = null,
        $socialId = null,
        $nickname = null,
        $name = null,
        $email = null
    )
    {
        $attributes = [];

        if ($token) {
            $attributes['social_token'] = $token;
        }

        if ($expiresIn) {
            $attributes['social_expires_in'] = $expiresIn;
        }

        if ($refreshToken) {
            $attributes['social_refresh_token'] = $refreshToken;
        }

        if ($tokenSecret) {
            $attributes['social_token_secret'] = $tokenSecret;
        }

        if ($provider) {
            $attributes['social_provider'] = $provider;
        }

        if ($avatar) {
            $attributes['social_avatar'] = $avatar;
        }

        if ($avatar_original) {
            $attributes['social_avatar_original'] = $avatar_original;
        }

        if ($socialId) {
            $attributes['social_id'] = $socialId;
        }

        if ($nickname) {
            $attributes['social_nickname'] = $nickname;
        }

        if ($name) {
            $attributes['name'] = $name;
        }

        if ($email) {
            $attributes['email'] = $email;
        }

        if (empty($attributes)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        return $this->repository->update($attributes, $userId);
    }
}
