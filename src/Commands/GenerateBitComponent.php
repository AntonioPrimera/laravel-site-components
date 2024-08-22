<?php

namespace AntonioPrimera\SiteComponents\Commands;

use AntonioPrimera\Artisan\FileGeneratorCommand;
use AntonioPrimera\Artisan\FileRecipe;
use AntonioPrimera\Artisan\FileRecipes\BladeRecipe;
use AntonioPrimera\Artisan\FileRecipes\ViewComponentRecipe;

class GenerateBitComponent extends FileGeneratorCommand
{
	protected $signature = 'site:make-bit-component {name}';
	protected $description = 'Generate a new bit component (component class and blade view)';
	
	protected function recipe(): array|FileRecipe
	{
		return [
			(new ViewComponentRecipe(__DIR__ . '/stubs/BitComponent.php.stub'))
				->withTargetFolder(app_path('View/Components/Site/Bits'))
				->withRootNamespace('App\\View\\Components\\Site\\Bits'),
			
			new BladeRecipe(
				__DIR__ . '/stubs/bit-component.blade.php.stub',
				'components/site/bits'
			)
		];
	}
}