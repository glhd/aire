<?php

foreach ($tags as $tag => $config) {
	
	if ($write) {
		ob_start();
	}
	
	$parent = $config['parent'];
	
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
	
	// if (isset($config['attributes']['value'])) {
	// 	echo "use Galahad\Aire\Value\HasValue;\n";
	// }
	
	echo "\n";
	
	$class_name = studly_case($tag);
	
	if (isset($config['description'])) {
		$description = wordwrap($config['description'], 70, "\n * ");
		
		echo "/**\n";
		echo " * $description\n";
		echo " *\n";
		echo " */\n";
	}
	
	echo "class $class_name extends $parent\n";
	echo "{\n";
	
	// if (isset($config['attributes']['value'])) {
	// 	echo "\tuse HasValue;\n\n";
	// }
	
	$view = snake_case($tag, '-');
	
	echo "\tpublic \$name = '$view';\n\n";
	
	if (isset($config['attributes'])) {
		foreach ($config['attributes'] as $attribute => $attribute_config) {
			// if ('value' === $attribute || 'name' === $attribute) {
			// 	continue;
			// }
			
			print_setter($attribute, $attribute_config, $config['parent']);
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
