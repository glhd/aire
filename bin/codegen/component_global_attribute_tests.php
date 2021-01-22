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

echo "namespace Galahad\Aire\Tests\Components;\n\n";

echo "use Illuminate\Support\Str;\n\n";

echo "class GlobalAttributesTest extends ComponentTestCase\n";
echo "{\n";

foreach ($global_attributes as $attribute => $attribute_config) {
	print_setter_test($attribute, $attribute_config, 'form', true);
}

echo "}\n";

if ($write) {
	$php = ob_get_clean();
	
	$file_path = __DIR__.'/../../tests/Components/GlobalAttributesTest.php';
	file_put_contents($file_path, $php);
	echo "Wrote $file_path\n";
}
