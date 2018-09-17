<?php

use Galahad\Aire\Aire;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

if (!function_exists('aire')) {
	function aire() : Aire
	{
		return app('galahad.aire');
	}
}

if (!function_exists('aire_attributes')) {
	function aire_attributes(array $attributes, array $exclude = [])
	{
		$html = Collection::make($attributes)
			->filter(function($value, $name) use ($exclude) {
				return !in_array($name, $exclude, false);
			})
			->filter(function($value) {
				return false !== $value;
			})
			->map(function($value) {
				return is_array($value)
					? implode(' ', $value)
					: $value;
			})
			->map(function($value, $name) {
				if (true === $value) {
					return $name;
				}
				
				$name = strtolower($name);
				$value = e($value);
				
				return "{$name}=\"{$value}\"";
			})
			->implode(' ');
		
		return new HtmlString($html);
	}
}
