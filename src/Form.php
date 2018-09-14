<?php

namespace Galahad\Aire;

class Form extends Element
{
	public function __construct(Aire $aire)
	{
		parent::__construct('open', $aire);
	}
}
