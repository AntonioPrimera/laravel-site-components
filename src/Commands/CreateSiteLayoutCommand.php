<?php
namespace AntonioPrimera\SiteComponents\Commands;

use AntonioPrimera\Artisan\FileGeneratorCommand;
use AntonioPrimera\Artisan\FileRecipe;
use AntonioPrimera\Artisan\FileRecipes\BladeRecipe;
use AntonioPrimera\Artisan\FileRecipes\StyleSheetRecipe;
use AntonioPrimera\Artisan\FileRecipes\ViewComponentRecipe;
use AntonioPrimera\FileSystem\File;

class CreateSiteLayoutCommand extends FileGeneratorCommand
{
	protected $signature = 'site-components:layout';
	
	//--- Recipe methods ----------------------------------------------------------------------------------------------
	
	protected function recipe(): array|FileRecipe
	{
		return [
			...$this->createOuterLayout(),
			...$this->createGuestLayout(),
			...$this->createGuestNav(),
		];
	}
	
	protected function createOuterLayout(): array
	{
		return [
			(new ViewComponentRecipe(__DIR__ . '/stubs/ViewComponentClasses/OuterLayout.php.stub'))
				->withBackupFiles(),
			(new BladeRecipe(__DIR__ . '/stubs/BladeViews/outer.blade.php.stub', 'layouts'))
				->withReplace([
					"__LIVEWIRE_STYLES__" => $this->projectUsesLivewire() ? '@livewireStyles' : '',
					"__LIVEWIRE_SCRIPTS__" => $this ->projectUsesLivewire() ? '@livewireScripts' : '',
				])
				->withBackupFiles(),
		];
	}
	
	protected function createGuestLayout(): array
	{
		return [
			(new ViewComponentRecipe(__DIR__ . '/stubs/ViewComponentClasses/GuestLayout.php.stub'))
				->withBackupFiles(),
			(new BladeRecipe(__DIR__ . '/stubs/BladeViews/guest.blade.php.stub', 'layouts'))
				->withBackupFiles(),
		];
	}
	
	protected function createGuestNav(): array
	{
		return [
			(new ViewComponentRecipe(__DIR__ . '/stubs/ViewComponentClasses/GuestNav.php.stub'))
				->withBackupFiles(),
			(new BladeRecipe(__DIR__ . '/stubs/BladeViews/guest-nav.blade.php.stub', 'layouts'))
				->withBackupFiles(),
			(new StyleSheetRecipe(__DIR__ . '/stubs/Css/guest-nav.pcss.stub'))
				->withBackupFiles(),
		];
	}
	
	//--- Protected helpers -------------------------------------------------------------------------------------------
	
	protected function projectUsesLivewire(): bool
	{
		return file_exists(base_path('composer.json'))
			&& str_contains(file_get_contents(base_path('composer.json')), '"livewire/livewire"');
	}
	
	protected function anyFileExists(...$paths): bool
	{
		foreach ($paths as $path)
			if (file_exists($path))
				return true;
		
		return false;
	}
}