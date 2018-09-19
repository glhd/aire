<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

abstract class FormElement extends Element
{
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	public function __construct(Aire $aire, Form $form = null)
	{
		parent::__construct($aire);
		
		$this->form = $form;
		
		if (method_exists($this, 'initGroup')) {
			$this->initGroup();
		}
	}
}
