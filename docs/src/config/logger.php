<?php

use Monolog\Handler\StreamHandler;

return [
	
	'default' => 'stderr',
	
	'channels' => [
		
		'stderr' => [
			'driver' => 'monolog',
			'handler' => StreamHandler::class,
			'with' => [
				'stream' => 'php://stderr',
			],
		],
	
	],

];
