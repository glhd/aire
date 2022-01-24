<?php

namespace Galahad\Aire\Elements;

use Illuminate\Support\HtmlString;

class Button extends \Galahad\Aire\DTD\Button
{
	protected $opened = false;
	
	protected $grouped = false;
	
	protected $view_data = [
		'slot' => 'Submit',
	];
	
	public function open(): self
	{
		ob_start();
		
		$this->opened = true;
		
		return $this;
	}
	
	public function close(): self
	{
		$this->labelHtml(trim(ob_get_clean()));
		
		$this->opened = false;
		
		return $this;
	}
	
	public function label(string $label): self
	{
		$this->view_data['slot'] = $label;
		
		return $this;
	}
	
	public function labelHtml(string $html): self
	{
		$this->view_data['slot'] = new HtmlString($html);
		
		return $this;
	}
	
	public function render(): string
	{
		return $this->opened
			? ''
			: parent::render();
	}
}
