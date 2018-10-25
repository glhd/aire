<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Support\HtmlString;

class Group extends Element
{
	/**
	 * Not valid nor invalid
	 */
	public const VALIDATION_NONE = 'none';
	
	/**
	 * Invalid data
	 */
	public const VALIDATION_INVALID = 'invalid';
	
	/**
	 * Valid data
	 */
	public const VALIDATION_VALID = 'valid';
	
	/**
	 * @var string
	 */
	public $name = 'group';
	
	/**
	 * @var \Galahad\Aire\Elements\Element|\Galahad\Aire\Elements\Concerns\Groupable
	 */
	public $element;
	
	/**
	 * @var \Galahad\Aire\Elements\Label
	 */
	public $label;
	
	/**
	 * @var string
	 */
	public $validation_state = self::VALIDATION_NONE;
	
	/**
	 * @var array
	 */
	protected $view_data = [
		'prepend' => null,
		'append' => null,
	];
	
	protected $grouped = false;
	
	public function __construct(Aire $aire, Form $form, Element $element)
	{
		parent::__construct($aire, $form);
		
		$this->element = $element;
	}
	
	public function label(string $text) : self
	{
		$this->label = (new Label($this->aire, $this))->text($text);
		
		if ($id = $this->element->attributes->get('id')) {
			$this->label->for($id);
		}
		
		return $this;
	}
	
	public function helpText(string $text) : self
	{
		$this->view_data['help_text'] = $text;
		
		return $this;
	}
	
	public function validated($validation_state = self::VALIDATION_VALID) : self
	{
		$this->validation_state = $validation_state;
		
		return $this;
	}
	
	public function valid() : self
	{
		return $this->validated(self::VALIDATION_VALID);
	}
	
	public function invalid() : self
	{
		return $this->validated(self::VALIDATION_INVALID);
	}
	
	public function errors($message) : self
	{
		$this->view_data['errors'] = (array) $message;
		
		$this->invalid();
		
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
		$errors = [];
		if ($name = $this->element->getAttribute('name')) {
			$errors = $this->form->getErrors($name);
			if (!empty($errors)) {
				$this->invalid();
			}
		}
		
		return array_merge(parent::viewData(), [
			'label' => $this->label,
			'element' => new HtmlString($this->element->render()),
			'errors' => $errors,
		]);
	}
	
	protected function initGroup()
	{
		// Ignore
	}
}
