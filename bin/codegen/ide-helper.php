<?php

echo "<?php\n\n";
echo "namespace {\n";
echo "\tclass Aire extends \Galahad\Aire\Support\Facades\Aire {\n";

$classes = [
	\Galahad\Aire\Aire::class,
	\Galahad\Aire\Elements\Form::class,
];

foreach ($classes as $class) {
	$reflect = new ReflectionClass($class);
	$methods = $reflect->getMethods();
	
	foreach ($methods as $method) {
		
		if (!$method->isPublic()) {
			continue;
		}
		
		$name = $method->getName();
		
		if (0 === strpos($name, '__')) {
			continue;
		}
		
		$return = $method->hasReturnType()
			? $method->getReturnType()
			: 'mixed';
		
		$params = collect($method->getParameters())
			->map(function(ReflectionParameter $parameter) use ($class) {
				$signature = '$'.$parameter->getName();
				
				if ($parameter->hasType()) {
					$type = $parameter->getType();
					
					if ('self' === $type) {
						$type = $class;
					}
					
					$signature = "$type $signature";
				}
				
				if ($parameter->isDefaultValueAvailable()) {
					$default = str_replace(["\n", 'array ()'], ['', '[]'], var_export($parameter->getDefaultValue(), true));
					$signature = "$signature = $default";
				}
				
				return $signature;
			})
			->implode(', ');
		
		$param_calls = collect($method->getParameters())
			->map(function(ReflectionParameter $parameter) {
				return '$'.$parameter->getName();
			})
			->implode(', ');
		
		echo "\t\tpublic function $name($params)\n";
		echo "\t\t{\n";
		echo "\t\t\treturn \Galahad\Aire\Aire::$name($param_calls);\n";
		echo "\t\t}\n";
		echo "\t\t\n";
		
	}
}

echo "\t}\n";
echo "}\n";
