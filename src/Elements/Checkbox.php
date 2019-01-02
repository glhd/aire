<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Support\Str;

class Checkbox extends Input
{
	public $name = 'checkbox';
	
	protected $default_attributes = [
		'type' => 'checkbox',
		'value' => '1',
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
		
		$this->attributes->registerMutator('checked', function($value) {
			if (null !== $value || !$this->attributes->has('name')) {
				return $value;
			}
			
			$checked_value = $this->attributes['value'];
			$bound_value = $this->form->getBoundValue($this->attributes->get('name'));
			
			return is_array($bound_value)
				? in_array($checked_value, $bound_value)
				: $checked_value === $bound_value;
		});
	}
	
	public function label(string $text) : self
	{
		$this->view_data['checkbox_label'] = $text;
		
		return $this;
	}
	
	public function name($value = null)
	{
		if (!isset($this->view_data['checkbox_label'])) {
			$this->label(Str::snake($value, ' '));
		}
		
		return parent::name($value);
	}
	
	public function defaultChecked(bool $default_checked = true) : self
	{
		$this->attributes->setDefault('checked', $default_checked);
		
		return $this;
	}
}
