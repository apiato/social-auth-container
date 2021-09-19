<?php

namespace App\Containers\Vendor\SocialAuth\Contracts;

interface SocialAuthProvider
{
    public function getUser();
}
