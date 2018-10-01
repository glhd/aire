<?php

namespace Galahad\Aire\Elements\Concerns;

use BadMethodCallException;
use Galahad\Aire\Elements\Group;

/**
 * @method \Galahad\Aire\Elements\Group label(string $text)
 * @method \Galahad\Aire\Elements\Group groupLabel(string $text)
 * @method \Galahad\Aire\Elements\Group helpText(string $text)
 * @method \Galahad\Aire\Elements\Group groupHelpText(string $text)
 * @method \Galahad\Aire\Elements\Group prepend(string $text)
 * @method \Galahad\Aire\Elements\Group groupPrepend(string $text)
 * @method \Galahad\Aire\Elements\Group append(string $text)
 * @method \Galahad\Aire\Elements\Group groupAppend(string $text)
 * @method mixed data($key, $value)
 * @method mixed groupData($key, $value)
 * @method mixed toHtml()
 * @method mixed groupToHtml()
 * @method \Galahad\Aire\Elements\Element accessKey($value = null)
 * @method \Galahad\Aire\Elements\Element groupAccessKey($value = null)
 * @method \Galahad\Aire\Elements\Element class($value = null)
 * @method \Galahad\Aire\Elements\Element groupClass($value = null)
 * @method \Galahad\Aire\Elements\Element contentEditable(bool $content_editable = true)
 * @method \Galahad\Aire\Elements\Element groupContentEditable(bool $content_editable = true)
 * @method \Galahad\Aire\Elements\Element contextMenu($value = null)
 * @method \Galahad\Aire\Elements\Element groupContextMenu($value = null)
 * @method \Galahad\Aire\Elements\Element dir($value = null)
 * @method \Galahad\Aire\Elements\Element groupDir($value = null)
 * @method \Galahad\Aire\Elements\Element draggable($value = null)
 * @method \Galahad\Aire\Elements\Element groupDraggable($value = null)
 * @method \Galahad\Aire\Elements\Element dropZone($value = null)
 * @method \Galahad\Aire\Elements\Element groupDropZone($value = null)
 * @method \Galahad\Aire\Elements\Element hidden(bool $hidden = true)
 * @method \Galahad\Aire\Elements\Element groupHidden(bool $hidden = true)
 * @method \Galahad\Aire\Elements\Element id($value = null)
 * @method \Galahad\Aire\Elements\Element groupId($value = null)
 * @method \Galahad\Aire\Elements\Element lang($value = null)
 * @method \Galahad\Aire\Elements\Element groupLang($value = null)
 * @method \Galahad\Aire\Elements\Element role($value = null)
 * @method \Galahad\Aire\Elements\Element groupRole($value = null)
 * @method \Galahad\Aire\Elements\Element spellCheck(bool $spell_check = true)
 * @method \Galahad\Aire\Elements\Element groupSpellCheck(bool $spell_check = true)
 * @method \Galahad\Aire\Elements\Element style($value = null)
 * @method \Galahad\Aire\Elements\Element groupStyle($value = null)
 * @method \Galahad\Aire\Elements\Element tabIndex($value = null)
 * @method \Galahad\Aire\Elements\Element groupTabIndex($value = null)
 * @method \Galahad\Aire\Elements\Element title($value = null)
 * @method \Galahad\Aire\Elements\Element groupTitle($value = null)
 * @method \Galahad\Aire\Elements\Element ariaActiveDescendant($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaActiveDescendant($value = null)
 * @method \Galahad\Aire\Elements\Element ariaAtomic(bool $aria_atomic = true)
 * @method \Galahad\Aire\Elements\Element groupAriaAtomic(bool $aria_atomic = true)
 * @method \Galahad\Aire\Elements\Element ariaBusy(bool $aria_busy = true)
 * @method \Galahad\Aire\Elements\Element groupAriaBusy(bool $aria_busy = true)
 * @method \Galahad\Aire\Elements\Element ariaControls($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaControls($value = null)
 * @method \Galahad\Aire\Elements\Element ariaDescribedBy($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaDescribedBy($value = null)
 * @method \Galahad\Aire\Elements\Element ariaDisabled($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaDisabled($value = null)
 * @method \Galahad\Aire\Elements\Element ariaDropEffect($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaDropEffect($value = null)
 * @method \Galahad\Aire\Elements\Element ariaFlowTo($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaFlowTo($value = null)
 * @method \Galahad\Aire\Elements\Element ariaGrabbed($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaGrabbed($value = null)
 * @method \Galahad\Aire\Elements\Element ariaHasPopup(bool $aria_has_popup = true)
 * @method \Galahad\Aire\Elements\Element groupAriaHasPopup(bool $aria_has_popup = true)
 * @method \Galahad\Aire\Elements\Element ariaHidden(bool $aria_hidden = true)
 * @method \Galahad\Aire\Elements\Element groupAriaHidden(bool $aria_hidden = true)
 * @method \Galahad\Aire\Elements\Element ariaInvalid($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaInvalid($value = null)
 * @method \Galahad\Aire\Elements\Element ariaLabel($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaLabel($value = null)
 * @method \Galahad\Aire\Elements\Element ariaLabelledBy($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaLabelledBy($value = null)
 * @method \Galahad\Aire\Elements\Element ariaLive($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaLive($value = null)
 * @method \Galahad\Aire\Elements\Element ariaOwns($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaOwns($value = null)
 * @method \Galahad\Aire\Elements\Element ariaRelevant($value = null)
 * @method \Galahad\Aire\Elements\Element groupAriaRelevant($value = null)
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
