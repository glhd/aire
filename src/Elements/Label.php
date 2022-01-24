<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\NonInput;
use Galahad\Aire\Elements\Attributes\ClassNames;

class Label extends \Galahad\Aire\DTD\Label implements NonInput
{
	/**
	 * @var \Galahad\Aire\Elements\Group
	 */
	public $group;
	
	public function __construct(Aire $aire, Group $group = null)
	{
		$this->group = $group;
		
		parent::__construct($aire);
		
		$this->attributes->setDefault('for', function() {
			return optional($this->group)->element->attributes->get('id');
		});
		
		$this->attributes->registerMutator('class', function(ClassNames $class_names) {
			if ($this->attributes->has('for')) {
				return $class_names->add('cursor-pointer');
			}
			
			return $class_names->remove('cursor-pointer');
		});
	}
	
	/**
	 * @param string|\Illuminate\Contracts\Support\Htmlable $text
	 * @return \Galahad\Aire\Elements\Label
	 */
	public function text($text): self
	{
		$this->view_data['text'] = __($text);
		
		return $this;
	}
	
	protected function applyVariantToGroup($variant): void
	{
		// Actually, don't.
	}
}
