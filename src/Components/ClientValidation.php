<?php

namespace Galahad\Aire\Components;

use Galahad\Aire\Elements\ClientValidation as ClientValidationElement; 

class ClientValidation extends ElementComponent
{
	public function __construct(
		
	) {
		$this->createElement(ClientValidationElement::class, compact(
			
		));
	}
}
