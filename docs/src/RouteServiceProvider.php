<?php

namespace Docs;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Docs';
	
	public function map()
	{
		Route::get('/', function() {
			return view('index', [
				'readme' => new Readme(),
			]);
		});
		
		Route::view('/basic', 'basic');
	}
}
