<?php

namespace Galahad\Aire\Value;

use ArrayAccess;
use Illuminate\Session\Store;
use InvalidArgumentException;

class Defaults
{
	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session;
	
	/**
	 * @var \Illuminate\Database\Eloquent\Model|object|array
	 */
	protected $bound_data = [];
	
	public function __construct(Store $session)
	{
		$this->session = $session;
	}
	
	public function bind($bound_data) : self
	{
		$bound_data_is_array = $bound_data instanceof ArrayAccess || is_array($bound_data);
		$bound_data_is_object = is_object($bound_data);
		
		if (!$bound_data_is_array && !$bound_data_is_object) {
			throw new InvalidArgumentException('Data bound to a form must be an object, array, or implement ArrayAccess.');
		}
		
		$this->bound_data = $bound_data;
		
		return $this;
	}
	
	public function get($key, $default = null)
	{
		if ($this->session->hasOldInput($key)) {
			return $this->session->getOldInput($key);
		}
		
		return is_object($this->bound_data)
			? object_get($this->bound_data, $key, $default)
			: array_get($this->bound_data, $key, $default);
	}
}
