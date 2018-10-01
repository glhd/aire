#!/usr/bin/env php
<?php

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Support\AireServiceProvider;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Session\NullSessionHandler;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

$base_path = dirname(__DIR__);

require_once "$base_path/vendor/autoload.php";

$app = new Application($base_path);
Application::setInstance($app);
$app->instance('session', false);
$app->instance('session.store', new Illuminate\Session\Store('docs', new NullSessionHandler()));
$app->instance('request', Request::create('/'));

$config = new Illuminate\Config\Repository();
$app->instance('config', $config);

$provider = new AireServiceProvider($app);
$provider->register();

$fs = new Filesystem();
$engines = new EngineResolver();
$engines->register('blade', function() use ($fs, $base_path) {
	$compiler = new BladeCompiler($fs, "$base_path/docs/src/cache");
	return new CompilerEngine($compiler);
});

$finder = new FileViewFinder($fs, ["$base_path/docs/src"]);
$events = new Dispatcher();

$factory = new Factory($engines, $finder, $events);
$app->instance('view', $factory);

$provider->boot();

Aire::setFacadeApplication($app);

$view = $factory->make('index');
$html = $view->render();

$fs->put("$base_path/docs/index.html", $html);

echo "Written.\n";
