<?php

namespace Docs;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Docs';
	
	public function map()
	{
		$files = File::glob(__DIR__.'/views/*.blade.php');
		
		Route::get('aire-src.mjs', function() {
			return response(file_get_contents(__DIR__.'/../../js/src/Aire.js'), 200, [
				'Content-Type' => 'text/javascript',
			]);
		});
		
		Route::get('validator.js', function() {
			return response(file_get_contents(__DIR__.'/../../node_modules/validatorjs/dist/validator.js'), 200, [
				'Content-Type' => 'text/javascript',
			]);
		});
		
		foreach ($files as $filename) {
			$view = basename($filename, '.blade.php');
			
			// Skip partials
			if (0 === strpos($view, '_')) {
				continue;
			}
			
			$path = 'index' === $view
				? '/'
				: $view;
			
			Route::any($path, function() use ($view, $path) {
				if (request()->isMethod('post')) {
					session()->flashInput(request()->all());
				}
				return view($view, [
					'current_path' => $path,
					'readme' => new Readme(),
				]);
			})->middleware([
				\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
				\Illuminate\Session\Middleware\StartSession::class,
				\Illuminate\View\Middleware\ShareErrorsFromSession::class,
			]);
		}
	}
}
