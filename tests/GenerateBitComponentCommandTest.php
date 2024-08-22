<?php

it('can create a bit component and the blade file', function () {
	$expectedComponentPath = app_path('View/Components/Site/Bits/ServiceBit.php');
	$expectedBladePath = resource_path('views/components/site/bits/service-bit.blade.php');
	
	cleanupFiles($expectedComponentPath, $expectedBladePath);
	
	expect(file_exists($expectedComponentPath))->toBeFalse()
		->and(file_exists($expectedBladePath))->toBeFalse();
	
	$this->artisan('site:make-bit-component', ['name' => 'ServiceBit'])
		->assertExitCode(0);
	
	expect($expectedBladePath)->toBeFile()
		->and($expectedComponentPath)->toBeFile()
		->and(file_get_contents($expectedComponentPath))
			->toContain(
				'namespace App\View\Components\Site\Bits;',
				'class ServiceBit extends BitComponent'
			)
		->and(file_get_contents($expectedBladePath))
			->toContain(
				'<div>'
			);
});