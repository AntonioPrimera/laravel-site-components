<?php
function parse(string $contents): string
{
	return \AntonioPrimera\Md\Facades\Md::parse($contents);
}

function parseInline(string $contents): string
{
	return \AntonioPrimera\Md\Facades\Md::parseInline($contents);
}

function phoneUrl(string $rawPhoneNumber, string|null $countryCode = null): string
{
	$cleanPhoneNumber = $rawPhoneNumber;
	$cleanCountryCode = $countryCode;
	
	//replace + with 00
	if (str_starts_with($cleanPhoneNumber, '+'))
		$cleanPhoneNumber = '00' . substr($cleanPhoneNumber, 1);
	
	//replace the + in the country code with 00
	if ($cleanCountryCode && str_starts_with($cleanCountryCode, '+'))
		$cleanCountryCode = '00' . substr($cleanCountryCode, 1);
	
	//clean up any non-numeric characters in the phone number
	$cleanPhoneNumber = preg_replace('/[^0-9]/', '', $cleanPhoneNumber);
	
	//ray($cleanCountryCode . ':' . $cleanPhoneNumber);
	//if the phone number doesn't start with the country code, add it
	if ($cleanCountryCode && !str_starts_with($cleanPhoneNumber, $cleanCountryCode))
		$cleanPhoneNumber = $cleanCountryCode
			. (str_starts_with($cleanPhoneNumber, '0') ? substr($cleanPhoneNumber, 1) : $cleanPhoneNumber);
	
	return "tel:$cleanPhoneNumber";
}