<?php

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

echo "namespace Galahad\Aire\DTD\Concerns;\n\n";

echo "use Galahad\Aire\Elements\Element;\n\n";

echo "trait HasGlobalAttributes\n";
echo "{\n";

foreach ($global_attributes as $attribute => $attribute_config) {
	print_setter($attribute, $attribute_config);
}

echo "}\n";

if ($write) {
	$php = ob_get_clean();
	
	$file_path = __DIR__.'/../../src/DTD/Concerns/HasGlobalAttributes.php';
	file_put_contents($file_path, $php);
	echo "Wrote $file_path\n";
}
