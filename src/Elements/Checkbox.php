<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Attributes\Attributes;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Illuminate\Support\Str;

class Checkbox extends Input
{
	public static $components = ['label', 'wrapper'];
	
	public $name = 'checkbox';
	
	protected $default_attributes = [
		'type' => 'checkbox',
		'value' => true,
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
		
		$this->view_data['label_attributes'] = tap(new Attributes(['class' => new ClassNames('checkbox_label', $this->group)]))
			->setDefault('for', function() {
				return $this->attributes->get('id');
			});
		
		$this->attributes->setDefault('checked', function() {
			if (!$name = $this->attributes->get('name')) {
				return null;
			}
			
			$bound_value = $this->form->getBoundValue($name);
			return $this->attributes->isValue($bound_value);
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
	
	protected function viewData() : array
	{
		$data = parent::viewData();
		
		if ($this->attributes->has('id')) {
			$data['label_for'] = $this->attributes->get('id');
		}
		
		return $data;
	}
}
