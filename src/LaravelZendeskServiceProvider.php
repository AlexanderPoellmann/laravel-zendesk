<?php

namespace AlexanderPoellmann\LaravelZendesk;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelZendeskServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-zendesk')
            ->hasConfigFile();
    }
}
