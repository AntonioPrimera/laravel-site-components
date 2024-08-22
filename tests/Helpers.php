<?php

function cleanupFile(string $path): void
{
	if (file_exists($path))
		unlink($path);
}

function cleanupFiles(...$paths): void
{
	foreach ($paths as $path)
		cleanupFile($path);
}