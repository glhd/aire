#!/usr/bin/env php
<?php

require_once __DIR__.'/../vendor/autoload.php';

$finder = \Symfony\Component\Finder\Finder::create()
	->files()
	->in(__DIR__.'/../src/Elements')
	->depth(0)
	->name('*.php');

$ignored_concerns = ['CreatesElements', 'CreatesInputTypes'];

$ignored_methods = collect($ignored_concerns)
	->flatMap(function($name) {
		return (new ReflectionClass("Galahad\\Aire\\Elements\\Concerns\\{$name}"))->getMethods();
	})
	->map(function(ReflectionMethod $method) {
		return $method->getName();
	})
	->values()
	->all();

collect($finder)
	->map(function(\Symfony\Component\Finder\SplFileInfo $file) {
		return 'Galahad\\Aire\\Elements\\'.$file->getBasename('.php');
	})
	->values()
	->filter(function($class_name) {
		return class_exists($class_name);
	})
	->map(function($class_name) {
		return new ReflectionClass($class_name);
	})
	->reject(function(ReflectionClass $class) {
		return $class->isAbstract();
	})
	->each(function(ReflectionClass $class) use ($ignored_methods) {
		$methods = collect($class->getMethods(ReflectionMethod::IS_PUBLIC))
			->keyBy(function(ReflectionMethod $method) {
				return $method->getName();
			})
			->reject(function(ReflectionMethod $method) {
				return $method->isStatic()
					|| $method->isAbstract()
					|| $method->getDeclaringClass()->getName() === 'Galahad\\Aire\\Elements\\Concerns\\CreatesElements'
					|| preg_match('/^(__|(get|set|has|is)[A-Z])/', $method->getName());
			})
			->except([
				'render',
				'toHtml',
				'hasViewData',
				'callMacro',
				'registerElement',
			])
			->except($ignored_methods);
		
		$properties = $methods->map(function(ReflectionMethod $method) {
			if (0 === $method->getNumberOfParameters()) {
				$type = '?bool ';
			} elseif ($method->getNumberOfParameters() > 1) {
				$type = '?array ';
			} else {
				$parameter = $method->getParameters()[0];
				if ($parameter->hasType()) {
					$type = '?'.$parameter->getType()->getName().' ';
				} else {
					$type = '';
				}
			}
			
			return (object) [
				'name' => $method->getName(),
				'type' => $type,
			];
		});
		
		// $props = $properties
		// 	->map(function($property) {
		// 		return "public {$property->type}\${$property->name} = null;";
		// 	})
		// 	->implode("\n\t\n\t");
		
		$params = $properties
			->map(function($property) {
				return "{$property->type}\${$property->name} = null";
			})
			->implode(",\n\t\t");
		
		$compact = $properties
			->map(function($property) {
				return "'{$property->name}'";
			})
			->implode(",\n\t\t\t");
		
		$name = class_basename($class->getName());
		
		$code = <<<PHP
<?php

namespace Galahad\Aire\Components;

use Galahad\\Aire\\Elements\\{$name} as {$name}Element; 

class {$name} extends ElementComponent
{
	public function __construct(
		{$params}
	) {
		\$this->createElement({$name}Element::class, compact(
			{$compact}
		));
	}
}

PHP;
		
		$filename = __DIR__.'/../src/Components/'.$name.'.php';
		
		if (!file_exists($filename)) {
			file_put_contents($filename, $code);
			echo "Wrote $filename\n";
		} else {
			echo "FILE ALREADY EXISTS: $filename\n\n";
			echo $code;
			echo "\n\n";
		}
		
	});
