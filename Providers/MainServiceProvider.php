<?php

namespace App\Containers\Vendor\SocialAuth\Providers;

use Apiato\Core\Abstracts\Providers\MainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [
    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();
        // do your binding here..
    }
}
