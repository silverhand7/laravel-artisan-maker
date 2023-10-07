<?php

namespace Silverhand7\LaravelArtisanMaker;

use Illuminate\Support\ServiceProvider;
use Silverhand7\LaravelArtisanMaker\Console\ServiceMakeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelArtisanMakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-artisan-maker')
            ->hasCommand(ServiceMakeCommand::class);
    }
}