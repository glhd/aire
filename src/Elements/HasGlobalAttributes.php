<?php

namespace Galahad\Aire\Elements;

trait HasGlobalAttributes
{
	public function accesskey($value)
	{
		$this->attributes['accesskey'] = $value;
		
		return $this;
	}
	
	public function class($value)
	{
		$this->attributes['class'] = $value;
		
		return $this;
	}
	
	public function contenteditable($contenteditable = true)
	{
		$this->attributes['contenteditable'] = $contenteditable;
		
		return $this;
	}
	
	public function contextmenu($value)
	{
		$this->attributes['contextmenu'] = $value;
		
		return $this;
	}
	
	public function dir($value)
	{
		$this->attributes['dir'] = $value;
		
		return $this;
	}
	
	public function draggable($value)
	{
		$this->attributes['draggable'] = $value;
		
		return $this;
	}
	
	public function dropzone($value)
	{
		$this->attributes['dropzone'] = $value;
		
		return $this;
	}
	
	public function hidden($value)
	{
		$this->attributes['hidden'] = $value;
		
		return $this;
	}
	
	public function id($value)
	{
		$this->attributes['id'] = $value;
		
		return $this;
	}
	
	public function lang($value)
	{
		$this->attributes['lang'] = $value;
		
		return $this;
	}
	
	public function role($value)
	{
		$this->attributes['role'] = $value;
		
		return $this;
	}
	
	public function spellcheck($spellcheck = true)
	{
		$this->attributes['spellcheck'] = $spellcheck;
		
		return $this;
	}
	
	public function style($value)
	{
		$this->attributes['style'] = $value;
		
		return $this;
	}
	
	public function tabindex($value)
	{
		$this->attributes['tabindex'] = $value;
		
		return $this;
	}
	
	public function title($value)
	{
		$this->attributes['title'] = $value;
		
		return $this;
	}
	
	public function ariaActivedescendant($value)
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
	
	public function ariaDescribedby($value)
	{
		$this->attributes['aria-describedby'] = $value;
		
		return $this;
	}
	
	public function ariaDisabled($value)
	{
		$this->attributes['aria-disabled'] = $value;
		
		return $this;
	}
	
	public function ariaDropeffect($value)
	{
		$this->attributes['aria-dropeffect'] = $value;
		
		return $this;
	}
	
	public function ariaFlowto($value)
	{
		$this->attributes['aria-flowto'] = $value;
		
		return $this;
	}
	
	public function ariaGrabbed($value)
	{
		$this->attributes['aria-grabbed'] = $value;
		
		return $this;
	}
	
	public function ariaHaspopup($aria_haspopup = true)
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
	
	public function ariaLabelledby($value)
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
