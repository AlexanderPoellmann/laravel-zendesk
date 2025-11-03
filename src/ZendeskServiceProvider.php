<?php

namespace AlexanderPoellmann\LaravelZendesk;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ZendeskServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-zendesk')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->scoped(Zendesk::class, function () {
            $subdomain = config('services.zendesk.subdomain');
            $username = config('services.zendesk.username');
            $token = config('services.zendesk.token');

            return new Zendesk(
                subdomain: $subdomain,
                username: $username,
                token: $token,
            );
        });
    }
}
