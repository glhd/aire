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
	| Default to Verbose Summaries
	|--------------------------------------------------------------------------
	|
	| By default, the Summary element will only display a message about the
	| number of errors that need to be resolved. If you would like, you can
	| change the default behavior to also include an enumerated list of the
	| errors in the summary box.
	|
	*/
	'verbose_summaries_by_default' => false,
	
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
	| These should be in the format '[element]' => '[class names]'
	| e.g. 'checkbox_label' => 'font-bold'
	|
	| See default-theme.php for a full example of configuring class names.
	|
	*/
	'default_classes' => [],
	
	/*
	|--------------------------------------------------------------------------
	| Variant Classes
	|--------------------------------------------------------------------------
	|
	| Some themes may define variants, such as "sm" or "lg" or "primary".
	| If you need to override any of these, do so here.
	|
	*/
	'variant_classes' => [],
	
	/*
	|--------------------------------------------------------------------------
	| Validation Classes
	|--------------------------------------------------------------------------
	|
	| A grouped element can optionally have a validation state set. This can
	| be not validated, invalid, or valid. You can configure these class names
	| on an element-by-element basis here.
	|
	| These should be in the format '[element]_[sub element]' => '[class names]'
	| e.g. 'checkbox_label' => 'font-bold'
	|
	| See default-theme.php for a full example of configuring class names.
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
		| These should be in the format '[element]' => '[class names]'
		| e.g. 'checkbox_label' => 'font-bold'
		|
		| See default-theme.php for a full example of configuring class names.
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
		| These should be in the format '[element]' => '[class names]'
		| e.g. 'checkbox_label' => 'font-bold'
		|
		| See default-theme.php for a full example of configuring class names.
		|
		*/
		'valid' => [],
		
		/*
		|--------------------------------------------------------------------------
		| Invalid
		|--------------------------------------------------------------------------
		|
		| These classes will be applied to elements that failed validation.
		|
		| These should be in the format '[element]' => '[class names]'
		| e.g. 'checkbox_label' => 'font-bold'
		|
		| See default-theme.php for a full example of configuring class names.
		|
		*/
		'invalid' => [],
	],

];
