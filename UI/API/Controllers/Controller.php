<?php

namespace App\Containers\VendorSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Containers\VendorSection\SocialAuth\Actions\SocialLoginAction;
use App\Containers\VendorSection\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use App\Ship\Parents\Controllers\ApiController;

class Controller extends ApiController
{
	public function authenticateAll(ApiAuthenticateRequest $request): array
	{
		$data = Apiato::call(SocialLoginAction::class, [$request]);

		return $this->transform($data['user'], UserTransformer::class, [], [
			'token_type' => 'personal',
			'access_token' => $data['token']->accessToken,
		]);
	}
}
