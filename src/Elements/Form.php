<?php

namespace Galahad\Aire\Elements;

use BadMethodCallException;
use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\CreatesElements;
use Galahad\Aire\Elements\Concerns\CreatesInputTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

class Form extends \Galahad\Aire\DTD\Form
{
	use CreatesElements, CreatesInputTypes;
	
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
	 * Set to true to load development versions of JS
	 *
	 * @var bool
	 */
	protected $dev_mode = false;
	
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
	
	/**
	 * Enable dev mode
	 *
	 * @param bool $dev_mode
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function dev(bool $dev_mode = true) : self
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
	public function bind($bound_data) : self
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
	public function resourceful(Model $model, $resource_name = null, $prepend_parameters = []) : self
	{
		$this->bind($model);
		
		if (null === $resource_name) {
			$resource_name = Str::kebab(Str::plural($model->getTable()));
		}
		
		if ($model->exists) {
			$parameters = $prepend_parameters;
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
	 * Determine whether the form has any bound data
	 *
	 * @return bool
	 */
	public function hasBoundData() : bool
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
		
		// If old input is set, use that
		if ($this->session_store && $this->session_store->hasOldInput($name)) {
			return $this->session_store->getOldInput($name);
		}
		
		// If form has bound data, use that
		if ($bound_data = $this->bound_data) {
			$bound_value = is_object($bound_data)
				? object_get($bound_data, $name)
				: array_get($bound_data, $name);
			
			if ($bound_value) {
				return $bound_value;
			}
		}
		
		return value($default);
	}
	
	/**
	 * Get any validation errors associated with an Element
	 *
	 * @param string $name
	 * @return array
	 */
	public function getErrors(string $name) : array
	{
		if (!$errors = $this->session_store->get('errors')) {
			return [];
		}
		
		if (!$errors instanceof ViewErrorBag) {
			return [];
		}
		
		if (!$errors->has($name)) {
			return [];
		}
		
		return $errors->get($name);
	}
	
	/**
	 * Open the form
	 *
	 * This will start output buffering until the form is closed
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function open() : self
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
	public function close() : self
	{
		if (!$this->opened) {
			throw new BadMethodCallException('Trying to close a form that hasn\'t been opened.');
		}
		
		$this->view_data['fields'] = new HtmlString(trim(ob_get_clean()));
		$this->opened = false;
		
		return $this;
	}
	
	public function openButton() : Button
	{
		$this->pending_button = new Button($this->aire, $this);
		
		return $this->pending_button->open();
	}
	
	public function closeButton() : Button
	{
		if (!$this->pending_button) {
			throw new BadMethodCallException('Trying to close a button that hasn\'t been opened.');
		}
		
		$button = $this->pending_button->close();
		
		$this->pending_button = null;
		
		return $button;
	}
	
	/**
	 * Set the form's action to a named route
	 *
	 * @param string $route_name
	 * @param mixed $parameters
	 * @param bool $absolute
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function route(string $route_name, $parameters = [], bool $absolute = true) : self
	{
		$action = $this->url->route($route_name, $parameters, $absolute);
		$this->action($action);
		
		$this->inferMethodFromRoute($route_name);
		
		return $this;
	}
	
	public function get() : self
	{
		$this->attributes->set('method', 'GET');
		unset($this->view_data['_method']);
		
		return $this;
	}
	
	public function post() : self
	{
		$this->attributes->set('method', 'POST');
		unset($this->view_data['_method']);
		
		return $this;
	}
	
	public function put() : self
	{
		$this->attributes->set('method', 'POST');
		$this->view_data['_method'] = 'PUT';
		
		return $this;
	}
	
	public function patch() : self
	{
		$this->attributes->set('method', 'POST');
		$this->view_data['_method'] = 'PATCH';
		
		return $this;
	}
	
	public function delete() : self
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
	
	public function urlEncoded() : self
	{
		return $this->encType('application/x-www-form-urlencoded');
	}
	
	public function multipart() : self
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
	public function validate($rule_source = null, array $custom_messages = null) : self
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
	public function withoutValidation() : self
	{
		$this->validate = false;
		
		return $this;
	}
	
	public function rules(array $rules = []) : self
	{
		$this->validation_rules = $rules;
		
		return $this;
	}
	
	public function messages(array $messages = [], bool $overwrite = false) : self
	{
		if ($overwrite) {
			$this->validation_messages = [];
		}
		
		$this->validation_messages = array_merge($this->validation_messages, $messages);
		
		return $this;
	}
	
	public function formRequest(string $class_name) : self
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
	
	public function render() : string
	{
		if ($this->opened) {
			return '';
		}
		
		return parent::render();
	}
	
	protected function viewData() : array
	{
		return array_merge(parent::viewData(), $this->validationData());
	}
	
	protected function initGroup() : ?Group
	{
		return null; // Ignore for Form
	}
	
	protected function inferMethodFromRoute($route_name) : void
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
	
	protected function initValidation() : void
	{
		$this->validate = $this->aire->config('validate_by_default', true);
		
		$this->attributes->registerMutator('data-aire-id', function() {
			return $this->validate
				? $this->element_id
				: null;
		});
	}
	
	protected function validationData() : array
	{
		// TODO: FormRequest
		
		$validation = ($this->validate && (count($this->validation_rules) || null !== $this->form_request))
			? new ClientValidation($this->aire, $this->element_id, $this->validation_rules, $this->validation_messages, $this->form_request, $this->dev_mode)
			: '';
		
		return compact('validation');
	}
}
