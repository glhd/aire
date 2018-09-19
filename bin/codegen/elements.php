<?php

$write = '--write' === strtolower($argv[2] ?? '');

$tag_whitelist = [
	'button',
	'form',
	'input',
	'label',
	'select',
	'textarea',
];

$form_element_tags = [
	'button',
	'input',
	'select',
	'textarea',
];

foreach ($tags as $tag => $tag_config) {
	
	if (!in_array($tag, $tag_whitelist)) {
		continue;
	}
	
	$attribute_config = [];
	
	if (isset($tag_config['attributes'])) {
		foreach ($tag_config['attributes'] as $attribute) {
			if (isset($attributes["$tag/$attribute"])) {
				$attribute_config[$attribute] = $attributes["$tag/$attribute"];
			} else if (isset($attributes[$attribute])) {
				$attribute_config[$attribute] = $attributes[$attribute];
			}
		}
	}
	
	if ($write) {
		ob_start();
	}
	
	$parent = in_array($tag, $form_element_tags)
		? 'FormElement'
		: 'Element';
	
	echo "<?php\n\n";
	
	echo "/**\n";
	echo " * Portions of this code have been generated using Atom autocompletion data.\n";
	echo " *\n";
	echo " * @see https://github.com/atom/autocomplete-html\n";
	echo " *\n";
	echo " * $license_docblock\n";
	echo " *\n";
	echo " */\n\n";
	
	echo "namespace Galahad\Aire\DTD;\n\n";
	
	echo "use Galahad\Aire\Elements\\$parent;\n";
	
	if (isset($attribute_config['value'])) {
		echo "use Galahad\Aire\Value\HasValue;\n";
	}
	
	echo "\n";
	
	$class_name = studly_case($tag);
	
	if (isset($tag_config['description'])) {
		$description = wordwrap($tag_config['description'], 70, "\n * ");
		
		echo "/**\n";
		echo " * $description\n";
		echo " *\n";
		echo " */\n";
	}
	
	echo "class $class_name extends $parent\n";
	echo "{\n";
	
	if (isset($attribute_config['value'])) {
		echo "\tuse HasValue;\n\n";
	}
	
	$view = snake_case($tag, '-');
	
	echo "\tprotected \$view = '$view';\n\n";
	
	foreach ($attribute_config as $attribute => $config) {
		if ('value' === $attribute || 'name' === $attribute) {
			continue;
		}
		
		$method = camel_case($attribute);
		$attribute_param = snake_case($attribute);
		
		echo "\t/**\n";
		echo "\t * Set the '$attribute' attribute\n";
		echo "\t *\n";
		
		if (isset($config['attribOption'])) {
			echo "\t * Possible values:\n";
			echo "\t *\n";
			
			foreach ($config['attribOption'] as $value) {
				echo "\t *  - '$value'\n";
			}
			
			echo "\t *\n";
		}
		
		if ('flag' === ($config['type'] ?? null)) {
			
			echo "\t * @param bool \$$attribute_param\n";
			echo "\t * @return self\n";
			echo "\t */\n";
			
			echo "\tpublic function $method(\$$attribute_param = true) : self\n";
			echo "\t{\n";
			echo "\t\t\$this->attributes['$attribute'] = \$$attribute_param;\n\n";
			echo "\t\treturn \$this;\n";
			echo "\t}\n\n";
			
		} else {
			
			echo "\t * @param string \$value\n";
			echo "\t * @return self\n";
			echo "\t */\n";
			
			echo "\tpublic function $method(\$value = null) : self\n";
			echo "\t{\n";
			echo "\t\t\$this->attributes['$attribute'] = \$value;\n\n";
			echo "\t\treturn \$this;\n";
			echo "\t}\n\n";
		
		}
	}
	
	echo "}\n";
	
	if ($write) {
		$php = ob_get_clean();
		
		$file_path = __DIR__.'/../../src/DTD/'.$class_name.'.php';
		file_put_contents($file_path, $php);
		echo "Wrote $file_path\n";
	}
}
