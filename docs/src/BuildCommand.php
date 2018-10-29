<?php

namespace Docs;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Symfony\Component\Process\Process;

class BuildCommand extends Command
{
	protected $name = 'build';
	
	protected $description = 'Build static documentation.';
	
	public function handle()
	{
		app()->instance('env', 'production');
		config()->set('app.url', 'https://glhd.github.io/aire/');
		
		$this->buildJavascript();
		$this->copyAssets();
		$this->writeFiles();
		
		$this->comment('Done.');
	}
	
	protected function buildJavascript()
	{
		$this->comment('Building production JavaScript file...');
		
		$process = (new Process(['yarn', 'run', 'prod']))->setTimeout(null);
		$process->run();
		
		if (!$process->isSuccessful()) {
			throw new \RuntimeException($process->getErrorOutput());
		}
	}
	
	protected function copyAssets()
	{
		$this->comment('Copying assets...');
		
		File::copy(__DIR__.'/public/tailwind.css', __DIR__.'/../tailwind.css');
		File::copy(__DIR__.'/../../js/dist/aire.js', __DIR__.'/../aire.js');
	}
	
	protected function writeFiles()
	{
		$dist = dirname(__DIR__);
		$files = File::glob(__DIR__.'/views/*.blade.php');
		
		$data = [
			'readme' => new Readme(),
		];
		
		foreach ($files as $filename) {
			$view = basename($filename, '.blade.php');
			
			// Skip partials
			if ('_' === $view[0]) {
				$this->comment("Skipping '$view' partial...");
				continue;
			}
			
			$this->comment("Writing '$view' view...");
			File::put("$dist/$view.html", View::make($view, $data)->render());
		}
	}
}
