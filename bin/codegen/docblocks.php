<?php

use Barryvdh\Reflection\DocBlock;
use Galahad\Aire\Elements\Element;

echo "/**\n";

$classes = [
	\Galahad\Aire\Aire::class,
	// \Galahad\Aire\Elements\Form::class,
	\Galahad\Aire\Elements\Concerns\CreatesElements::class,
	\Galahad\Aire\Elements\Concerns\CreatesInputTypes::class,
];

$element_reflect = new ReflectionClass(Element::class);

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
		
		if ($element_reflect->hasMethod($name)) {
			continue;
		}
		
		$phpdoc = new DocBlock($method, new DocBlock\Context($reflect->getNamespaceName()));
		
		$return = $method->hasReturnType()
			? (string) $method->getReturnType()
			: 'mixed';
		
		if ('mixed' === $return && ($phpdoc_return = $phpdoc->getTagsByName('return'))) {
			$return = $phpdoc_return[0]->getContent();
		}
		
		if ('self' === $return || '$this' === $return) {
			$return = $class;
		}
		
		if (false !== strpos($return, '\\')) {
			$return = "\\$return";
		}
		
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
		
		echo " * @method static $return $name($params)\n";
		
	}
}

echo " */\n";
