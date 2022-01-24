<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\HasJsonValue;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Checkbox extends Input implements HasJsonValue
{
	public $name = 'checkbox';
	
	protected $default_attributes = [
		'type' => 'checkbox',
		'value' => true,
	];
	
	protected $view_data = [
		'label_text' => '',
	];
	
	/**
	 * Checkboxes shouldn't bind data—they use the "checked" attribute instead
	 *
	 * @var bool
	 */
	protected $bind_value = false;
	
	public function __construct(Aire $aire, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->attributes->label->setDefault('for', function() {
			return $this->attributes->get('id');
		});
		
		$this->attributes->setDefault('checked', function() {
			if (!$this->form->hasBoundData()) {
				return null;
			}
			
			return $this->attributes->isValue($this->form->getBoundValue($this->getInputName()));
		});
	}
	
	public function getJsonValue()
	{
		return $this->attributes->get('checked');
	}
	
	public function label($text): self
	{
		$this->view_data['label_text'] = $text;
		
		return $this;
	}
	
	public function labelHtml($html): self
	{
		return $this->label(new HtmlString($html));
	}
	
	public function name($value = null)
	{
		if (!isset($this->view_data['label_text'])) {
			$this->label(ucfirst(Str::snake($value, ' ')));
		}
		
		return parent::name($value);
	}
	
	public function defaultChecked(bool $default_checked = true): self
	{
		$this->attributes->setDefault('checked', $default_checked);
		
		return $this;
	}
}
