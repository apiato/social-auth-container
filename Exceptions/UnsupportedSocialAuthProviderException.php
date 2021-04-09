<?php

namespace App\Containers\VendorSection\SocialAuth\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UnsupportedSocialAuthProviderException extends Exception
{
	protected $code = Response::HTTP_NOT_ACCEPTABLE;
	protected $message = 'Unsupported Social Auth Provider.';
}
