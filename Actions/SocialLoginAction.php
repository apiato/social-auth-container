<?php

namespace App\Modules\SocialAuth\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Modules\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;

class SocialLoginAction extends Action
{
	/**
	 * ----- if has social profile
	 * --------- [A] update his social profile info
	 * ----- if has no social profile
	 * --------- [C] create new record
	 * @param ApiAuthenticateRequest $data
	 * @return array
	 */
	public function run(ApiAuthenticateRequest $data): array
	{
		$provider = $data->provider;
		// fetch the user data from the support platforms
		$socialUserProfile = Apiato::call('SocialAuth@FindUserSocialProfileTask', [$provider, $data->all()]);

		// check if the social ID exist on any of our users, and get that user in case it was found
		$socialUser = Apiato::call('SocialAuth@FindSocialUserTask', [$provider, $socialUserProfile->id]);

		// checking if some data are available in the response
		// (these lines are written to make this function compatible with multiple providers)
		$tokenSecret = $socialUserProfile->tokenSecret ?? null;
		$expiresIn = $socialUserProfile->expiresIn ?? null;
		$refreshToken = $socialUserProfile->refreshToken ?? null;
		$avatar_original = $socialUserProfile->avatar_original ?? null;

		if ($socialUser) {

			// THIS IS: A USER AND ALREADY HAVE A SOCIAL PROFILE
			// DO: UPDATE THE EXISTING USER SOCIAL PROFILE.

			// Only update tokens and updated information. Never override the user profile.
			$user = Apiato::call('SocialAuth@UpdateUserSocialProfileTask', [
				$socialUser->id,
				$socialUserProfile->token,
				$expiresIn,
				$refreshToken,
				$tokenSecret,
				$socialUserProfile->avatar,
				$avatar_original
			]);
		} else {
			// THIS IS: A NEW USER

			$isAdmin = Config::get('socialAuth-container.create_new_user_as_admin');

			// DO: CREATE NEW USER FROM THE SOCIAL PROFILE INFORMATION.
			$user = Apiato::call('SocialAuth@CreateUserBySocialProfileTask', [
				$provider,
				$socialUserProfile->token,
				$socialUserProfile->id,
				$socialUserProfile->nickname,
				$socialUserProfile->name,
				$socialUserProfile->email,
				$socialUserProfile->avatar,
				$tokenSecret,
				$expiresIn,
				$refreshToken,
				$avatar_original,
				$isAdmin
			]);
		}

		// Authenticate the user from its object
		$personalAccessTokenResult = Apiato::call('SocialAuth@ApiLoginFromUserTask', [$user]);

		return [
			'user' => $user,
			'token' => $personalAccessTokenResult,
		];
	}
}
