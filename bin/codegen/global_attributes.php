<?php

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
