<?php

namespace Galahad\Aire\Elements\Concerns;

trait HasGlobalAttributes
{
	public function accessKey($value)
	{
		$this->attributes['accesskey'] = $value;
		
		return $this;
	}
	
	public function class($value)
	{
		$this->attributes['class'] = $value;
		
		return $this;
	}
	
	public function contentEditable($contenteditable = true)
	{
		$this->attributes['contenteditable'] = $contenteditable;
		
		return $this;
	}
	
	public function contextMenu($value)
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
	
	public function dropZone($value)
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
	
	public function spellCheck($spellcheck = true)
	{
		$this->attributes['spellcheck'] = $spellcheck;
		
		return $this;
	}
	
	public function style($value)
	{
		$this->attributes['style'] = $value;
		
		return $this;
	}
	
	public function tabIndex($value)
	{
		$this->attributes['tabindex'] = $value;
		
		return $this;
	}
	
	public function title($value)
	{
		$this->attributes['title'] = $value;
		
		return $this;
	}
}
