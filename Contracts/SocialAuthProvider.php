<?php

namespace App\Containers\SocialAuth\Contracts;

interface SocialAuthProvider
{
    public function getUser();
}
