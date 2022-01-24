<?php

namespace Galahad\Aire\Elements\Concerns;

use BadMethodCallException;
use Galahad\Aire\Elements\Group;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

/**
 * @method \Galahad\Aire\Elements\Element label(string|Htmlable $text)
 * @method \Galahad\Aire\Elements\Element helpText(string $text)
 * @method \Galahad\Aire\Elements\Element validated($validation_state = 'valid')
 * @method \Galahad\Aire\Elements\Element valid()
 * @method \Galahad\Aire\Elements\Element invalid()
 * @method \Galahad\Aire\Elements\Element errors($message)
 * @method \Galahad\Aire\Elements\Element prepend(string $text)
 * @method \Galahad\Aire\Elements\Element append(string $text)
 * @method \Galahad\Aire\Elements\Element groupData($key, $value)
 * @method \Galahad\Aire\Elements\Element groupAccessKey($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupClass($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupContentEditable(bool $content_editable = true)
 * @method \Galahad\Aire\Elements\Element groupContextMenu($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupDir($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupDraggable($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupDropZone($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupHide(bool $hidden = true)
 * @method \Galahad\Aire\Elements\Element groupId($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupLang($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupRole($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupSpellCheck(bool $spell_check = true)
 * @method \Galahad\Aire\Elements\Element groupStyle($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupTabIndex($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupTitle($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaActiveDescendant($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaAtomic(bool $aria_atomic = true)
 * @method \Galahad\Aire\Elements\Element groupAriaBusy(bool $aria_busy = true)
 * @method \Galahad\Aire\Elements\Element groupAriaControls($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaDescribedBy($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaDisabled($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaDropEffect($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaFlowTo($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaGrabbed($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaHasPopup(bool $aria_has_popup = true)
 * @method \Galahad\Aire\Elements\Element groupAriaHidden(bool $aria_hidden = true)
 * @method \Galahad\Aire\Elements\Element groupAriaInvalid($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaLabel($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaLabelledBy($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaLive($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaOwns($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAriaRelevant($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupAddClass($value = NULL)
 * @method \Galahad\Aire\Elements\Element groupRemoveClass($value = NULL)
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
	public function grouped(): self
	{
		$this->grouped = true;
		
		return $this;
	}
	
	/**
	 * Disable grouping of element
	 *
	 * @return $this
	 */
	public function withoutGroup(): self
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
			? Str::camel(substr($method_name, 5))
			: $method_name;
		
		if ($this->grouped && method_exists($this->group, $group_method)) {
			$this->group->$group_method(...$arguments);
			
			return $this;
		}
		
		if (static::hasMacro($method_name)) {
			return $this->callMacro($method_name, $arguments);
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
	protected function initGroup(): ?Group
	{
		if (null === $this->grouped) {
			$this->grouped = $this->aire->config('group_by_default', true);
		}
		
		$this->group = new Group($this->aire, $this->form, $this);
		
		return $this->group;
	}
}
