<?php

namespace Apiato\Containers\SocialAuth\Contracts;

interface SocialAuthProvider
{
    public function getUser();
}
