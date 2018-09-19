<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Support\HtmlString;

class Group extends Element
{
	protected $view = 'group';
	
	/**
	 * @var \Galahad\Aire\Elements\GroupableElement
	 */
	protected $element;
	
	public function __construct(Aire $aire, GroupableElement $element)
	{
		parent::__construct($aire);
		
		$this->element = $element;
	}
	
	public function label(string $label) : self
	{
		$this->data['label'] = $label;
		
		return $this;
	}
	
	protected function viewData()
	{
		return array_merge(parent::viewData(), [
			'label_attributes' => [
				'for' => $this->element->getAttribute('id'), // TODO: Label probably needs to be its own element
			],
			'element' => new HtmlString($this->element->renderInsideElement()),
		]);
	}
}
