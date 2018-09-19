#!/usr/bin/env php
<?php

require_once __DIR__.'/../vendor/autoload.php';

$json = file_get_contents(__DIR__.'/../data/completions.json');
$data = json_decode($json, true);

$tags = collect($data['tags']);
$attributes = collect($data['attributes']);

$global_attributes = $attributes->filter(function($attribute) {
	return 'true' === ($attribute['global'] ?? null);
})->filter(function($config, $attribute) {
	return 0 !== stripos($attribute, 'on');
});

foreach($global_attributes as $attribute => $config):

$snake = str_replace('-', '_', $attribute);
$method = camel_case($attribute);

if (isset($config['type']) && 'boolean' === $config['type']):

$code = <<<ENDOFCODE
public function test_the_{$snake}_can_be_set_and_unset()
{
	\$form = \$this->aire()->form();
	
	\$form->$method();
	
	\$this->assertSelectorAttribute(\$form, 'form', '$attribute');
	
	\$form->$method(false);
	
	\$this->assertSelectorAttributeMissing(\$form, 'form', '$attribute');
}
ENDOFCODE;

else:

$code = <<<ENDOFCODE
public function test_the_{$snake}_can_be_set()
{
	\$form = \$this->aire()->form();
	
	\$value = str_random();
	\$form->$method(\$value);
	
	\$this->assertSelectorAttribute(\$form, 'form', '$attribute', \$value);
}
ENDOFCODE;

endif;

echo "$code\n";

endforeach;
