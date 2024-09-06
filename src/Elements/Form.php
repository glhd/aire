<?php

namespace Galahad\Aire\Elements;

use BadMethodCallException;
use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\BindsToForm;
use Galahad\Aire\Contracts\HasJsonValue;
use Galahad\Aire\Contracts\NonInput;
use Galahad\Aire\Elements\Concerns\CreatesElements;
use Galahad\Aire\Elements\Concerns\CreatesInputTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;
use stdClass;

class Form extends \Galahad\Aire\DTD\Form implements NonInput
{
	use CreatesElements;
	use CreatesInputTypes;
	
	/**
	 * Data that's bound to the form
	 *
	 * @var object|\Illuminate\Database\Eloquent\Model|array
	 */
	public $bound_data;
	
	/**
	 * Forms are validated by default
	 *
	 * @var bool
	 */
	public $validate = true;
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validation_rules = [];
	
	/**
	 * Custom validation messages
	 *
	 * @var array
	 */
	public $validation_messages = [];
	
	/**
	 * @inheritdoc
	 */
	protected $default_attributes = [
		'action' => '',
		'method' => 'POST',
		'fields' => null,
	];
	
	/**
	 * Forms are not grouped
	 *
	 * @var bool
	 */
	protected $grouped = false;
	
	/**
	 * Forms can either be open or closed, which determines how it's rendered
	 *
	 * @var bool
	 */
	protected $opened = false;
	
	/**
	 * @var \Galahad\Aire\Elements\Button
	 */
	protected $pending_button;
	
	/**
	 * @var \Illuminate\Routing\UrlGenerator
	 */
	protected $url;
	
	/**
	 * @var \Illuminate\Routing\Router
	 */
	protected $router;
	
	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session_store;
	
	/**
	 * Class name of the associated FormRequest object
	 *
	 * @var string
	 */
	protected $form_request;
	
	/**
	 * Custom error bag
	 *
	 * @var string
	 */
	protected $error_bag = 'default';
	
	/**
	 * Set to true to load development versions of JS
	 *
	 * @var bool
	 */
	protected $dev_mode = false;
	
	/**
	 * If true, we'll set up x-data and x-model attributes for Alpine.js
	 * @see https://github.com/alpinejs/alpine
	 *
	 * @var bool
	 */
	protected $is_alpine_component = false;
	
	/**
	 * We'll store a reference to all the elements created in the form
	 * so that if we need to serialize them for Alpine we can.
	 *
	 * @var array
	 */
	protected $json_serializable_elements = [];
	
	/**
	 * Called when the form is closed
	 *
	 * @var callable
	 */
	protected $on_close;
	
	public function __construct(Aire $aire, UrlGenerator $url, Router $router = null, Store $session_store = null)
	{
		parent::__construct($aire);
		
		$this->url = $url;
		$this->router = $router;
		
		if ($session_store) {
			$this->session_store = $session_store;
			$this->view_data['_token'] = $session_store->token();
		}
		
		$this->initValidation();
	}
	
	public function registerElement(Element $element): self
	{
		if ($element instanceof HasJsonValue) {
			$this->json_serializable_elements[] = $element;
		}
		
		return $this;
	}
	
	/**
	 * Enable dev mode
	 *
	 * @param bool $dev_mode
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function dev(bool $dev_mode = true): self
	{
		$this->dev_mode = $dev_mode;
		
		return $this;
	}
	
	/**
	 * Bind data to the form
	 *
	 * This data will automatically be used to determine an Element's
	 * value if a value is not set, and no old input exists
	 *
	 * @param $bound_data
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function bind($bound_data): self
	{
		$this->bound_data = $bound_data;
		
		return $this;
	}
	
	/**
	 * Bind data with implicit resource controller routing
	 *
	 * Form::resourceful(new User()) -> POST route('users.store')
	 * Form::resourceful($existing_user) -> PUT route('users.update')
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @param string $resource_name
	 * @param array $prepend_parameters
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function resourceful(Model $model, $resource_name = null, $prepend_parameters = []): self
	{
		$this->bind($model);
		
		if (null === $resource_name) {
			$resource_name = Str::kebab(Str::plural($model->getTable()));
		}
		
		if ($model->exists) {
			$parameters = (array) $prepend_parameters;
			$parameters[] = $model;
			
			$this->action($this->url->route("{$resource_name}.update", $parameters));
			$this->put();
		} else {
			$this->action($this->url->route("{$resource_name}.store", $prepend_parameters));
			$this->post();
		}
		
		return $this;
	}
	
	/**
	 * Configure the form for use as an Alpine.js component
	 *
	 * @see https://github.com/alpinejs/alpine
	 *
	 * @param bool|array $x_data
	 * @return $this
	 */
	public function asAlpineComponent($x_data = []): self
	{
		$this->is_alpine_component = is_array($x_data) || $x_data;
		
		$this->attributes->registerMutator('x-data', function() use ($x_data) {
			if (!$this->isAlpineComponent()) {
				return null;
			}
			
			$data = [];
			
			collect($this->json_serializable_elements)
				->reject(function(Element $element) {
					return empty($element->getInputName());
				})
				->each(function(Element $element) use (&$data) {
					Arr::set($data, $element->getInputName(), $element->getJsonValue());
				});
			
			return json_encode(array_merge($data, $x_data));
		});
		
		return $this;
	}
	
	/**
	 * Determine whether the form is configured as an Alpine.js component
	 *
	 * @see https://github.com/alpinejs/alpine
	 *
	 * @return bool
	 */
	public function isAlpineComponent(): bool
	{
		return $this->is_alpine_component;
	}
	
	/**
	 * Determine whether the form has any bound data
	 *
	 * @return bool
	 */
	public function hasBoundData(): bool
	{
		return null !== $this->bound_data
			or ($this->session_store && $this->session_store->hasOldInput());
	}
	
	/**
	 * Get the bound value for an Element
	 *
	 * @param $name
	 * @param null $default
	 * @return mixed|null
	 */
	public function getBoundValue($name, $default = null)
	{
		if (empty($name)) {
			return value($default);
		}
		
		// Convert bracket-notation to dot-notation
		$name = preg_replace('/\[([^]]+)]/', '.$1', $name);
		
		// If old input is set, use that
		if ($this->session_store && ($old = $this->session_store->getOldInput()) && Arr::has($old, $name)) {
			return Arr::get($old, $name) ?? '';
		}
		
		// If form has bound data, use that
		$bound_data = $this->bound_data instanceof BindsToForm
			? $this->bound_data->getAireFormData()
			: $this->bound_data;
		
		if ($bound_data) {
			$not_bound = new stdClass();
			
			$bound_value = is_object($bound_data)
				? object_get($bound_data, $name, $not_bound)
				: Arr::get($bound_data, $name, $not_bound);
			
			if (function_exists('enum_exists') && $bound_value instanceof \BackedEnum) {
				$bound_value = $bound_value->value;
			}
			
			if ($bound_value !== $not_bound) {
				return $bound_value;
			}
		}
		
		return value($default);
	}
	
	/**
	 * Get any validation errors associated with an Element
	 *
	 * @param ?string $name
	 * @return MessageBag|array
	 */
	public function getErrors(string $name = null)
	{
		$errors = $this->session_store
			->get('errors', new ViewErrorBag())
			->getBag($this->error_bag);
		
		return $name ? $errors->get($name) : $errors;
	}
	
	/**
	 * Open the form
	 *
	 * This will start output buffering until the form is closed
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function open(): self
	{
		ob_start();
		$this->opened = true;
		
		return $this;
	}
	
	/**
	 * Close the form
	 *
	 * This will end output buffering and set all the output to the 'fields'
	 * property in the view data
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function close(): self
	{
		if (!$this->isOpened()) {
			throw new BadMethodCallException('Trying to close a form that hasn\'t been opened.');
		}
		
		$this->view_data['fields'] = new HtmlString(trim(ob_get_clean()));
		$this->opened = false;
		
		if (is_callable($this->on_close)) {
			call_user_func($this->on_close, $this);
		}
		
		return $this;
	}
	
	public function isOpened(): bool
	{
		return true === $this->opened;
	}
	
	public function openButton(): Button
	{
		$this->pending_button = new Button($this->aire, $this);
		
		return $this->pending_button->open();
	}
	
	public function closeButton(): Button
	{
		if (!$this->pending_button) {
			throw new BadMethodCallException('Trying to close a button that hasn\'t been opened.');
		}
		
		$button = $this->pending_button->close();
		
		$this->pending_button = null;
		
		return $button;
	}
	
	/**
	 * Set the name of the error bag to use for error messages
	 *
	 * @param string $name
	 * @return $this
	 */
	public function errorBag($name): self
	{
		$this->error_bag = $name;

		return $this;
	}
	
	/**
	 * Set the form's action to a named route
	 *
	 * @param string $route_name
	 * @param mixed $parameters
	 * @param bool $absolute
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function route(string $route_name, $parameters = [], bool $absolute = true): self
	{
		$action = $this->url->route($route_name, $parameters, $absolute);
		$this->action($action);
		
		$this->inferMethodFromRoute($route_name);
		
		return $this;
	}
	
	public function get(): self
	{
		$this->attributes->set('method', 'GET');
		unset($this->view_data['_method']);
		
		return $this;
	}
	
	public function post(): self
	{
		$this->attributes->set('method', 'POST');
		unset($this->view_data['_method']);
		
		return $this;
	}
	
	public function put(): self
	{
		$this->attributes->set('method', 'POST');
		$this->view_data['_method'] = 'PUT';
		
		return $this;
	}
	
	public function patch(): self
	{
		$this->attributes->set('method', 'POST');
		$this->view_data['_method'] = 'PATCH';
		
		return $this;
	}
	
	public function delete(): self
	{
		$this->attributes->set('method', 'POST');
		$this->view_data['_method'] = 'DELETE';
		
		return $this;
	}
	
	public function method($method = null)
	{
		if (method_exists($this, strtolower($method))) {
			return $this->$method();
		}
		
		return parent::method($method);
	}
	
	public function urlEncoded(): self
	{
		return $this->encType('application/x-www-form-urlencoded');
	}
	
	public function multipart(): self
	{
		return $this->encType('multipart/form-data');
	}
	
	/**
	 * Enable client-side validation
	 *
	 * @param array|string|null $rule_source
	 * @param array $custom_messages
	 * @return $this
	 */
	public function validate($rule_source = null, array $custom_messages = null): self
	{
		$this->validate = true;
		
		// If we were passed rules, call rules() method
		if (is_array($rule_source)) {
			return $this->rules($rule_source);
		}
		
		// If we were passed a FormRequest class name, call formRequest() method
		if (is_string($rule_source) && is_subclass_of($rule_source, FormRequest::class)) {
			return $this->formRequest($rule_source);
		}
		
		if ($custom_messages) {
			$this->messages($custom_messages);
		}
		
		return $this;
	}
	
	/**
	 * Disable client-side validation
	 *
	 * @return $this
	 */
	public function withoutValidation(): self
	{
		$this->validate = false;
		
		return $this;
	}
	
	public function rules(array $rules = []): self
	{
		$this->validation_rules = $rules;
		
		return $this;
	}
	
	public function messages(array $messages = [], bool $overwrite = false): self
	{
		if ($overwrite) {
			$this->validation_messages = [];
		}
		
		$this->validation_messages = array_merge($this->validation_messages, $messages);
		
		return $this;
	}
	
	public function formRequest(string $class_name): self
	{
		$this->form_request = $class_name;
		$request = new $class_name();
		
		if (is_callable([$request, 'rules'])) {
			$this->rules($request->rules());
		}
		
		if (is_callable([$request, 'messages'])) {
			$this->messages($request->messages());
		}
		
		return $this;
	}
	
	public function onClose(callable $callback): self
	{
		$this->on_close = $callback;
		
		return $this;
	}
	
	public function render(): string
	{
		if ($this->isOpened()) {
			return '';
		}
		
		return parent::render();
	}
	
	protected function viewData(): array
	{
		return array_merge(parent::viewData(), $this->validationData());
	}
	
	protected function initGroup(): ?Group
	{
		return null; // Ignore for Form
	}
	
	protected function inferMethodFromRoute($route_name): void
	{
		if ($this->attributes['method'] !== $this->default_attributes['method']) {
			return;
		}
		
		if (!$this->router) {
			return;
		}
		
		if (!$route = $this->router->getRoutes()->getByName($route_name)) {
			return;
		}
		
		$methods = array_filter($route->methods(), function($method) {
			return 'HEAD' !== $method;
		});
		
		if (!count($methods)) {
			return;
		}
		
		$method = strtolower($methods[0]);
		
		if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
			$this->$method();
		}
	}
	
	protected function initValidation(): void
	{
		$this->validate = $this->aire->config('validate_by_default', true);
		
		$this->attributes->registerMutator('data-aire-id', function() {
			return $this->validate
				? $this->element_id
				: null;
		});
	}
	
	protected function validationData(): array
	{
		// TODO: FormRequest
		
		$validation = ($this->validate && (count($this->validation_rules) || null !== $this->form_request))
			? new ClientValidation($this->aire, $this->element_id, $this->validation_rules, $this->validation_messages, $this->form_request, $this->dev_mode)
			: '';
		
		return compact('validation');
	}
}
