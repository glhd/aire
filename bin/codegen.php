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

// TODO: data-*

foreach($global_attributes as $attribute => $config):

$snake = str_replace('-', '_', $attribute);
$method = camel_case($attribute);

if (isset($config['type']) && 'boolean' === $config['type']):

$code = <<<ENDOFCODE
public function test_the_{$snake}_can_be_set_and_unset()
{
	\$form = Aire::open();
	
	\$form->$method();
	
	\$this->assertContains('$attribute', (string) \$form);
	
	\$form->$method(false);
	
	\$this->assertNotContains('$attribute', (string) \$form);
}
ENDOFCODE;

else:

$code = <<<ENDOFCODE
public function test_the_{$snake}_can_be_set()
{
	\$form = Aire::open();
	
	\$form->$method('foo');
	
	\$this->assertContains('$attribute="foo"', (string) \$form);
}
ENDOFCODE;

endif;

echo "$code\n";

endforeach;
