<?php

namespace Apiato\Containers\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\SubAction;
use Apiato\Containers\SocialAuth\Abstracts\SocialAuthProvider;
use Apiato\Containers\SocialAuth\Exceptions\UnsupportedSocialAuthProviderException;
use Apiato\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;

class GetSocialAuthProviderInstanceSubAction extends SubAction
{
    /**
     * @throws UnsupportedSocialAuthProviderException
     */
    public function run(ApiAuthenticateRequest $request): SocialAuthProvider
    {
        $providerInstance = $this->getProviderInstance($request);

        if (is_null($providerInstance)) {
            throw new UnsupportedSocialAuthProviderException("The Social Auth Provider $request->provider is unsupported.");
        }

        return $providerInstance;
    }

    private function getProviderInstance(ApiAuthenticateRequest $request)
    {
        foreach (config('vendor-socialAuth.providers') as $providerName => $providerClass) {
            if ($request->provider === $providerName) {
                return app($providerClass, [$request]);
            }
        }
    }
}