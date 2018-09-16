<?php

namespace Galahad\Aire;

use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;

class Aire
{
	/**
	 * @var \Illuminate\View\Factory
	 */
	protected $factory;
	
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	public function __construct(Factory $factory)
	{
		$this->factory = $factory;
	}
	
	public function open() : Form
	{
		$this->form = (new Form($this))->open();
		
		return $this->form;
	}
	
	public function close() : Form
	{
		return $this->form->close();
	}
	
	public function render($view, array $data = [], array $merge_data = []) : string
	{
		return $this->make($view, $data, $merge_data)->render();
	}
	
	protected function make($view, array $data = [], array $merge_data = []) : View
	{
		return $this->factory->make("aire::{$view}", $data, $merge_data);
	}
}
