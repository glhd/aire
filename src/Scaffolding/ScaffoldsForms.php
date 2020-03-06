<?php

namespace Galahad\Aire\Scaffolding;

use Galahad\Aire\Contracts\ConfiguresForm;
use Illuminate\Container\Container;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

trait ScaffoldsForms
{
	/**
	 * Scaffold a form based on a model or a pre-configured form
	 *
	 * @param string|\Galahad\Aire\Contracts\ConfiguresForm|\Illuminate\Database\Eloquent\Model $source
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function scaffold($source) : Htmlable
	{
		if ($source instanceof ConfiguresForm) {
			return $this->scaffoldConfiguredForm($source);
		}
		
		if ($source instanceof Model) {
			return $this->scaffoldModel($source);
		}
		
		if (is_a($source, Model::class, true)) {
			return $this->scaffoldModel(new $source());
		}
		
		throw new RuntimeException('Aire::scaffold() must be passed an Eloquent model or an instance of ConfiguresForm.');
	}
	
	protected function scaffoldModel(Model $model) : Htmlable
	{
		// FIXME: Dependency injection is tricky here
		$url = Container::getInstance()->make(UrlGenerator::class);
		
		return $this->scaffoldConfiguredForm(
			new ModelConfigurationBuilder($this, $url, $model)
		);
	}
	
	protected function scaffoldConfiguredForm(ConfiguresForm $config) : Htmlable
	{
		$form = $this->form();
		$config->configureForm($form, $this);
		
		return FieldBuilder::buildAndRender($form, $config->formFields($this));
	}
}
