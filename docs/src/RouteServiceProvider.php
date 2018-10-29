<?php

namespace Docs;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Docs';
	
	public function map()
	{
		Route::get('/', function () {
			return view('index');
		});
	}
}
