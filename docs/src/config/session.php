<?php

return [
	'driver' => 'file',
	'lifetime' => env('SESSION_LIFETIME', 120),
	'expire_on_close' => false,
	'encrypt' => false,
	'files' => __DIR__.'/../cache',
	'lottery' => [2, 100],
	'cookie' => 'aire-docs-session',
	'path' => '/',
	'domain' => null,
	'secure' => false,
	'http_only' => true,
	'same_site' => null,
];
