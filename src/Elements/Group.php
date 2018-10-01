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
	
	protected $view_data = [
		'prepend' => null,
		'append' => null,
	];
	
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
	
	public function helpText(string $text) : self
	{
		$this->view_data['help_text'] = $text;
		
		return $this;
	}
	
	public function prepend(string $text) : self
	{
		$this->view_data['prepend'] = $text;
		
		return $this;
	}
	
	public function append(string $text) : self
	{
		$this->view_data['append'] = $text;
		
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
