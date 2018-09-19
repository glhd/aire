<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes,
		HasAriaAttributes;
	
	/**
	 * @var int
	 */
	protected static $id_suffix = 0;
	
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
		
		if ($aire->config('generate_missing_ids', true)) {
			$element_identifier = Str::snake(class_basename(static::class));
			$this->attributes['id'] = sprintf('aire_%s_%d', $element_identifier, self::$id_suffix);
			self::$id_suffix++;
		}
	}
	
	public function data($key, $value)
	{
		if (null === $value && isset($this->attributes["data-{$key}"])) {
			unset($this->attributes["data-{$key}"]);
		} else {
			$this->attributes["data-{$key}"] = $value;
		}
		
		return $this;
	}
	
	public function getAttribute($name, $default = null)
	{
		return $this->attributes[$name] ?? $default;
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
