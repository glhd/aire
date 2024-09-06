<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\NonInput;

class Summary extends Element implements NonInput
{
	public $name = 'summary';
	
	protected $grouped = false;
	
	protected $view_data = [
		'verbose' => false,
	];
	
	public function __construct(Aire $aire, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->view_data['verbose'] = $aire->config('verbose_summaries_by_default', false);
		$this->view_data['errors'] = $form->getErrors();
	}
	
	public function verbose(bool $verbose = true): self
	{
		$this->view_data['verbose'] = $verbose;
		
		return $this;
	}
	
	public function simple(): self
	{
		return $this->verbose(false);
	}
}
