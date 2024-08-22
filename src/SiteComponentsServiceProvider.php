<?php

namespace AntonioPrimera\SiteComponents;

use AntonioPrimera\SiteComponents\Commands\GenerateBitComponent;
use AntonioPrimera\SiteComponents\Commands\GenerateSectionComponent;
use AntonioPrimera\SiteComponents\Components\Image;
use AntonioPrimera\SiteComponents\Components\Nav;
use AntonioPrimera\SiteComponents\Components\SectionContainer;
use AntonioPrimera\SiteComponents\Components\SectionTitle;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SiteComponentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-site-components')
			->hasViews('site')
            ->hasViewComponents(
                'site',
                Image::class,
                SectionTitle::class,
                SectionContainer::class,
                Nav::class
            )
			->hasCommands(
				GenerateSectionComponent::class,
				GenerateBitComponent::class
			);
		
		//publish the css assets to the resources/css directory
		$this->publishes([
			__DIR__.'/../resources/css' => resource_path('css/vendor/laravel-site-components'),
		], 'laravel-site-components-css');
    }
}
