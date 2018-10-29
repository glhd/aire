<?php

return [
	'default' => 'file',
	'stores' => [
		'file' => [
			'driver' => 'file',
			'path' => __DIR__.'/../cache',
		],
	],
	'prefix' => 'aire-docs',
];
