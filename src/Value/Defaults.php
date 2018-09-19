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
	
	/**
	 * Defaults constructor.
	 *
	 * @param \Illuminate\Session\Store $session
	 */
	public function __construct(Store $session)
	{
		$this->session = $session;
	}
	
	/**
	 * Bind data to the form defaults
	 *
	 * @param \Illuminate\Database\Eloquent\Model|object|array $bound_data
	 * @return \Galahad\Aire\Value\Defaults
	 */
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
	
	/**
	 * Get the bound value
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
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
