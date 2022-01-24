<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Attributes\Collection;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Tests\TestCase;

class AttributeCollectionTest extends TestCase
{
	public function test_it_defers_to_primary_attributes_by_default(): void
	{
		$collection = new Collection($this->aire(), new Input($this->aire()));
		
		$collection->primary()->set('foo', 'bar');
		
		$this->assertEquals('bar', $collection->get('foo'));
	}
	
	public function test_it_instantiates_attributes_lazily(): void
	{
		$collection = new Collection($this->aire(), new Input($this->aire()));
		
		$collection->foo->set('bar', 'baz');
		
		$this->assertEquals('baz', $collection->foo->get('bar'));
		$this->assertInstanceOf(ClassNames::class, $collection->foo->get('class'));
	}
}
