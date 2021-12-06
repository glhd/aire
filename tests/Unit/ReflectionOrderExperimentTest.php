<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Form;
use Galahad\Aire\Tests\TestCase;
use ReflectionClass;
use ReflectionMethod;

class ReflectionOrderExperimentTest extends TestCase
{
	public function test_method_order() : void
	{
		$this->assertReflectionOrder(new QuickTestA(), ['da', 'ca', 'ba', 'aa']);
		$this->assertReflectionOrder(new QuickTestB(), ['ca', 'ab', 'bb', 'da', 'ba', 'aa']);
		$this->assertReflectionOrder(new QuickTestE(), ['ca', 'ab', 'bb', 'da', 'ba', 'aa', 'bc', 'ac', 'cc', 'ad', 'bd']);
		$this->assertReflectionOrder(new QuickTestF(), ['ca', 'ab', 'bb', 'da', 'ba', 'aa', 'bc', 'ac', 'cc', 'ad', 'bd']);
		$this->assertReflectionOrder(new QuickTestG(), ['ca', 'ab', 'bb', 'da', 'ba', 'aa', 'ad', 'bd', 'bc', 'ac', 'cc']);
		$this->assertReflectionOrder(new QuickTestH(), ['ca', 'ab', 'bb', 'da', 'ba', 'aa', 'ad', 'bd', 'bc', 'ac', 'cc']);
	}
	
	protected function assertReflectionOrder($object, array $expected)
	{
		$methods = array_map(
			function(ReflectionMethod $method) {
				return $method->getName();
			},
			(new ReflectionClass($object))->getMethods()
		);
		
		$this->assertEquals($expected, $methods);
	}
}

class QuickTestA
{
	public function da()
	{
		//
	}
	
	public function ca()
	{
		//
	}
	
	public function ba()
	{
		//
	}
	
	public function aa()
	{
		//
	}
}

class QuickTestB extends QuickTestA
{
	public function ca()
	{
		//
	}
	
	public function ab()
	{
		//
	}
	
	public function bb()
	{
		//
	}
}

trait QuickTestC
{
	public function da()
	{
		//
	}
	
	public function bc()
	{
		//
	}
	
	public function ac()
	{
		//
	}
	
	public function cc()
	{
		//
	}
}

trait QuickTestD
{
	public function da()
	{
		//
	}
	
	public function ad()
	{
		//
	}
	
	public function bd()
	{
		//
	}
}

class QuickTestE extends QuickTestB
{
	use QuickTestC, QuickTestD {
		QuickTestD::da insteadof QuickTestC;
	}
}

class QuickTestF extends QuickTestB
{
	use QuickTestC, QuickTestD {
		QuickTestC::da insteadof QuickTestD;
	}
}

class QuickTestG extends QuickTestB
{
	use QuickTestD, QuickTestC {
		QuickTestD::da insteadof QuickTestC;
	}
}

class QuickTestH extends QuickTestB
{
	use QuickTestD, QuickTestC {
		QuickTestC::da insteadof QuickTestD;
	}
}
