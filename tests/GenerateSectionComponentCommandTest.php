<?php

it('can create a section component and the blade file', function () {
	$expectedComponentPath = app_path('View/Components/Site/Sections/HeroSection.php');
	$expectedBladePath = resource_path('views/components/site/sections/hero-section.blade.php');
	
	cleanupFiles($expectedComponentPath, $expectedBladePath);
	
	expect(file_exists($expectedComponentPath))->toBeFalse()
		->and(file_exists($expectedBladePath))->toBeFalse();
	
	$this->artisan('site:make-section-component', ['name' => 'HeroSection'])
		->assertExitCode(0);
	
	expect($expectedBladePath)->toBeFile()
		->and($expectedComponentPath)->toBeFile()
		->and(file_get_contents($expectedComponentPath))
			->toContain(
				'namespace App\View\Components\Site\Sections;',
				'class HeroSection extends SectionComponent'
			)
		->and(file_get_contents($expectedBladePath))
			->toContain(
				'<div>'
			);
});