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

echo "namespace Galahad\Aire\Tests\DTD;\n\n";

echo "use Galahad\Aire\Tests\TestCase;\n\n";

echo "class GlobalAttributesTest extends TestCase\n";
echo "{\n";

foreach ($global_attributes as $attribute => $attribute_config) {
	$is_flag = isset($attribute_config['type']) && 'flag' === $attribute_config['type'];
	$is_bool = isset($attribute_config['type']) && 'boolean' === $attribute_config['type'];
	$test_name = $attribute_config['spellings']->snake;
	$method = $attribute_config['spellings']->camel;
	
	if ($is_flag) {
		
		echo "\tpublic function test_{$test_name}_flag_can_be_set_on_and_off() : void\n";
		echo "\t{\n";
		echo "\t\t\$form = \$this->aire()->form();\n";
		echo "\t\t\n";
		echo "\t\t\$form->$method();\n";
		echo "\t\t\$this->assertSelectorAttribute(\$form, 'form', '$attribute');\n";
		echo "\t\t\n";
		echo "\t\t\$form->$method(false);\n";
		echo "\t\t\$this->assertSelectorAttributeMissing(\$form, 'form', '$attribute');\n";
		echo "\t}\n";
		echo "\t\n";
		
	} else if ($is_bool) {
		
		echo "\tpublic function test_{$test_name}_boolean_can_be_set_to_true_and_false_and_be_unset() : void\n";
		echo "\t{\n";
		echo "\t\t\$form = \$this->aire()->form();\n";
		echo "\t\t\n";
		echo "\t\t\$form->$method();\n";
		echo "\t\t\$this->assertSelectorAttribute(\$form, 'form', '$attribute', 'true');\n";
		echo "\t\t\n";
		echo "\t\t\$form->$method(false);\n";
		echo "\t\t\$this->assertSelectorAttribute(\$form, 'form', '$attribute', 'false');\n";
		echo "\t\t\n";
		echo "\t\t\$form->$method(null);\n";
		echo "\t\t\$this->assertSelectorAttributeMissing(\$form, 'form', '$attribute');\n";
		echo "\t}\n";
		echo "\t\n";
		
	} else {
		
		echo "\tpublic function test_{$test_name}_attribute_can_be_set_and_unset() : void\n";
		echo "\t{\n";
		
		echo "\t\t\$form = \$this->aire()->form();\n";
		echo "\t\t\n";
		
		if (isset($attribute_config['attribOption'])) {
			foreach ($attribute_config['attribOption'] as $value) {
				$value = addslashes($value);
				echo "\t\t\$form->$method('$value');\n";
				echo "\t\t\$this->assertSelectorAttribute(\$form, 'form', '$attribute', '$value');\n";
				echo "\t\t\n";
			}
		} else {
			echo "\t\t\$value = str_random();\n";
			echo "\t\t\n";
			echo "\t\t\$form->$method(\$value);\n";
			echo "\t\t\$this->assertSelectorAttribute(\$form, 'form', '$attribute', \$value);\n";
			echo "\t\t\n";
		}
		
		echo "\t\t\$form->$method(null);\n";
		echo "\t\t\$this->assertSelectorAttributeMissing(\$form, 'form', '$attribute');\n";
		echo "\t}\n";
		echo "\t\n";
		
	}
}

echo "}\n";

if ($write) {
	$php = ob_get_clean();
	
	$file_path = __DIR__.'/../../tests/DTD/GlobalAttributesTest.php';
	file_put_contents($file_path, $php);
	echo "Wrote $file_path\n";
}
