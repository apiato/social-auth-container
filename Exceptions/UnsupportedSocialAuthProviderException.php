<?php

namespace App\Containers\Vendor\SocialAuth\Exceptions;

use Apiato\Core\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UnsupportedSocialAuthProviderException extends Exception
{
	protected $code = Response::HTTP_NOT_ACCEPTABLE;
	protected $message = 'Unsupported Social Auth Provider.';
}
