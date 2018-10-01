<?php

namespace Galahad\Aire\Elements\Concerns;

use BadMethodCallException;
use Galahad\Aire\Elements\Group;

/**
 * @method static \Galahad\Aire\Elements\Group label(string $text)
 * @method static \Galahad\Aire\Elements\Group groupLabel(string $text)
 * @method static \Galahad\Aire\Elements\Group helpText(string $text)
 * @method static \Galahad\Aire\Elements\Group groupHelpText(string $text)
 * @method static \Galahad\Aire\Elements\Group prepend(string $text)
 * @method static \Galahad\Aire\Elements\Group groupPrepend(string $text)
 * @method static \Galahad\Aire\Elements\Group append(string $text)
 * @method static \Galahad\Aire\Elements\Group groupAppend(string $text)
 * @method static mixed data($key, $value)
 * @method static mixed groupData($key, $value)
 * @method static mixed getAttribute($name, $default = null)
 * @method static mixed groupGetAttribute($name, $default = null)
 * @method static array getAttributes()
 * @method static array groupGetAttributes()
 * @method static mixed toHtml()
 * @method static mixed groupToHtml()
 * @method static \Galahad\Aire\Elements\Element accessKey($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAccessKey($value = null)
 * @method static \Galahad\Aire\Elements\Element class($value = null)
 * @method static \Galahad\Aire\Elements\Element groupClass($value = null)
 * @method static \Galahad\Aire\Elements\Element contentEditable(bool $content_editable = null = true)
 * @method static \Galahad\Aire\Elements\Element groupContentEditable(bool $content_editable = null = true)
 * @method static \Galahad\Aire\Elements\Element contextMenu($value = null)
 * @method static \Galahad\Aire\Elements\Element groupContextMenu($value = null)
 * @method static \Galahad\Aire\Elements\Element dir($value = null)
 * @method static \Galahad\Aire\Elements\Element groupDir($value = null)
 * @method static \Galahad\Aire\Elements\Element draggable($value = null)
 * @method static \Galahad\Aire\Elements\Element groupDraggable($value = null)
 * @method static \Galahad\Aire\Elements\Element dropZone($value = null)
 * @method static \Galahad\Aire\Elements\Element groupDropZone($value = null)
 * @method static \Galahad\Aire\Elements\Element hidden(bool $hidden = null = true)
 * @method static \Galahad\Aire\Elements\Element groupHidden(bool $hidden = null = true)
 * @method static \Galahad\Aire\Elements\Element id($value = null)
 * @method static \Galahad\Aire\Elements\Element groupId($value = null)
 * @method static \Galahad\Aire\Elements\Element lang($value = null)
 * @method static \Galahad\Aire\Elements\Element groupLang($value = null)
 * @method static \Galahad\Aire\Elements\Element role($value = null)
 * @method static \Galahad\Aire\Elements\Element groupRole($value = null)
 * @method static \Galahad\Aire\Elements\Element spellCheck(bool $spell_check = null = true)
 * @method static \Galahad\Aire\Elements\Element groupSpellCheck(bool $spell_check = null = true)
 * @method static \Galahad\Aire\Elements\Element style($value = null)
 * @method static \Galahad\Aire\Elements\Element groupStyle($value = null)
 * @method static \Galahad\Aire\Elements\Element tabIndex($value = null)
 * @method static \Galahad\Aire\Elements\Element groupTabIndex($value = null)
 * @method static \Galahad\Aire\Elements\Element title($value = null)
 * @method static \Galahad\Aire\Elements\Element groupTitle($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaActiveDescendant($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaActiveDescendant($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaAtomic(bool $aria_atomic = null = true)
 * @method static \Galahad\Aire\Elements\Element groupAriaAtomic(bool $aria_atomic = null = true)
 * @method static \Galahad\Aire\Elements\Element ariaBusy(bool $aria_busy = null = true)
 * @method static \Galahad\Aire\Elements\Element groupAriaBusy(bool $aria_busy = null = true)
 * @method static \Galahad\Aire\Elements\Element ariaControls($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaControls($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaDescribedBy($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaDescribedBy($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaDisabled($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaDisabled($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaDropEffect($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaDropEffect($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaFlowTo($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaFlowTo($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaGrabbed($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaGrabbed($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaHasPopup(bool $aria_has_popup = null = true)
 * @method static \Galahad\Aire\Elements\Element groupAriaHasPopup(bool $aria_has_popup = null = true)
 * @method static \Galahad\Aire\Elements\Element ariaHidden(bool $aria_hidden = null = true)
 * @method static \Galahad\Aire\Elements\Element groupAriaHidden(bool $aria_hidden = null = true)
 * @method static \Galahad\Aire\Elements\Element ariaInvalid($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaInvalid($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaLabel($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaLabel($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaLabelledBy($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaLabelledBy($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaLive($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaLive($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaOwns($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaOwns($value = null)
 * @method static \Galahad\Aire\Elements\Element ariaRelevant($value = null)
 * @method static \Galahad\Aire\Elements\Element groupAriaRelevant($value = null)
 */
trait Groupable
{
	public $group;
	
	protected $grouped = true;
	
	/**
	 * @param null $value
	 * @return $this
	 */
	public function id($value = null)
	{
		if ($value && $this->group->label) {
			$this->group->label->for($value);
		}
		
		$this->attributes['id'] = $value;
		
		return $this;
	}
	
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
