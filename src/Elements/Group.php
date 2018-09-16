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
	
	public function __construct(GroupableElement $element, Aire $aire)
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
			'element' => new HtmlString($this->element->renderInsideElement()),
		]);
	}
}
