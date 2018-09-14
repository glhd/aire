<?php

namespace Galahad\Aire;

use Illuminate\Contracts\Support\Htmlable;

class Element implements Htmlable
{
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var string
	 */
	protected $view;
	
	/**
	 * @var array
	 */
	protected $data = [];
	
	/**
	 * @var array
	 */
	protected $merge_data = [];
	
	public function __construct(string $view, Aire $aire)
	{
		$this->view = $view;
		$this->aire = $aire;
	}
	
	public function toHtml()
	{
		return (string) $this;
	}
	
	public function __toString()
	{
		return $this->aire->render($this->view, $this->data, $this->merge_data);
	}
}
