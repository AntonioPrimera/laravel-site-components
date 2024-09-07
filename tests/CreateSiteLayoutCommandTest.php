<?php

beforeEach(function () {
	//define the expected file paths
	$this->outerComponentPath = app_path('View/Components/OuterLayout.php');
	$this->guestLayoutComponentPath = app_path('View/Components/GuestLayout.php');
	$this->guestNavComponentPath = app_path('View/Components/GuestNav.php');
	
	$this->outerLayoutPath = resource_path('views/layouts/outer.blade.php');
	$this->guestLayoutBladePath = resource_path('views/layouts/guest.blade.php');
	$this->navPath = resource_path('views/layouts/guest-nav.blade.php');
	
	$this->navCssPath = resource_path('css/guest-nav.pcss');
	
	$this->backupFiles = [
		$this->outerComponentPath . '.backup',
		$this->guestLayoutComponentPath . '.backup',
		$this->guestNavComponentPath . '.backup',
		$this->outerLayoutPath . '.backup',
		$this->guestLayoutBladePath . '.backup',
		$this->navPath . '.backup',
		$this->navCssPath . '.backup',
	];
	
	$this->allFiles = [
		$this->outerComponentPath,
		$this->guestNavComponentPath,
		$this->guestLayoutComponentPath,
		$this->outerLayoutPath,
		$this->navPath,
		$this->guestLayoutBladePath,
		$this->navCssPath,
	];
});

function cleanup(...$files): void{
	//cleanup the files
	cleanupFiles(...$files);
}

function assertFilesDoNotExist(...$files): void{
	//assert the files don't exist
	foreach ($files as $file)
		expect(file_exists($file))->toBeFalse();
}

function createDummyFiles(...$files): void
{
	foreach ($files as $file)
		file_put_contents($file, 'dummy content');
}

function assertFilesExist(...$files): void{
	//assert the files exist
	foreach ($files as $file)
		expect(file_exists($file))->toBeTrue();
}

it('can create all the necessary files for a site layout', function () {
	cleanup(...$this->allFiles, ...$this->backupFiles);
	assertFilesDoNotExist(...$this->allFiles, ...$this->backupFiles);
	
	$this->artisan('site-components:layout')
		->assertExitCode(0);
	
	//assert the files were created
	expect(file_exists($this->outerComponentPath))->toBeTrue()
		->and(file_get_contents($this->outerComponentPath))->toContain('class OuterLayout extends Component')
		->and(file_exists($this->guestNavComponentPath))->toBeTrue()
		->and(file_get_contents($this->guestNavComponentPath))->toContain('class GuestNav extends Nav')
		->and(file_exists($this->guestLayoutComponentPath))->toBeTrue()
		->and(file_get_contents($this->guestLayoutComponentPath))->toContain('class GuestLayout extends Component')
		->and(file_exists($this->outerLayoutPath))->toBeTrue()
		->and(file_get_contents($this->outerLayoutPath))->toContain('<!DOCTYPE html>')
		->and(file_exists($this->guestLayoutBladePath))->toBeTrue()
		->and(file_get_contents($this->guestLayoutBladePath))->toContain('<x-outer-layout>')
		->and(file_exists($this->navPath))->toBeTrue()
		->and(file_get_contents($this->navPath))->toContain('<nav class="site-nav"')
		->and(file_exists($this->navCssPath))->toBeTrue()
		->and(file_get_contents($this->navCssPath))->toContain('.site-nav {');
});

it('will backup existing files before creating new ones', function () {
	cleanup(...$this->backupFiles);
	assertFilesDoNotExist(...$this->backupFiles);
	
	createDummyFiles(...$this->allFiles);
	assertFilesExist(...$this->allFiles);
	
	$this->artisan('site-components:layout')
		->assertExitCode(0);
	
	//assert the files were created and contain the correct content
	expect(file_exists($this->outerComponentPath))->toBeTrue()
		->and(file_get_contents($this->outerComponentPath))->toContain('class OuterLayout extends Component')
		->and(file_exists($this->guestNavComponentPath))->toBeTrue()
		->and(file_get_contents($this->guestNavComponentPath))->toContain('class GuestNav extends Nav')
		->and(file_exists($this->guestLayoutComponentPath))->toBeTrue()
		->and(file_get_contents($this->guestLayoutComponentPath))->toContain('class GuestLayout extends Component')
		->and(file_exists($this->outerLayoutPath))->toBeTrue()
		->and(file_get_contents($this->outerLayoutPath))->toContain('<!DOCTYPE html>')
		->and(file_exists($this->guestLayoutBladePath))->toBeTrue()
		->and(file_get_contents($this->guestLayoutBladePath))->toContain('<x-outer-layout>')
		->and(file_exists($this->navPath))->toBeTrue()
		->and(file_get_contents($this->navPath))->toContain('<nav class="site-nav"')
		->and(file_exists($this->navCssPath))->toBeTrue()
		->and(file_get_contents($this->navCssPath))->toContain('.site-nav {')
	
	//assert the backup files were created and all contain the dummy content
		->and(file_exists($this->outerComponentPath . '.backup'))->toBeTrue()
		->and(file_get_contents($this->outerComponentPath . '.backup'))->toBe('dummy content')
		->and(file_exists($this->guestNavComponentPath . '.backup'))->toBeTrue()
		->and(file_get_contents($this->guestNavComponentPath . '.backup'))->toBe('dummy content')
		->and(file_exists($this->guestLayoutComponentPath . '.backup'))->toBeTrue()
		->and(file_get_contents($this->guestLayoutComponentPath . '.backup'))->toBe('dummy content')
		->and(file_exists($this->outerLayoutPath . '.backup'))->toBeTrue()
		->and(file_get_contents($this->outerLayoutPath . '.backup'))->toBe('dummy content')
		->and(file_exists($this->guestLayoutBladePath . '.backup'))->toBeTrue()
		->and(file_get_contents($this->guestLayoutBladePath . '.backup'))->toBe('dummy content')
		->and(file_exists($this->navPath . '.backup'))->toBeTrue()
		->and(file_get_contents($this->navPath . '.backup'))->toBe('dummy content')
		->and(file_exists($this->navCssPath . '.backup'))->toBeTrue()
		->and(file_get_contents($this->navCssPath . '.backup'))->toBe('dummy content');
});