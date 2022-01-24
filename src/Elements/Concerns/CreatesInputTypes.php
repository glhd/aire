<?php

namespace Galahad\Aire\Elements\Concerns;

use Galahad\Aire\Elements\Input;

trait CreatesInputTypes
{
	abstract public function input($name = null, $label = null, $type = null): Input;
	
	/**
	 * Create <input type="hidden"> element
	 *
	 * @param string|null $name
	 * @param mixed $value
	 * @return \Galahad\Aire\Elements\Input
	 */
	public function hidden($name = null, $value = null): Input
	{
		$input = $this->input($name);
		
		$input->type('hidden');
		
		if ($value) {
			$input->value($value);
		}
		
		return $input;
	}
	
	public function color($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('color');
		
		return $input;
	}
	
	public function date($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('date');
		
		return $input;
	}
	
	public function dateTime($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('datetime');
		
		return $input;
	}
	
	public function dateTimeLocal($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('datetime-local');
		
		return $input;
	}
	
	public function email($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('email');
		
		return $input;
	}
	
	public function file($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('file');
		
		return $input;
	}
	
	public function image($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('image');
		
		return $input;
	}
	
	public function month($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('month');
		
		return $input;
	}
	
	public function number($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('number');
		
		return $input;
	}
	
	public function password($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('password');
		
		return $input;
	}
	
	public function range($name = null, $label = null, $min = 0, $max = 100): Input
	{
		return $this->input($name, $label)
			->type('range')
			->min($min)
			->max($max);
	}
	
	public function search($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('search');
		
		return $input;
	}
	
	public function tel($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('tel');
		
		return $input;
	}
	
	public function time($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('time');
		
		return $input;
	}
	
	public function url($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('url');
		
		return $input;
	}
	
	public function week($name = null, $label = null): Input
	{
		$input = $this->input($name, $label);
		
		$input->type('week');
		
		return $input;
	}
}
