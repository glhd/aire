<?php

namespace Docs;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class BuildCommand extends Command
{
	protected $name = 'build';
	
	protected $description = 'Build static documentation.';
	
	public function handle()
	{
		$dist = dirname(__DIR__);
		$files = File::glob(__DIR__.'/views/*.blade.php');
		
		foreach ($files as $filename) {
			$view = basename($filename, '.blade.php');
			$this->comment("Writing '$view'...");
			File::put("$dist/$view.html", View::make($view)->render());
		}
		
		$this->comment('Done.');
	}
}
