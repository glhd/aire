<?php

namespace Galahad\Aire\Components;

use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Form as FormElement;
use Galahad\Aire\Support\Facades\Aire;

/**
 * @property \Galahad\Aire\Elements\Form $element
 */
class Form extends ElementComponent
{
	public function __construct(
		?bool $dev = null,
		$bind = null,
		?array $resourceful = null,
		$asAlpineComponent = null,
		?bool $open = null,
		?bool $close = null,
		?bool $openButton = null,
		?bool $closeButton = null,
		?array $route = null,
		?bool $get = null,
		?bool $post = null,
		?bool $put = null,
		?bool $patch = null,
		?bool $delete = null,
		$method = null,
		?bool $urlEncoded = null,
		?bool $multipart = null,
		?array $validate = null,
		?bool $withoutValidation = null,
		?array $rules = null,
		?array $messages = null,
		?string $formRequest = null,
		$acceptCharset = null,
		$action = null,
		$autoComplete = null,
		$encType = null,
		$name = null,
		?bool $noValidate = null,
		$target = null,
		?array $data = null,
		$addClass = null,
		$removeClass = null,
		$accessKey = null,
		$class = null,
		?bool $contentEditable = null,
		$contextMenu = null,
		$dir = null,
		$draggable = null,
		$dropZone = null,
		?bool $hide = null,
		$id = null,
		$lang = null,
		$role = null,
		?bool $spellCheck = null,
		$style = null,
		$tabIndex = null,
		$title = null,
		$ariaActiveDescendant = null,
		?bool $ariaAtomic = null,
		?bool $ariaBusy = null,
		$ariaControls = null,
		$ariaDescribedBy = null,
		$ariaDisabled = null,
		$ariaDropEffect = null,
		$ariaFlowTo = null,
		$ariaGrabbed = null,
		?bool $ariaHasPopup = null,
		?bool $ariaHidden = null,
		$ariaInvalid = null,
		$ariaLabel = null,
		$ariaLabelledBy = null,
		$ariaLive = null,
		$ariaOwns = null,
		$ariaRelevant = null,
		?bool $grouped = null,
		?bool $withoutGroup = null,
		$variant = null,
		?string $variants = null
	) {
		$this->createElement(FormElement::class, compact(
			'dev',
			'bind',
			'resourceful',
			'asAlpineComponent',
			'open',
			'close',
			'openButton',
			'closeButton',
			'route',
			'get',
			'post',
			'put',
			'patch',
			'delete',
			'method',
			'urlEncoded',
			'multipart',
			'validate',
			'withoutValidation',
			'rules',
			'messages',
			'formRequest',
			'acceptCharset',
			'action',
			'autoComplete',
			'encType',
			'name',
			'noValidate',
			'target',
			'data',
			'addClass',
			'removeClass',
			'accessKey',
			'class',
			'contentEditable',
			'contextMenu',
			'dir',
			'draggable',
			'dropZone',
			'hide',
			'id',
			'lang',
			'role',
			'spellCheck',
			'style',
			'tabIndex',
			'title',
			'ariaActiveDescendant',
			'ariaAtomic',
			'ariaBusy',
			'ariaControls',
			'ariaDescribedBy',
			'ariaDisabled',
			'ariaDropEffect',
			'ariaFlowTo',
			'ariaGrabbed',
			'ariaHasPopup',
			'ariaHidden',
			'ariaInvalid',
			'ariaLabel',
			'ariaLabelledBy',
			'ariaLive',
			'ariaOwns',
			'ariaRelevant',
			'grouped',
			'withoutGroup',
			'variant',
			'variants'
		));
	}
	
	public function resolveView()
	{
		return function($data) {
			$this->element->open();
			echo $data['slot'];
			return $this->element->close();
		};
	}
	
	protected function getElementInstance(string $element_class): Element
	{
		return Aire::getFacadeRoot()->form();
	}
}
