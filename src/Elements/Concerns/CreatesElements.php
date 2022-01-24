<?php

namespace Galahad\Aire\Elements\Concerns;

use DateTimeZone;
use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Checkbox;
use Galahad\Aire\Elements\CheckboxGroup;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Elements\Label;
use Galahad\Aire\Elements\RadioGroup;
use Galahad\Aire\Elements\Select;
use Galahad\Aire\Elements\Summary;
use Galahad\Aire\Elements\Textarea;
use Galahad\Aire\Elements\Wysiwyg;
use Galahad\Aire\Support\TimezonesCollection;
use Illuminate\Support\Str;

trait CreatesElements
{
	/**
	 * Create a <label> element
	 *
	 * @param string $label
	 * @return \Galahad\Aire\Elements\Label
	 */
	public function label(string $label): Label
	{
		return (new Label($this->aire))->text($label);
	}
	
	/**
	 * Create a <button> element
	 *
	 * @param string|null $label
	 * @return \Galahad\Aire\Elements\Button
	 */
	public function button(string $label = null): Button
	{
		$button = new Button($this->aire, $this);
		
		if ($label) {
			$button->label($label);
		}
		
		return $button;
	}
	
	/**
	 * Create a <button type="submit"> element
	 *
	 * @param string $label
	 * @return \Galahad\Aire\Elements\Button
	 */
	public function submit(string $label = 'Submit'): Button
	{
		return $this->button($label)->type('submit');
	}
	
	/**
	 * Create an <input>
	 *
	 * @param string|null $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @param string|null $type
	 * @return \Galahad\Aire\Elements\Input
	 */
	public function input($name = null, $label = null, $type = null): Input
	{
		$input = new Input($this->aire, $this);
		
		if ($name) {
			$input->name((string) $name);
		}
		
		if ($label) {
			$input->label($label);
		}
		
		if ($type) {
			$input->type((string) $type);
		}
		
		return $input;
	}
	
	/**
	 * Create a <select> element
	 *
	 * @param array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options
	 * @param string|null $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @return \Galahad\Aire\Elements\Select
	 */
	public function select($options, $name = null, $label = null): Select
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
	
	/**
	 * Create a <select> element populated with all the timezone identifiers listed by DateTimeZone
	 *
	 * @param string|null $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @return \Galahad\Aire\Elements\Select
	 */
	public function timezoneSelect($name = null, $label = null): Select
	{
		return $this->select(new TimezonesCollection(), $name, $label);
	}
	
	/**
	 * Create a <textarea> element
	 *
	 * @param string|null $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @return \Galahad\Aire\Elements\Textarea
	 */
	public function textArea($name = null, $label = null): Textarea
	{
		$textarea = new Textarea($this->aire, $this);
		
		if ($name) {
			$textarea->name((string) $name);
		}
		
		if ($label) {
			$textarea->label($label);
		}
		
		return $textarea;
	}
	
	/**
	 * Create a <textarea> element meant for WYSIWYG use (using JavaScript)
	 *
	 * @param string|null $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @return \Galahad\Aire\Elements\Textarea
	 */
	public function wysiwyg($name = null, $label = null): Textarea
	{
		$textarea = new Wysiwyg($this->aire, $this);
		
		if ($name) {
			$textarea->name((string) $name);
		}
		
		if ($label) {
			$textarea->label($label);
		}
		
		return $textarea;
	}
	
	/**
	 * Create a summary view, which will show if there are errors
	 *
	 * @param bool $verbose
	 * @return \Galahad\Aire\Elements\Summary
	 */
	public function summary(?bool $verbose = null): Summary
	{
		$summary = new Summary($this->aire, $this);
		
		if (null !== $verbose) {
			$summary->verbose($verbose);
		}
		
		return $summary;
	}
	
	/**
	 * Create a single <input type="checkbox"> element
	 *
	 * @param string|null $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @return \Galahad\Aire\Elements\Checkbox
	 */
	public function checkbox($name = null, $label = null): Checkbox
	{
		$checkbox = new Checkbox($this->aire, $this);
		
		if ($name) {
			$checkbox->name((string) $name);
		}
		
		if ($label) {
			$checkbox->label($label);
		}
		
		return $checkbox;
	}
	
	/**
	 * Create a group of <input type="checkbox"> elements
	 *
	 * @param array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options
	 * @param string $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @return \Galahad\Aire\Elements\CheckboxGroup
	 */
	public function checkboxGroup($options, $name, $label = null): CheckboxGroup
	{
		$checkbox_group = new CheckboxGroup($this->aire, $options, $this);
		
		if (!Str::endsWith($name, '[]')) {
			$name .= '[]';
		}
		
		$checkbox_group->name($name);
		
		if ($label) {
			$checkbox_group->label($label);
		}
		
		return $checkbox_group;
	}
	
	/**
	 * Create a group of <input type="radio"> elements
	 *
	 * @param array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options
	 * @param string $name
	 * @param string|\Illuminate\Contracts\Support\Htmlable|null $label
	 * @return \Galahad\Aire\Elements\RadioGroup
	 */
	public function radioGroup($options, $name, $label = null): RadioGroup
	{
		$radio_group = new RadioGroup($this->aire, $options, $this);
		
		$radio_group->name($name);
		
		if ($label) {
			$radio_group->label($label);
		}
		
		return $radio_group;
	}
}
