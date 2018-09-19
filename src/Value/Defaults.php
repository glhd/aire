<?php

namespace Galahad\Aire\Value;

use Illuminate\Http\Request;

class Defaults
{
	/**
	 * @var \Illuminate\Http\Request
	 */
	protected $request;
	
	/**
	 * @var \Illuminate\Database\Eloquent\Model|object|array
	 */
	protected $bound_data = [];
	
	public function __construct(Request $request)
	{
		$this->request = $request;
		
		// return app('request')->old($key, $default);
	}
	
	public function bind($bound_data) : self
	{
		$this->bound_data = $bound_data;
		
		return $this;
	}
}
