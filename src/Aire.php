<?php

namespace Galahad\Aire;

use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;

class Aire
{
	/**
	 * @var \Illuminate\View\Factory
	 */
	protected $factory;
	
	public function __construct(Factory $factory)
	{
		$this->factory = $factory;
	}
	
	public function open() : Form
	{
		return new Form($this);
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
