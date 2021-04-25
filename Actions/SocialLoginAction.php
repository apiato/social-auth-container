<?php

namespace App\Containers\Vendor\SocialAuth\Actions;

use App\Containers\Vendor\SocialAuth\Tasks\ApiLoginFromUserTask;
use App\Containers\Vendor\SocialAuth\Tasks\CreateUserBySocialProfileTask;
use App\Containers\Vendor\SocialAuth\Tasks\FindSocialUserTask;
use App\Containers\Vendor\SocialAuth\Tasks\FindUserSocialProfileTask;
use App\Containers\Vendor\SocialAuth\Tasks\UpdateUserSocialProfileTask;
use App\Containers\Vendor\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use App\Ship\Parents\Actions\Action;

class SocialLoginAction extends Action
{
	/**
	 * ----- if has social profile
	 * --------- [A] update his social profile info
	 * ----- if has no social profile
	 * --------- [C] create new record
	 * @param ApiAuthenticateRequest $request
	 * @return array
	 */
	public function run(ApiAuthenticateRequest $request): array
	{
		$provider = $request->provider;
		// fetch the user data from the support platforms
		$socialUserProfile = app(FindUserSocialProfileTask::class)->run($provider, $request->all());

		// check if the social ID exist on any of our users, and get that user in case it was found
		$socialUser = app(FindSocialUserTask::class)->run($provider, $socialUserProfile->id);

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
			$user = app(UpdateUserSocialProfileTask::class)->run(
				$socialUser->id,
				$socialUserProfile->token,
				$expiresIn,
				$refreshToken,
				$tokenSecret,
				$socialUserProfile->avatar,
				$avatar_original
			);
		} else {
			// THIS IS: A NEW USER

			$isAdmin = config('vendor-socialAuth.create_new_user_as_admin');

			// DO: CREATE NEW USER FROM THE SOCIAL PROFILE INFORMATION.
			$user = app(CreateUserBySocialProfileTask::class)->run(
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
			);
		}

		// Authenticate the user from its object
		$personalAccessTokenResult = app(ApiLoginFromUserTask::class)->run($user);

		return [
			'user' => $user,
			'token' => $personalAccessTokenResult,
		];
	}
}
