<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Contracts\Support\Htmlable;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes;
	
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
	protected $attributes = [];
	
	/**
	 * @var array
	 */
	protected $data = [];
	
	/**
	 * @var array
	 */
	protected $merge_data = [];
	
	public function __construct(Aire $aire)
	{
		$this->aire = $aire;
	}
	
	public function toHtml()
	{
		return (string) $this;
	}
	
	public function __toString()
	{
		return $this->aire->render(
			$this->view,
			$this->viewData(),
			$this->merge_data
		);
	}
	
	protected function viewData()
	{
		return array_merge($this->data, $this->attributes, [
			'attributes' => $this->attributes,
		]);
	}
}
