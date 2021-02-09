<?php

use Illuminate\Support\Str;

foreach ($tags as $tag => $config) {
	
	if (!isset($config['attributes'])) {
		continue;
	}
	
	if ($write) {
		ob_start();
	}
	
	echo "<?php\n\n";
	
	echo "/**\n";
	echo " * Portions of this code have been generated using Atom autocompletion data.\n";
	echo " *\n";
	echo " * @see https://github.com/atom/autocomplete-html\n";
	echo " *\n";
	echo " * $license_docblock\n";
	echo " *\n";
	echo " */\n\n";
	
	echo "namespace Galahad\Aire\Tests\Components;\n\n";
	
	$class_name = Str::studly($tag);
	
	echo "use Galahad\Aire\Tests\TestCase;\n";
	echo "use Illuminate\Support\Str;\n\n";

	echo "class {$class_name}Test extends TestCase\n";
	echo "{\n";
	
	foreach ($config['attributes'] as $attribute => $attribute_config) {
		print_setter_test($attribute, $attribute_config, $tag, true);
	}
	
	echo "}\n";
	
	if ($write) {
		$file_path = __DIR__.'/../../tests/Components/'.$class_name.'Test.php';
		file_put_contents($file_path, ob_get_clean());
		echo "Wrote $file_path\n";
	}
}
