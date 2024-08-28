<?php

it('can correctly generate a valid phone number url', function () {
	expect(phoneUrl('+1234567890'))->toBe('tel:001234567890')
		->and(phoneUrl('1234567890'))->toBe('tel:1234567890')
		->and(phoneUrl('+41723456789', '+41'))->toBe('tel:0041723456789')
		->and(phoneUrl('723 456 789', '+41'))->toBe('tel:0041723456789')
		->and(phoneUrl('0723.456.789', '+41'))->toBe('tel:0041723456789')
		->and(phoneUrl('0723-456-789', '+41'))->toBe('tel:0041723456789')
		->and(phoneUrl('0723-456-789'))->toBe('tel:0723456789')
		->and(phoneUrl('+49 (723) 456 - 789'))->toBe('tel:0049723456789');
});