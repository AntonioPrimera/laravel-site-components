<?php

function cleanupFiles(...$files): void
{
	foreach ($files as $file)
		if (file_exists($file))
			unlink($file);
}