<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\NonInput;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Crypt;

class ClientValidation implements Htmlable, NonInput
{
	/**
	 * Store 'loaded' state so we only inject the Aire scripts once
	 *
	 * @var bool
	 */
	protected static $aire_loaded = false;
	
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var mixed
	 */
	protected $element_id;
	
	/**
	 * @var array
	 */
	protected $rules;
	
	/**
	 * @var array
	 */
	protected $messages;
	
	/**
	 * @var string
	 */
	protected $form_request;
	
	/**
	 * @var bool
	 */
	protected $dev_mode = false;
	
	public function __construct(Aire $aire, $element_id, array $rules = [], array $messages = [], string $form_request = null, $dev_mode = false)
	{
		$this->aire = $aire;
		$this->element_id = $element_id;
		$this->rules = $rules;
		$this->messages = $messages;
		$this->form_request = $form_request;
		$this->dev_mode = $dev_mode;
	}
	
	public function toHtml(): string
	{
		return $this->aireHtml().$this->formHtml();
	}
	
	protected function formHtml(): string
	{
		$rules = json_encode($this->rules);
		$messages = json_encode($this->messages);
		$form_request = null === $this->form_request
			? 'null'
			: json_encode(Crypt::encrypt($this->form_request)); // TODO: Inject rather than use facade
		
		// TODO: Filter out certain server-side rules that could leak sensitive data, like the unique rule
		// TODO: Add a "validate-on-server" rule that these get replaced with
		
		return "
			<script defer>
			document.addEventListener('DOMContentLoaded', function() {
				window.\$aire{$this->element_id} = Aire.connect('[data-aire-id=\"{$this->element_id}\"]', {$rules}, {$messages}, {$form_request});
			});
			</script>
		";
	}
	
	protected function aireHtml(): string
	{
		if (static::$aire_loaded) {
			return '';
		}
		
		static::$aire_loaded = true;
		
		$config = json_encode($this->config());
		$config_js = "
			<script defer>
			document.addEventListener('DOMContentLoaded', function() {
				Aire.configure({$config});
			});
			</script>
		";
		
		// @codeCoverageIgnoreStart
		if ($this->dev_mode) {
			$validator_url = asset('validator.js');
			$aire_url = asset('aire-src.mjs');
			return "
				<script defer src=\"{$validator_url}\"></script>
				<script defer type=\"module\">
					import * as Aire from '{$aire_url}';
					window.Aire = Aire;
				</script>
				$config_js
			";
		}
		// @codeCoverageIgnoreEnd
		
		if ($this->aire->config('inline_validation', true)) {
			$aire_src = file_get_contents(__DIR__.'/../../js/dist/aire.min.js');
			return "<script defer>\n{$aire_src}\n</script>\n{$config_js}";
		}
		
		return '<script defer src="'.$this->aire->config('validation_script_path').'"></script>'.$config_js;
	}
	
	protected function config(): array
	{
		$placeholder = '__AIRE_ERROR_PLACEHOLDER__';
		$html = $this->aire->render('_error', ['error' => $placeholder]);
		[$error_prefix, $error_suffix] = explode($placeholder, $html);
		
		return [
			'templates' => [
				'error' => [
					'prefix' => trim($error_prefix),
					'suffix' => trim($error_suffix),
				],
			],
			'classnames' => $this->aire->config('validation_classes', []),
		];
	}
}
