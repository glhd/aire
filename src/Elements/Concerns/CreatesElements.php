<?php

namespace Galahad\Aire\Elements\Concerns;

use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Checkbox;
use Galahad\Aire\Elements\CheckboxGroup;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Elements\Label;
use Galahad\Aire\Elements\Radio;
use Galahad\Aire\Elements\RadioGroup;
use Galahad\Aire\Elements\Select;
use Galahad\Aire\Elements\Summary;
use Galahad\Aire\Elements\Textarea;
use Galahad\Aire\Elements\Wysiwyg;

trait CreatesElements
{
	public function label(string $label) : Label
	{
		return (new Label($this->aire))->text($label);
	}
	
	public function button(string $label = null) : Button
	{
		$button = new Button($this->aire, $this);
		
		if ($label) {
			$button->label($label);
		}
		
		return $button;
	}
	
	public function submit(string $label = 'Submit') : Button
	{
		return $this->button($label)->type('submit');
	}
	
	public function input($name = null, $label = null) : Input
	{
		$input = new Input($this->aire, $this);
		
		if ($name) {
			$input->name($name);
		}
		
		if ($label) {
			$input->label($label);
		}
		
		return $input;
	}
	
	public function select(array $options, $name = null, $label = null) : Select
	{
		$select = new Select($this->aire, $options, $this);
		
		if ($name) {
			$select->name($name);
		}
		
		if ($label) {
			$select->label($label);
		}
		
		return $select;
	}
	
	public function textArea($name = null, $label = null) : Textarea
	{
		$textarea = new Textarea($this->aire, $this);
		
		if ($name) {
			$textarea->name($name);
		}
		
		if ($label) {
			$textarea->label($label);
		}
		
		return $textarea;
	}
	
	public function wysiwyg($name = null, $label = null) : Textarea
	{
		$textarea = new Wysiwyg($this->aire, $this);
		
		if ($name) {
			$textarea->name($name);
		}
		
		if ($label) {
			$textarea->label($label);
		}
		
		return $textarea;
	}
	
	public function summary() : Summary
	{
		return new Summary($this->aire);
	}
	
	public function checkbox($name = null, $label = null) : Checkbox
	{
		$checkbox = new Checkbox($this->aire, $this);
		
		if ($name) {
			$checkbox->name($name);
		}
		
		if ($label) {
			$checkbox->label($label);
		}
		
		return $checkbox;
	}
	
	public function checkboxGroup(array $options, $name, $label = null) : CheckboxGroup
	{
		$checkbox_group = new CheckboxGroup($this->aire, $options, $this);
		
		$checkbox_group->name(trim($name, '[]').'[]');
		
		if ($label) {
			$checkbox_group->label($label);
		}
		
		return $checkbox_group;
	}
	
	public function radioGroup(array $options, $name, $label = null) : RadioGroup
	{
		$radio_group = new RadioGroup($this->aire, $options, $this);
		
		$radio_group->name($name);
		
		if ($label) {
			$radio_group->label($label);
		}
		
		return $radio_group;
	}
}
