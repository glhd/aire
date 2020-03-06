<?php

namespace Galahad\Aire\Contracts;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Form;

interface ConfiguresForm
{
	public function configureForm(Form $form, Aire $aire) : void;
	
	public function formFields(Aire $aire) : array;
}
