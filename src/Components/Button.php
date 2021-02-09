<?php

namespace Galahad\Aire\Components;

use Galahad\Aire\Elements\Button as ButtonElement; 

class Button extends ElementComponent
{
	public function __construct(
		?bool $open = null,
		?bool $close = null,
		?string $labelHtml = null,
		?bool $autoFocus = null,
		?bool $disabled = null,
		$form = null,
		$formAction = null,
		$formEncType = null,
		$formMethod = null,
		?bool $formNoValidate = null,
		$formTarget = null,
		$name = null,
		$type = null,
		$value = null,
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
		$this->createElement(ButtonElement::class, compact(
			'open',
			'close',
			'labelHtml',
			'autoFocus',
			'disabled',
			'form',
			'formAction',
			'formEncType',
			'formMethod',
			'formNoValidate',
			'formTarget',
			'name',
			'type',
			'value',
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
}
