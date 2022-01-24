<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\NonInput;
use Illuminate\Support\HtmlString;

class Group extends Element implements NonInput
{
	/**
	 * Not valid nor invalid
	 */
	public const VALIDATION_NONE = 'none';
	
	/**
	 * Invalid data
	 */
	public const VALIDATION_INVALID = 'invalid';
	
	/**
	 * Valid data
	 */
	public const VALIDATION_VALID = 'valid';
	
	/**
	 * @var string
	 */
	public $name = 'group';
	
	/**
	 * @var \Galahad\Aire\Elements\Element|\Galahad\Aire\Elements\Concerns\Groupable
	 */
	public $element;
	
	/**
	 * @var \Galahad\Aire\Elements\Label
	 */
	public $label;
	
	/**
	 * @var string
	 */
	public $validation_state = self::VALIDATION_NONE;
	
	/**
	 * @var array
	 */
	protected $view_data = [
		'prepend' => null,
		'append' => null,
		'errors' => [],
		'label' => null,
	];
	
	/**
	 * Groups should never be grouped themselves
	 *
	 * @var bool
	 */
	protected $grouped = false;
	
	/**
	 * Constructor
	 *
	 * @param \Galahad\Aire\Aire $aire
	 * @param \Galahad\Aire\Elements\Form $form
	 * @param \Galahad\Aire\Elements\Element $element
	 */
	public function __construct(Aire $aire, Form $form, Element $element)
	{
		parent::__construct($aire, $form);
		
		$this->element = $element;
	}
	
	/**
	 * Set the group's label
	 *
	 * @param string|\Illuminate\Contracts\Support\Htmlable $text
	 * @return \Galahad\Aire\Elements\Group
	 */
	public function label($text): self
	{
		// TODO: Is this necessary any more or can we just use attributes?
		// TODO: Might make sense to have a special innerHTML attribute that doesn't get rendered to the key=value list
		
		$this->label = (new Label($this->aire, $this))->text($text);
		
		return $this;
	}
	
	public function variant($variant = null)
	{
		// Also pass the variant to the group label
		if ($this->label instanceof Label) {
			$this->label->variant($variant);
		}
		
		return parent::variant($variant);
	}
	
	public function helpText(string $text): self
	{
		$this->view_data['help_text'] = $text;
		
		return $this;
	}
	
	public function validated($validation_state = self::VALIDATION_VALID): self
	{
		$this->validation_state = $validation_state;
		
		return $this;
	}
	
	public function valid(): self
	{
		return $this->validated(self::VALIDATION_VALID);
	}
	
	public function invalid(): self
	{
		return $this->validated(self::VALIDATION_INVALID);
	}
	
	public function errors($message): self
	{
		$this->view_data['errors'] = (array) $message;
		
		$this->invalid();
		
		return $this;
	}
	
	public function prepend(string $text): self
	{
		$this->view_data['prepend'] = $text;
		
		return $this;
	}
	
	public function append(string $text): self
	{
		$this->view_data['append'] = $text;
		
		return $this;
	}
	
	public function getInputName($default = null): ?string
	{
		return $this->element->getInputName($default);
	}
	
	public function render(): string
	{
		$element_name = $this->element->name;
		
		$views = [
			"{$this->name}.{$element_name}",
			$this->name,
		];
		
		// If our grouped element has a "type" attribute, check for that first
		if ($element_type = $this->element->attributes->get('type')) {
			array_unshift($views, "{$this->name}.{$element_name}.{$element_type}");
		}
		
		return $this->aire->renderFirst(
			$views,
			$this->viewData()
		);
	}
	
	protected function applyVariantToGroup($variant): void
	{
		// Skip recursion
	}
	
	protected function viewData(): array
	{
		if ($name = $this->element->getInputName()) {
			if (!empty($session_errors = $this->form->getErrors($name))) {
				$this->view_data['errors'] = array_merge($this->view_data['errors'], $session_errors);
				$this->invalid();
			}
		}
		
		return array_merge(parent::viewData(), [
			'label' => $this->label,
			'element' => new HtmlString($this->element->render()),
			'error_view' => $this->aire->applyTheme('_error'),
		]);
	}
	
	protected function initGroup(): ?Group
	{
		$this->group = $this;
		
		return $this;
	}
}
