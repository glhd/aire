<?php

namespace Galahad\Aire\Support;

use Galahad\Aire\Elements\Element;

/**
 * Theses are all the common variant use-cases, taken from
 * both Tailwind and Bootstrap.
 *
 * @method \Galahad\Aire\Elements\Element default()
 * @method \Galahad\Aire\Elements\Element xs()
 * @method \Galahad\Aire\Elements\Element sm()
 * @method \Galahad\Aire\Elements\Element lg()
 * @method \Galahad\Aire\Elements\Element xl()
 * @method \Galahad\Aire\Elements\Element gray()
 * @method \Galahad\Aire\Elements\Element red()
 * @method \Galahad\Aire\Elements\Element orange()
 * @method \Galahad\Aire\Elements\Element yellow()
 * @method \Galahad\Aire\Elements\Element green()
 * @method \Galahad\Aire\Elements\Element teal()
 * @method \Galahad\Aire\Elements\Element blue()
 * @method \Galahad\Aire\Elements\Element indigo()
 * @method \Galahad\Aire\Elements\Element purple()
 * @method \Galahad\Aire\Elements\Element pink()
 * @method \Galahad\Aire\Elements\Element primary()
 * @method \Galahad\Aire\Elements\Element secondary()
 * @method \Galahad\Aire\Elements\Element success()
 * @method \Galahad\Aire\Elements\Element danger()
 * @method \Galahad\Aire\Elements\Element warning()
 * @method \Galahad\Aire\Elements\Element info()
 * @method \Galahad\Aire\Elements\Element light()
 * @method \Galahad\Aire\Elements\Element dark()
 */
class HigherOrderVariantProxy
{
	/**
	 * @var \Galahad\Aire\Elements\Element
	 */
	protected $element;
	
	/**
	 * @var \Closure
	 */
	protected $apply;
	
	public function __construct(Element $element, \Closure $apply)
	{
		$this->element = $element;
		$this->apply = $apply;
	}
	
	public function __call($name, $arguments)
	{
		call_user_func($this->apply, $name);
		
		return $this->element;
	}
}
