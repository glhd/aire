<?php

namespace Galahad\Aire\Elements;

use Closure;
use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\NonInput;
use Galahad\Aire\DTD\Concerns\HasGlobalAttributes;
use Galahad\Aire\Elements\Attributes\Collection;
use Galahad\Aire\Elements\Concerns\Groupable;
use Galahad\Aire\Elements\Concerns\HasVariants;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\HigherOrderWhenProxy;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;

abstract class Element implements Htmlable
{
	use Groupable;
	use HasGlobalAttributes;
	use HasVariants;
	use Macroable {
		Groupable::__call insteadof Macroable;
		Macroable::__call as callMacro;
		Macroable::__callStatic as callStaticMacro;
	}
	
	protected static $element_mutators = [];
	
	/**
	 * @var string
	 */
	public $name;
	
	/**
	 * @var \Galahad\Aire\Elements\Attributes\Collection
	 */
	public $attributes;
	
	/**
	 * @var int
	 */
	public $element_id;
	
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	/**
	 * @var array
	 */
	protected $default_attributes;
	
	/**
	 * @var array
	 */
	protected $view_data = [];
	
	/**
	 * Should we bind the value by default
	 *
	 * @var bool
	 */
	protected $bind_value = true;
	
	public function __construct(Aire $aire, Form $form = null)
	{
		$this->aire = $aire;
		$this->element_id = $aire->generateElementId();
		
		if ($form) {
			$this->form = $form;
			$form->registerElement($this);
			$this->initGroup();
		}
		
		$this->attributes = new Collection($aire, $this, $this->default_attributes);
		
		$this->registerAttributeMutators();
		$this->applyElementMutators();
	}
	
	/**
	 * Register a mutator for the entire element
	 *
	 * This mutator will be called each time this element is instantiated.
	 * This is mostly useful for themes that need to apply changes to certain
	 * elements (when those changes are not possible thru configuration and
	 * custom views alone).
	 *
	 * @param callable $mutator
	 */
	public static function registerElementMutator(callable $mutator): void
	{
		self::$element_mutators[static::class][] = $mutator;
	}
	
	/**
	 * Set a data attribute
	 *
	 * @param string $data_key
	 * @param mixed $value
	 * @return $this
	 */
	public function data($data_key, $value): self
	{
		$key = "data-{$data_key}";
		
		if (null === $value) {
			if ($this->attributes->has($key)) {
				$this->attributes->unset($key);
			}
		} else {
			// JSON encode value if it's not a scalar
			if ($value instanceof Jsonable) {
				$value = $value->toJson();
			} elseif ($value instanceof JsonSerializable) {
				$value = json_encode($value->jsonSerialize());
			} elseif (is_array($value)) {
				$value = json_encode($value);
			} elseif ($value instanceof Arrayable) {
				$value = json_encode($value->toArray());
			}
			
			$this->attributes->set($key, $value);
		}
		
		return $this;
	}
	
	public function getInputName($default = null): ?string
	{
		$name = $this->attributes->get('name', $default);
		
		if (null === $name) {
			return null;
		}
		
		// Trim [] off non-associative array values
		if ('[]' === substr($name, -2)) {
			$name = substr($name, 0, -2);
		}
		
		// Then convert foo[bar][baz] to foo.bar.baz
		return preg_replace('/\[([^\]]+)\]/m', '.$1', $name);
	}
	
	public function setAttribute($key, $value): self
	{
		$this->attributes->set($key, $value);
		
		return $this;
	}
	
	public function addClass(...$class_name): self
	{
		$this->attributes['class']->add(...$class_name);
		
		return $this;
	}
	
	public function removeClass(...$class_name): self
	{
		$this->attributes['class']->remove(...$class_name);
		
		return $this;
	}
	
	/**
	 * Render the Element to HTML
	 *
	 * @return string
	 */
	public function render(): string
	{
		return $this->aire->render(
			$this->name,
			$this->viewData()
		);
	}
	
	/**
	 * Render to HTML, including group if appropriate
	 *
	 * @return string
	 */
	public function toHtml(): string
	{
		return $this->grouped && $this->group
			? $this->group->render()
			: $this->render();
	}
	
	/**
	 * Alias for toHtml()
	 *
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->toHtml();
	}
	
	/**
	 * Get either all the current view data or a specific key
	 *
	 * This is mostly useful for themes that need to customize behavior
	 * based on view data. It is NOT RECOMMENDED that you use this
	 * in day-to-day usage, as it will break if internal code is changed.
	 *
	 * @param string|null $key
	 * @return array|mixed
	 */
	public function getViewData(string $key = null)
	{
		if (null === $key) {
			return $this->view_data;
		}
		
		return Arr::get($this->view_data, $key);
	}
	
	/**
	 * Check if view data is set
	 *
	 * This is mostly useful for themes that need to customize behavior
	 * based on view data. It is NOT RECOMMENDED that you use this
	 * in day-to-day usage, as it will break if internal code is changed.
	 *
	 * @param string $key
	 * @return bool
	 */
	public function hasViewData(string $key): bool
	{
		return Arr::has($this->view_data, $key);
	}
	
	public function when($value = null, callable $callback = null, callable $default = null)
	{
		$value = $value instanceof Closure
			? $value($this)
			: $value;
		
		if (version_compare(App::version(), '9.0.0', '>=')) {
			if (func_num_args() === 0) {
				return new HigherOrderWhenProxy($this);
			}
			
			if (func_num_args() === 1) {
				return (new HigherOrderWhenProxy($this))->condition($value);
			}
		}
		
		if ($value) {
			return $callback($this, $value) ?? $this;
		} elseif ($default) {
			return $default($this, $value) ?? $this;
		}
		
		return $this;
	}
	
	public function unless($value = null, callable $callback = null, callable $default = null)
	{
		$value = $value instanceof Closure
			? $value($this)
			: $value;
		
		if (version_compare(App::version(), '9.0.0', '>=')) {
			if (func_num_args() === 0) {
				return (new HigherOrderWhenProxy($this))->negateConditionOnCapture();
			}
			
			if (func_num_args() === 1) {
				return (new HigherOrderWhenProxy($this))->condition(!$value);
			}
		}
		
		if (!$value) {
			return $callback($this, $value) ?? $this;
		} elseif ($default) {
			return $default($this, $value) ?? $this;
		}
		
		return $this;
	}
	
	/**
	 * Get the Element's view data
	 *
	 * @return array
	 */
	protected function viewData(): array
	{
		return array_merge(
			$this->attributes->primary()->toArray(), // Provide shortcuts to all attributes
			$this->view_data, // Override with view data
			[
				'attributes' => $this->attributes, // Ensure that $attributes always exists
				'validate' => $this->form ? $this->form->validate : false, // Set validation flag
			]
		);
	}
	
	/**
	 * Apply any registered mutators to the element
	 *
	 * @return \Galahad\Aire\Elements\Element
	 */
	protected function applyElementMutators(): self
	{
		if (isset(static::$element_mutators[static::class])) {
			foreach (static::$element_mutators[static::class] as $mutator) {
				$mutator($this);
			}
		}
		
		return $this;
	}
	
	/**
	 * Register default attribute mutators
	 *
	 * @return \Galahad\Aire\Elements\Element
	 */
	protected function registerAttributeMutators(): self
	{
		// Certain default bindings only should apply to elements that are
		// inputs bound to a form
		if ($this->form && !$this instanceof NonInput) {
			if ($this->bind_value) {
				$this->attributes->setDefault('value', function() {
					return $this->form->getBoundValue($this->getInputName());
				});
			}
			
			$this->attributes->setDefault('x-model', function() {
				return $this->form->isAlpineComponent()
					? $this->getInputName()
					: null;
			});
		}
		
		// TODO: We may want to generate internal IDs to use here if no name exists
		$this->attributes->registerMutator('data-aire-for', function() {
			return $this->getInputName();
		});
		
		return $this;
	}
}
