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
	| Automatically generate input IDs
	|--------------------------------------------------------------------------
	|
	| If an input does not have an "id" attribute set, Aire can automatically
	| create one. This improves UX by ensuring that <label> tags are always
	| associated with the correct tag.
	|
	*/
	'auto_id' => true,
	
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
		'group' => 'mb-6',
		'group_prepend' => '-mr-1 block p-2 text-base leading-normal bg-gray-100 text-gray-300 border rounded-l-sm',
		'group_append' => '-ml-1 block p-2 text-base leading-normal bg-gray-100 text-gray-300 border rounded-r-sm',
		'group_help_text' => 'block mt-1 text-sm font-normal',
		'group_errors' => 'list-reset mt-2 mb-3',
		'label' => 'inline-block mb-2',
		'input' => 'block w-full p-2 text-base leading-normal bg-white border rounded-sm',
		'checkbox' => 'pr-2',
		'checkbox_label' => 'flex items-center',
		'checkbox_wrapper' => 'ml-2 flex-1',
		'checkbox_group_label' => 'flex items-baseline mb-2 ml-2 border-transparent border-l',
		'checkbox_group_label_wrapper' => 'flex-1 ml-2',
		'radio_group_label' => 'flex items-baseline mb-2 ml-2 border-transparent border-l',
		'radio_group_label_wrapper' => 'flex-1 ml-2',
		'summary' => 'border border-red bg-red-100 text-red font-bold rounded p-4 my-4',
		'button' => 'inline-block font-normal text-center whitespace-no-wrap align-middle select-none border
			rounded font-normal leading-normal text-white bg-blue-600 border-blue-700 hover:bg-blue-700
			hover:border-blue-900 p-2 px-4',
		'select' => 'block w-full p-2 leading-normal border rounded-sm bg-white appearance-none',
		'textarea' => 'block w-full p-2 text-base leading-normal bg-white border rounded-sm h-auto',
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
		'none' => [
			'input' => 'text-gray-900',
			'select' => 'text-gray-900',
			'textarea' => 'text-gray-900', // TODO: This probably needs to be generalized better
			'group_errors' => 'hidden',
			'group_help_text' => 'text-gray-600',
		],
		
		/*
		|--------------------------------------------------------------------------
		| Valid
		|--------------------------------------------------------------------------
		|
		| These classes will be applied to elements that have passed validation.
		|
		*/
		'valid' => [
			'label' => 'text-green-600',
			'input' => 'border-green-600 text-green-700',
			'select' => 'border-green-600 text-green-700',
			'textarea' => 'border-green-600 text-green-700',
			'group_errors' => 'hidden',
			'group_help_text' => 'text-green-600 opacity-50',
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
			'label' => 'text-red-600',
			'input' => 'border-red-600 text-red-700',
			'select' => 'border-red-600 text-red-700',
			'textarea' => 'border-red-600 text-red-700',
			'group_help_text' => 'text-red-600 opacity-50',
		],
	],
	
];
