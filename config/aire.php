<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Default Grouping Behavior
	|--------------------------------------------------------------------------
	|
	| Elements that can be grouped (like <input> tags) are grouped by default.
	| You can disable this on an element-by-element basis by using the
	| `withoutGroup()` method, but if you would like to turn grouping off
	| by default, you can set this configuration value.
	|
	*/
	'group_by_default' => true,
	
	/*
	|--------------------------------------------------------------------------
	| Default Client-Side Validation
	|--------------------------------------------------------------------------
	|
	| Aire comes with built-in client-side validation. By default, it is
	| enabled when available. You can disable this on a form-by-form basis
	| by using the `withoutValidation()` method, but if you would like to turn
	| off validation by default, you can set this configuration value.
	|
	*/
	'validate_by_default' => true,
	
	/*
	|--------------------------------------------------------------------------
	| Client-Side Validation Scripts
	|--------------------------------------------------------------------------
	|
	| For easiest integration, Aire will inline the javascript necessary to
	| perform client-side validation. You can instead publish the JS scripts
	| and load them via `<script>` tags to take advantage of HTTP caching.
	|
	*/
	'inline_validation' => true,
	'validation_script_path' => env('APP_URL').'/vendor/aire/js/aire.js',
	
	/*
	|--------------------------------------------------------------------------
	| Default Attributes
	|--------------------------------------------------------------------------
	|
	| If you would like to configure default attributes for certain elements,
	| you can do so here (for example, setting a <form>'s method to 'GET' by
	| default).
	|
	*/
	'default_attributes' => [
		'form' => [
			'method' => 'POST',
		],
	],
	
	/*
	|--------------------------------------------------------------------------
	| Default Classes
	|--------------------------------------------------------------------------
	|
	| If you would like to configure default CSS class names for certain elements,
	| you can do so here (for example, changing all <input> elements to have
	| the class .form-control for Bootstrap compatibility).
	|
	*/
	'default_classes' => [
		'input' => 'text-grey-darkest bg-white border rounded-sm',
		'summary' => 'border border-red bg-red-lightest text-red font-bold rounded p-4 my-4',
		'button' => 'inline-block font-normal text-center whitespace-no-wrap align-middle select-none border
			rounded font-normal leading-normal text-white bg-blue-dark border-blue-darker hover:bg-blue-darker
			hover:border-blue-darkest p-2 px-4',
	],
	
	/*
	|--------------------------------------------------------------------------
	| Validation Classes
	|--------------------------------------------------------------------------
	|
	| A grouped element can optionally have a validation state set. This can
	| be not validated, invalid, or valid. You can configure these class names
	| on an element-by-element basis here.
	|
	*/
	'validation_classes' => [
		
		/*
		|--------------------------------------------------------------------------
		| Not Validated
		|--------------------------------------------------------------------------
		|
		| These classes will be applied to elements that have not been validated.
		|
		*/
		'none' => [],
		
		/*
		|--------------------------------------------------------------------------
		| Valid
		|--------------------------------------------------------------------------
		|
		| These classes will be applied to elements that have passed validation.
		|
		*/
		'valid' => [
			'label' => 'text-green-dark',
			'input' => 'border-green-dark',
		],
		
		/*
		|--------------------------------------------------------------------------
		| Invalid
		|--------------------------------------------------------------------------
		|
		| These classes will be applied to elements that failed validation.
		|
		*/
		'invalid' => [
			'label' => 'text-red-dark',
			'input' => 'border-red-dark',
		],
	],
	
];
