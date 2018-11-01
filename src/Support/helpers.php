<?php

use Galahad\Aire\Aire;

// @codeCoverageIgnore

if (!function_exists('aire')) {
	function aire() : Aire
	{
		return app('galahad.aire');
	}
}
