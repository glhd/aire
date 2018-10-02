<?php

use Galahad\Aire\Elements\Group;

echo "/**\n";

$reflect = new ReflectionClass(Group::class);
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
	
	if ('self' === "$return") {
		$return = '\\'.Group::class;
	} else if ($return instanceof ReflectionType && !$return->isBuiltin()) {
		$return = "\\$return";
	}
	
	$params = collect($method->getParameters())
		->map(function(ReflectionParameter $parameter) {
			$signature = '$'.$parameter->getName();
			
			if ($type = $parameter->getType()) {
				$signature = "$type $signature";
				
				// if ($type->allowsNull()) {
				// 	$signature = "?$signature";
				// }
			}
			
			if ($parameter->isDefaultValueAvailable()) {
				$default = str_replace(["\n", 'array ()'], ['', '[]'], var_export($parameter->getDefaultValue(), true));
				$signature = "$signature = $default";
			}
			
			return $signature;
		})
		->implode(', ');
	
	$shortcut_name = 'group'.studly_case($name);
	
	echo " * @method $return $name($params)\n";
	echo " * @method $return $shortcut_name($params)\n";
	
}

echo " */\n";
