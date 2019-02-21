<?php

namespace Galahad\Aire\Elements\Concerns;

use BadMethodCallException;
use Galahad\Aire\Elements\Group;

/**
 * @method \Galahad\Aire\Elements\Group label(string $text)
 * @method \Galahad\Aire\Elements\Group helpText(string $text)
 * @method \Galahad\Aire\Elements\Group validated($validation_state = 'valid')
 * @method \Galahad\Aire\Elements\Group valid()
 * @method \Galahad\Aire\Elements\Group invalid()
 * @method \Galahad\Aire\Elements\Group errors($message)
 * @method \Galahad\Aire\Elements\Group prepend(string $text)
 * @method \Galahad\Aire\Elements\Group append(string $text)
 * @method \Galahad\Aire\Elements\Group groupData($key, $value)
 * @method \Galahad\Aire\Elements\Group groupAccessKey($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupClass($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupContentEditable(bool $content_editable = true)
 * @method \Galahad\Aire\Elements\Group groupContextMenu($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupDir($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupDraggable($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupDropZone($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupHide(bool $hidden = true)
 * @method \Galahad\Aire\Elements\Group groupId($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupLang($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupRole($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupSpellCheck(bool $spell_check = true)
 * @method \Galahad\Aire\Elements\Group groupStyle($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupTabIndex($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupTitle($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaActiveDescendant($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaAtomic(bool $aria_atomic = true)
 * @method \Galahad\Aire\Elements\Group groupAriaBusy(bool $aria_busy = true)
 * @method \Galahad\Aire\Elements\Group groupAriaControls($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaDescribedBy($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaDisabled($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaDropEffect($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaFlowTo($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaGrabbed($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaHasPopup(bool $aria_has_popup = true)
 * @method \Galahad\Aire\Elements\Group groupAriaHidden(bool $aria_hidden = true)
 * @method \Galahad\Aire\Elements\Group groupAriaInvalid($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaLabel($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaLabelledBy($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaLive($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaOwns($value = NULL)
 * @method \Galahad\Aire\Elements\Group groupAriaRelevant($value = NULL)
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
	protected $grouped;
	
	/**
	 * Enable grouping of element
	 *
	 * @return $this
	 */
	public function grouped() : self
	{
		$this->grouped = true;
		
		return $this;
	}
	
	/**
	 * Disable grouping of element
	 *
	 * @return $this
	 */
	public function withoutGroup() : self
	{
		$this->grouped = false;
		
		return $this;
	}
	
	/**
	 * Pass method calls to the group if they don't exist on the Element
	 *
	 * @param $method_name
	 * @param $arguments
	 * @return $this
	 */
	public function __call($method_name, $arguments)
	{
		$group_method = 0 === strpos($method_name, 'group')
			? camel_case(substr($method_name, 5))
			: $method_name;
		
		if ($this->grouped && method_exists($this->group, $group_method)) {
			$this->group->$group_method(...$arguments);
			
			return $this;
		}
		
		// @codeCoverageIgnoreStart
		throw new BadMethodCallException(sprintf(
			'Method %s::%s does not exist on the Element or Group.',
			class_basename(static::class),
			$method_name
		));
		// @codeCoverageIgnoreEnd
	}
	
	/**
	 * Initialize the group
	 */
	protected function initGroup() : Group
	{
		if (null === $this->grouped) {
			$this->grouped = $this->aire->config('group_by_default', true);
		}
		
		$this->group = new Group($this->aire, $this->form, $this);
		
		return $this->group;
	}
}
