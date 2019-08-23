<?php

function print_docs($attribute, $config, $class_name = 'Element')
{
	$is_flag = isset($config['type']) && 'flag' === $config['type'];
	$is_bool = isset($config['type']) && 'boolean' === $config['type'];
	$method = $config['spellings']->camel;
	$attribute_param = $config['spellings']->snake;
	
	$method_signature = $is_bool || $is_flag
		? "$method(bool \$$attribute_param = true)"
		: "$method(\$value)";
	
	echo "\n";
	echo "<h3 class='font-mono my-6'>{$class_name}::{$method_signature}</h3>\n";
	
	$descriptor = 'attribute';
	if ($is_flag) {
		$descriptor = 'flag';
	} else if ($is_bool) {
		$descriptor = 'boolean attribute';
	}
	
	$description = "Set the <code>$attribute</code> $descriptor.";
	
	if (isset($config['description'])) {
		$description .= ' '.e($config['description']);
	}
	
	echo "<p>{$description}</p>\n";
	
	if (isset($config['attribOption'])) {
		echo "<h4 class='font-bold text-gray-700 text-sm my-3 uppercase'>Possible values:</h4>\n";
		
		if (count($config['attribOption']) > 100) {
			echo "<ul class='pl-8 mb-8 list-disc' style='column-count: 6; column-gap: 2rem;'>\n";
		} else if (count($config['attribOption']) > 20) {
			echo "<ul class='pl-8 mb-8 list-disc' style='column-count: 4; column-gap: 2rem;'>\n";
		} else {
			echo "<ul class='pl-8 mb-8 list-disc'>\n";
		}
		
		foreach ($config['attribOption'] as $value) {
			echo '<li class="my-2"><code>'.e($value)."</code></li>\n";
		}
		
		echo "</ul>\n";
	}
	
}

if ($write) {
	ob_start();
}


$excluded = ['class'];

foreach ($global_attributes as $attribute => $config) {
	if (in_array($attribute, $excluded)) {
		continue;
	}
	
	print_docs($attribute, $config);
}

if ($write) {
	$php = ob_get_clean();
	$file_path = __DIR__.'/../../docs/src/views/_global-attributes.blade.php';
	file_put_contents($file_path, $php);
	echo "Wrote $file_path\n";
	
	ob_start();
}

foreach ($tags as $tag => $config) {
	
	$class_name = studly_case($tag);
	
	$view = snake_case($tag, '-');
	
	echo '<h2 class="my-6 mt-12">'.e("<{$tag}>")."</h2>\n";
	
	if (isset($config['attributes'])) {
		foreach ($config['attributes'] as $attribute => $attribute_config) {
			if ($global_attributes->has($attribute)) {
				continue;
			}
			print_docs($attribute, $attribute_config, $class_name);
		}
	}
	
	echo "\n";
}

if ($write) {
	$php = ob_get_clean();
	$file_path = __DIR__.'/../../docs/src/views/_element-attributes.blade.php';
	file_put_contents($file_path, $php);
	echo "Wrote $file_path\n";
}
