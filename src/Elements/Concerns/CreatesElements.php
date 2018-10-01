<?php

namespace Galahad\Aire\Elements\Concerns;

use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Elements\Label;
use Galahad\Aire\Elements\Textarea;

trait CreatesElements
{
	public function label(string $label) : Label
	{
		return (new Label($this->aire))->text($label);
	}
	
	public function button(string $label) : Button
	{
		return (new Button($this->aire, $this))->label($label);
	}
	
	public function submit(string $label) : Button
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
	
	public function textarea($name = null, $label = null) : Textarea
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
}
