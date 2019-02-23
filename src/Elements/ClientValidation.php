<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Contracts\Support\Htmlable;

class ClientValidation implements Htmlable
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
	 * @var bool
	 */
	protected $dev_mode = false;
	
	public function __construct(Aire $aire, $element_id, array $rules = [], $dev_mode = false)
	{
		$this->aire = $aire;
		$this->element_id = $element_id;
		$this->rules = $rules;
		$this->dev_mode = $dev_mode;
	}
	
	public function toHtml() : string
	{
		return $this->aireHtml().$this->formHtml();
	}
	
	protected function formHtml() : string
	{
		$rules = json_encode($this->rules);
		
		return "
			<script defer>
			document.addEventListener('DOMContentLoaded', function() {
				window.\$aire{$this->element_id} = Aire.connect('[data-aire-id=\"{$this->element_id}\"]', {$rules});
			});
			</script>
		";
	}
	
	protected function aireHtml() : string
	{
		if (static::$aire_loaded) {
			return '';
		}
		
		static::$aire_loaded = true;
		
		$config = json_encode($this->config());
		
		if ($this->dev_mode) {
			$validator_url = asset('validator.js');
			$aire_url = asset('aire-src.mjs');
			return "
				<script defer src=\"{$validator_url}\"></script>
				<script defer type=\"module\">
					import * as Aire from '{$aire_url}';
					window.Aire = Aire;
					Aire.configure({$config});
				</script>
			";
		}
		
		if ($this->aire->config('inline_validation', true)) {
			$aire_src = file_get_contents(__DIR__.'/../../js/dist/aire.js');
			return "<script>\n{$aire_src}\n</script>";
		}
		
		return '<script src="'.$this->aire->config('validation_script_path').'"></script>';
	}
	
	protected function config() : array
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
