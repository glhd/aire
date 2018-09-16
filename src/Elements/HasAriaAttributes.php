<?php

namespace Galahad\Aire\Elements;

trait HasAriaAttributes
{
	public function ariaActiveDescendant($value)
	{
		$this->attributes['aria-activedescendant'] = $value;
		
		return $this;
	}
	
	public function ariaAtomic($aria_atomic = true)
	{
		$this->attributes['aria-atomic'] = $aria_atomic;
		
		return $this;
	}
	
	public function ariaBusy($aria_busy = true)
	{
		$this->attributes['aria-busy'] = $aria_busy;
		
		return $this;
	}
	
	public function ariaControls($value)
	{
		$this->attributes['aria-controls'] = $value;
		
		return $this;
	}
	
	public function ariaDescribedBy($value)
	{
		$this->attributes['aria-describedby'] = $value;
		
		return $this;
	}
	
	public function ariaDisabled($value)
	{
		$this->attributes['aria-disabled'] = $value;
		
		return $this;
	}
	
	public function ariaDropEffect($value)
	{
		$this->attributes['aria-dropeffect'] = $value;
		
		return $this;
	}
	
	public function ariaFlowTo($value)
	{
		$this->attributes['aria-flowto'] = $value;
		
		return $this;
	}
	
	public function ariaGrabbed($value)
	{
		$this->attributes['aria-grabbed'] = $value;
		
		return $this;
	}
	
	public function ariaHasPopup($aria_haspopup = true)
	{
		$this->attributes['aria-haspopup'] = $aria_haspopup;
		
		return $this;
	}
	
	public function ariaHidden($aria_hidden = true)
	{
		$this->attributes['aria-hidden'] = $aria_hidden;
		
		return $this;
	}
	
	public function ariaInvalid($value)
	{
		$this->attributes['aria-invalid'] = $value;
		
		return $this;
	}
	
	public function ariaLabel($value)
	{
		$this->attributes['aria-label'] = $value;
		
		return $this;
	}
	
	public function ariaLabelledBy($value)
	{
		$this->attributes['aria-labelledby'] = $value;
		
		return $this;
	}
	
	public function ariaLive($value)
	{
		$this->attributes['aria-live'] = $value;
		
		return $this;
	}
	
	public function ariaOwns($value)
	{
		$this->attributes['aria-owns'] = $value;
		
		return $this;
	}
	
	public function ariaRelevant($value)
	{
		$this->attributes['aria-relevant'] = $value;
		
		return $this;
	}
}
