#!/usr/bin/env php
<?php

require_once __DIR__.'/../vendor/autoload.php';

$license = file_get_contents(__DIR__.'/../data/LICENSE.md');
$license_docblock = str_replace(["\r\n", "\r", "\n"], "\n * ", $license);

$json = file_get_contents(__DIR__.'/../data/completions.json');
$data = json_decode($json, true);

$tags = collect($data['tags']);
$attributes = collect($data['attributes']);

$global_attributes = $attributes->filter(function($attribute) {
	return 'true' === ($attribute['global'] ?? null);
})->filter(function($config, $attribute) {
	return 0 !== stripos($attribute, 'on');
});

$mode = $argv[1] ?? null;
$generator = __DIR__."/codegen/{$mode}.php";

if (file_exists($generator)) {
	include $generator;
	exit(0);
}

echo "\nInvalid mode: '$mode'";
exit(1);
