<?php

namespace Galahad\Aire\Scaffolding;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class FieldBuilder
{
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	/**
	 * @var array
	 */
	protected $fields;
	
	public static function buildAndRender(Form $form, array $fields) : Htmlable
	{
		return (new static($form, $fields))->render();
	}
	
	public function __construct(Form $form, array $fields)
	{
		$this->form = $form;
		$this->fields = $fields;
	}
	
	public function render() : Htmlable
	{
		return $this->form->setFieldsHtml(
			Collection::make($this->fields)
				->map(function(Element $element) {
					return $element->render();
				})
				->implode("\n")
		);
	}
}
