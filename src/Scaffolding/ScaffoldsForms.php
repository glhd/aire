<?php

namespace Galahad\Aire\Scaffolding;

use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Form;
use Illuminate\Container\Container;
use Illuminate\Contracts\Routing\UrlGenerator;
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
	public function scaffold($source) : Form
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
	
	protected function scaffoldModel(Model $model) : Form
	{
		// FIXME: Dependency injection is tricky here
		$url = Container::getInstance()->make(UrlGenerator::class);
		
		return $this->scaffoldConfiguredForm(
			new ModelConfigurationBuilder($this, $url, $model)
		);
	}
	
	protected function scaffoldConfiguredForm(ConfiguresForm $config) : Form
	{
		$form = $this->form();
		
		// Because we want to allow for a number of use-cases, the "configure" step
		// is run independently of the "build fields" step.
		$config->configureForm($form, $this);
		
		// If the configuration is also a builder object, just use that (in the case
		// of a Model builder, for example). Otherwise, we'll need to pass the fields 
		// to a builder to ensure that everything is normalized to Aire Elements.
		$builder = $config instanceof ConfigurationBuilder
			? $config
			: new ConfigurationBuilder($this, $config->formFields($this));
		
		return $form->setFieldsHtml($builder);
	}
}
