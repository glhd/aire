<?php

use Galahad\Aire\Aire;

if (!function_exists('aire')) { // @codeCoverageIgnore
	function aire(): Aire
	{
		return app('galahad.aire');
	}
}
