#!/usr/bin/env php
<?php

use Illuminate\Support\Str;

require_once __DIR__.'/../vendor/autoload.php';

$tag_whitelist = [
	'button',
	'form',
	'input',
	'label',
	'select',
	'option',
	'textarea',
	// 'fieldset',
	// 'legend',
];

$form_element_tags = [
	'button',
	'input',
	'select',
	'textarea',
];

$attribute_methods = [
	'accesskey' => 'accessKey',
	'contenteditable' => 'contentEditable',
	'contextmenu' => 'contextMenu',
	'dropzone' => 'dropZone',
	'spellcheck' => 'spellCheck',
	'tabindex' => 'tabIndex',
	'aria-activedescendant' => 'ariaActiveDescendant',
	'aria-describedby' => 'ariaDescribedBy',
	'aria-dropeffect' => 'ariaDropEffect',
	'aria-flowto' => 'ariaFlowTo',
	'aria-haspopup' => 'ariaHasPopup',
	'aria-labelledby' => 'ariaLabelledBy',
	'autocomplete' => 'autoComplete',
	'autofocus' => 'autoFocus',
	'dirname' => 'dirName',
	'enctype' => 'encType',
	'formaction' => 'formAction',
	'formenctype' => 'formEncType',
	'formmethod' => 'formMethod',
	'formnovalidate' => 'formNoValidate',
	'formtarget' => 'formTarget',
	'maxlength' => 'maxLength',
	'novalidate' => 'noValidate',
	'readonly' => 'readOnly',
];

$license = trim(file_get_contents(__DIR__.'/../data/LICENSE.md'));
$license_docblock = str_replace(["\r\n", "\r", "\n"], "\n * ", $license);

$json = file_get_contents(__DIR__.'/../data/completions.json');
$data = json_decode($json, true);

$attributes = collect($data['attributes']);

function attribute_spellings($attribute)
{
	global $attribute_methods;
	
	$camel = $attribute_methods[$attribute] ?? Str::camel($attribute);
	
	return (object) [
		'camel' => $camel,
		'snake' => Str::snake($camel),
		'hyphen' => Str::snake($camel, '-'),
		'studly' => Str::studly($camel),
	];
}

$global_attributes = $attributes->filter(function($attribute) {
	return 'true' === ($attribute['global'] ?? null);
})->filter(function($config, $attribute) {
	return 0 !== stripos($attribute, 'on');
})->map(function($config, $attribute) {
	$config['spellings'] = attribute_spellings($attribute);
	return $config;
});

$tags = collect($data['tags'])
	->filter(function($config, $tag) use ($tag_whitelist) {
		return in_array($tag, $tag_whitelist);
	})
	->map(function($config, $tag) use ($form_element_tags, $attributes, $attribute_methods) {
		$config['parent'] = 'Element';
		
		if (isset($config['attributes'])) {
			$config['attributes'] = collect($config['attributes'])
				->mapWithKeys(function($attribute) use ($tag, $attributes, $attribute_methods) {
					$config = [];
					
					if (isset($attributes["$tag/$attribute"])) {
						$config = $attributes["$tag/$attribute"];
					} else if (isset($attributes[$attribute])) {
						$config = $attributes[$attribute];
					}
					
					$config['spellings'] = attribute_spellings($attribute);
					
					return [$attribute => $config];
				});
		}
		
		return $config;
	});

function print_setter($attribute, $attribute_config, $parent = 'Element') {
	$is_flag = isset($attribute_config['type']) && 'flag' === $attribute_config['type'];
	$is_bool = isset($attribute_config['type']) && 'boolean' === $attribute_config['type'];
	$method = $attribute_config['spellings']->camel;
	$attribute_param = $attribute_config['spellings']->snake;
	
	$descriptor = 'attribute';
	if ($is_flag) {
		$descriptor = 'flag';
	} else if ($is_bool) {
		$descriptor = 'boolean attribute';
	}
	
	echo "\t/**\n";
	echo "\t * Set the '$attribute' $descriptor\n";
	echo "\t *\n";
	
	if (isset($attribute_config['attribOption'])) {
		echo "\t * Possible values:\n";
		echo "\t *\n";
		
		foreach ($attribute_config['attribOption'] as $value) {
			echo "\t *  - '$value'\n";
		}
		
		echo "\t *\n";
	}
	
	if ($is_flag || $is_bool) {
		
		echo "\t * @param bool \$$attribute_param\n";
		echo "\t * @return \$this\n";
		echo "\t */\n";
		
		echo "\tpublic function $method(?bool \$$attribute_param = true)\n";
		echo "\t{\n";
		
		if ($is_flag) {
			echo "\t\t\$this->attributes['$attribute'] = \$$attribute_param;\n";
		} else if ($is_bool) {
			echo "\t\tif (null === \$$attribute_param) {\n";
			echo "\t\t\t\$this->attributes['$attribute'] = null;\n";
			echo "\t\t} else {\n";
			echo "\t\t\t\$this->attributes['$attribute'] = \$$attribute_param\n";
			echo "\t\t\t\t? 'true'\n";
			echo "\t\t\t\t: 'false';\n";
			echo "\t\t}\n";
		}
		
		echo "\t\t\n";
		echo "\t\treturn \$this;\n";
		echo "\t}\n\n";
		
	} else {
		
		echo "\t * @param string \$value\n";
		echo "\t * @return \$this\n";
		echo "\t */\n";
		
		echo "\tpublic function $method(\$value = null)\n";
		echo "\t{\n";
		echo "\t\t\$this->attributes['$attribute'] = \$value;\n\n";
		echo "\t\treturn \$this;\n";
		echo "\t}\n\n";
		
	}
}

function print_setter_test($attribute, $attribute_config, $tag = 'form', $component = false) {
	$class_name = Str::studly($tag);
	$is_flag = isset($attribute_config['type']) && 'flag' === $attribute_config['type'];
	$is_bool = isset($attribute_config['type']) && 'boolean' === $attribute_config['type'];
	$test_name = $attribute_config['spellings']->snake;
	$method = $attribute_config['spellings']->camel;
	$xml_attribute = $attribute_config['spellings']->hyphen;
	
	if ($is_flag) {
		
		echo "\tpublic function test_{$test_name}_flag_can_be_set_on_and_off() : void\n";
		echo "\t{\n";
		
	} else if ($is_bool) {
		
		echo "\tpublic function test_{$test_name}_boolean_can_be_set_to_true_and_false_and_be_unset() : void\n";
		echo "\t{\n";
		
	} else {
		
		echo "\tpublic function test_{$test_name}_attribute_can_be_set_and_unset() : void\n";
		echo "\t{\n";
		
	}
	
	$target = '$'.strtolower($class_name);
	
	if (!$component) {
		if ('Form' !== $class_name) {
			echo "\t\t$target = new $class_name(\$this->aire(), \$this->aire()->form());\n";
		} else {
			echo "\t\t$target = \$this->aire()->form();\n";
		}
		echo "\t\t\n";
	}
	
	if ($is_flag) {
		
		if ($component) {
			echo "\t\t$target = \$this->renderBlade('<x-aire::$tag $xml_attribute />');\n";
		} else {
			echo "\t\t$target->$method();\n";
		}
		echo "\t\t\$this->assertSelectorAttribute($target, '$tag', '$attribute');\n";
		echo "\t\t\n";
		
		if ($component) {
			echo "\t\t$target = \$this->renderBlade('<x-aire::$tag :$xml_attribute=\"false\" />');\n";
		} else {
			echo "\t\t$target->$method(false);\n";
		}
		echo "\t\t\$this->assertSelectorAttributeMissing($target, '$tag', '$attribute');\n";
		echo "\t}\n";
		echo "\t\n";
		
	} else if ($is_bool) {
		
		if ($component) {
			echo "\t\t$target = \$this->renderBlade('<x-aire::$tag $xml_attribute />');\n";
		} else {
			echo "\t\t$target->$method();\n";
		}
		echo "\t\t\$this->assertSelectorAttribute($target, '$tag', '$attribute', 'true');\n";
		echo "\t\t\n";
		
		if ($component) {
			echo "\t\t$target = \$this->renderBlade('<x-aire::$tag :$xml_attribute=\"false\" />');\n";
		} else {
			echo "\t\t$target->$method(false);\n";
		}
		echo "\t\t\$this->assertSelectorAttribute($target, '$tag', '$attribute', 'false');\n";
		echo "\t\t\n";
		
		if ($component) {
			echo "\t\t$target = \$this->renderBlade('<x-aire::$tag :$xml_attribute=\"null\" />');\n";
		} else {
			echo "\t\t$target->$method(null);\n";
		}
		echo "\t\t\$this->assertSelectorAttributeMissing($target, '$tag', '$attribute');\n";
		echo "\t}\n";
		echo "\t\n";
		
	} else {
		
		if (isset($attribute_config['attribOption'])) {
			foreach ($attribute_config['attribOption'] as $value) {
				$value = addslashes($value);
				
				if ($component) {
					echo "\t\t$target = \$this->renderBlade('<x-aire::$tag $xml_attribute=\"$value\" />');\n";
				} else {
					echo "\t\t$target->$method('$value');\n";
				}
				echo "\t\t\$this->assertSelectorAttribute($target, '$tag', '$attribute', '$value');\n";
				echo "\t\t\n";
			}
		} else {
			echo "\t\t\$value = Str::random();\n";
			echo "\t\t\n";
			
			if ($component) {
				echo "\t\t$target = \$this->renderBlade('<x-aire::$tag :$xml_attribute=\"\$value\" />', compact('value'));\n";
			} else {
				echo "\t\t$target->$method(\$value);\n";
			}
			echo "\t\t\$this->assertSelectorAttribute($target, '$tag', '$attribute', \$value);\n";
			echo "\t\t\n";
		}
		
		if ($component) {
			echo "\t\t$target = \$this->renderBlade('<x-aire::$tag :$xml_attribute=\"null\" />');\n";
		} else {
			echo "\t\t$target->$method(null);\n";
		}
		echo "\t\t\$this->assertSelectorAttributeMissing($target, '$tag', '$attribute');\n";
		echo "\t}\n";
		echo "\t\n";
		
	}
}

$mode = $argv[1] ?? 'help';
$write = '--write' === strtolower($argv[2] ?? '');

$generator = __DIR__."/codegen/{$mode}.php";

if (file_exists($generator)) {
	include $generator;
	exit(0);
}

echo "\nInvalid mode: '$mode'";
exit(1);
