<?php

namespace Docs;

use Illuminate\Foundation\Console\Kernel;

class ConsoleKernel extends Kernel
{
	protected $commands = [
		BuildCommand::class,
	];
}
