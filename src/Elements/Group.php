<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Support\HtmlString;

class Group extends FormElement
{
	/**
	 * @var \Galahad\Aire\Elements\GroupableElement
	 */
	public $element;
	
	/**
	 * @var \Galahad\Aire\Elements\Label
	 */
	public $label;
	
	protected $view = 'group';
	
	public function __construct(Aire $aire, Form $form, FormElement $element)
	{
		parent::__construct($aire, $form);
		
		$this->element = $element;
	}
	
	public function label(string $text) : self
	{
		$this->label = $this->form->label($text);
		
		if ($id = $this->element->getAttribute('id')) {
			$this->label->for($id);
		}
		
		return $this;
	}
	
	protected function viewData()
	{
		return array_merge(parent::viewData(), [
			'label' => $this->label,
			'element' => new HtmlString($this->element->renderInsideElement()),
		]);
	}
}
