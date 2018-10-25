<?php

use Galahad\Aire\Aire;

if (!function_exists('aire')) {
	function aire() : Aire
	{
		return app('galahad.aire');
	}
}
