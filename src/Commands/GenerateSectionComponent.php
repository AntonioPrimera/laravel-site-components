<?php

namespace AntonioPrimera\SiteComponents\Commands;

use AntonioPrimera\Artisan\FileGeneratorCommand;
use AntonioPrimera\Artisan\FileRecipe;
use AntonioPrimera\Artisan\FileRecipes\BladeRecipe;
use AntonioPrimera\Artisan\FileRecipes\ViewComponentRecipe;

class GenerateSectionComponent extends FileGeneratorCommand
{
	protected $signature = 'site:make-section-component {name}';
	protected $description = 'Generate a new section component (component class and blade view)';
	
	protected function recipe(): array|FileRecipe
	{
		return [
			(new ViewComponentRecipe(__DIR__ . '/stubs/SectionComponent.php.stub'))
				->withTargetFolder(app_path('View/Components/Site/Sections'))
				->withRootNamespace('App\\View\\Components\\Site\\Sections'),
			
			new BladeRecipe(
				__DIR__ . '/stubs/section-component.blade.php.stub',
				'components/site/sections'
			)
		];
	}
}