#!/usr/bin/env php
<?php

require_once __DIR__.'/vendor/autoload.php';

$json = file_get_contents(__DIR__.'/data/completions.json');
$data = json_decode($json, true);

$tags = collect($data['tags']);
$attributes = collect($data['attributes']);

$global_attributes = $attributes->filter(function($attribute) {
	return 'true' === ($attribute['global'] ?? null);
})->filter(function($config, $attribute) {
	return 0 !== stripos($attribute, 'on');
});

// TODO: data-*

foreach($global_attributes as $attribute => $config) {
	$method = camel_case($attribute);
	
	echo "public function $method(";
	
	if (isset($config['type']) && 'boolean' === $config['type']) {
		$variable = str_replace('-', '_', $attribute);
		echo "\$$variable = true)\n{\n";
		echo "\t\$this->attributes['{$attribute}'] = \$$variable;\n";
	} else {
		echo "\$value)\n{\n";
		echo "\t\$this->attributes['{$attribute}'] = \$value;\n";
	}
	
	echo "\n\treturn \$this;\n}\n\n";
}
