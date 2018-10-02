<?php

namespace Galahad\Aire\Elements\Concerns;

use BadMethodCallException;
use Galahad\Aire\Elements\Group;

/**
 * @method \Galahad\Aire\Elements\Group label(string $text)
 * @method \Galahad\Aire\Elements\Group groupLabel(string $text)
 * @method \Galahad\Aire\Elements\Group helpText(string $text)
 * @method \Galahad\Aire\Elements\Group groupHelpText(string $text)
 * @method \Galahad\Aire\Elements\Group errors($message)
 * @method \Galahad\Aire\Elements\Group groupErrors($message)
 * @method \Galahad\Aire\Elements\Group prepend(string $text)
 * @method \Galahad\Aire\Elements\Group groupPrepend(string $text)
 * @method \Galahad\Aire\Elements\Group append(string $text)
 * @method \Galahad\Aire\Elements\Group groupAppend(string $text)
 * @method mixed data($key, $value)
 * @method mixed groupData($key, $value)
 * @method mixed toHtml()
 * @method mixed groupToHtml()
 * @method mixed accessKey($value = NULL)
 * @method mixed groupAccessKey($value = NULL)
 * @method mixed class($value = NULL)
 * @method mixed groupClass($value = NULL)
 * @method mixed contentEditable(bool $content_editable = true)
 * @method mixed groupContentEditable(bool $content_editable = true)
 * @method mixed contextMenu($value = NULL)
 * @method mixed groupContextMenu($value = NULL)
 * @method mixed dir($value = NULL)
 * @method mixed groupDir($value = NULL)
 * @method mixed draggable($value = NULL)
 * @method mixed groupDraggable($value = NULL)
 * @method mixed dropZone($value = NULL)
 * @method mixed groupDropZone($value = NULL)
 * @method mixed hidden(bool $hidden = true)
 * @method mixed groupHidden(bool $hidden = true)
 * @method mixed id($value = NULL)
 * @method mixed groupId($value = NULL)
 * @method mixed lang($value = NULL)
 * @method mixed groupLang($value = NULL)
 * @method mixed role($value = NULL)
 * @method mixed groupRole($value = NULL)
 * @method mixed spellCheck(bool $spell_check = true)
 * @method mixed groupSpellCheck(bool $spell_check = true)
 * @method mixed style($value = NULL)
 * @method mixed groupStyle($value = NULL)
 * @method mixed tabIndex($value = NULL)
 * @method mixed groupTabIndex($value = NULL)
 * @method mixed title($value = NULL)
 * @method mixed groupTitle($value = NULL)
 * @method mixed ariaActiveDescendant($value = NULL)
 * @method mixed groupAriaActiveDescendant($value = NULL)
 * @method mixed ariaAtomic(bool $aria_atomic = true)
 * @method mixed groupAriaAtomic(bool $aria_atomic = true)
 * @method mixed ariaBusy(bool $aria_busy = true)
 * @method mixed groupAriaBusy(bool $aria_busy = true)
 * @method mixed ariaControls($value = NULL)
 * @method mixed groupAriaControls($value = NULL)
 * @method mixed ariaDescribedBy($value = NULL)
 * @method mixed groupAriaDescribedBy($value = NULL)
 * @method mixed ariaDisabled($value = NULL)
 * @method mixed groupAriaDisabled($value = NULL)
 * @method mixed ariaDropEffect($value = NULL)
 * @method mixed groupAriaDropEffect($value = NULL)
 * @method mixed ariaFlowTo($value = NULL)
 * @method mixed groupAriaFlowTo($value = NULL)
 * @method mixed ariaGrabbed($value = NULL)
 * @method mixed groupAriaGrabbed($value = NULL)
 * @method mixed ariaHasPopup(bool $aria_has_popup = true)
 * @method mixed groupAriaHasPopup(bool $aria_has_popup = true)
 * @method mixed ariaHidden(bool $aria_hidden = true)
 * @method mixed groupAriaHidden(bool $aria_hidden = true)
 * @method mixed ariaInvalid($value = NULL)
 * @method mixed groupAriaInvalid($value = NULL)
 * @method mixed ariaLabel($value = NULL)
 * @method mixed groupAriaLabel($value = NULL)
 * @method mixed ariaLabelledBy($value = NULL)
 * @method mixed groupAriaLabelledBy($value = NULL)
 * @method mixed ariaLive($value = NULL)
 * @method mixed groupAriaLive($value = NULL)
 * @method mixed ariaOwns($value = NULL)
 * @method mixed groupAriaOwns($value = NULL)
 * @method mixed ariaRelevant($value = NULL)
 * @method mixed groupAriaRelevant($value = NULL)
 */
trait Groupable
{
	/**
	 * @var Group
	 */
	public $group;
	
	/**
	 * Whether or not the element is grouped
	 *
	 * @var bool
	 */
	protected $grouped = true;
	
	/**
	 * Enable grouping of element
	 *
	 * @return $this
	 */
	public function grouped()
	{
		$this->grouped = true;
		
		return $this;
	}
	
	/**
	 * Disable grouping of element
	 *
	 * @return $this
	 */
	public function withoutGroup()
	{
		$this->grouped = false;
		
		return $this;
	}
	
	public function __toString()
	{
		return $this->grouped
			? $this->group->__toString()
			: $this->renderInsideElement();
	}
	
	public function renderInsideElement()
	{
		return parent::__toString();
	}
	
	public function __call($method_name, $arguments)
	{
		$group_method = 0 === strpos($method_name, 'group')
			? camel_case(substr($method_name, 5))
			: $method_name;
		
		if ($this->grouped && method_exists($this->group, $group_method)) {
			$this->group->$group_method(...$arguments);
			
			return $this;
		}
		
		throw new BadMethodCallException(sprintf(
			'Method %s::%s does not exist on the element or Group.',
			class_basename(static::class),
			$method_name
		));
	}
	
	protected function initGroup()
	{
		$this->grouped = $this->aire->config('group_by_default', true);
		$this->group = new Group($this->aire, $this->form, $this);
	}
}
