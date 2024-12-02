<?php

/*
 |--------------------------------------------------------------------------
 | Default Theme
 |--------------------------------------------------------------------------
 |
 | This file provides the class names for the default Aire theme. These
 | values are merged into the Aire config as defaults (if you have not set
 | a value in your project's Aire config file).
 |
 */

return [
	'default_classes' => [
		'group' => 'mb-6',
		'group_prepend' => '-mr-1 block p-2 text-base leading-normal bg-gray-100 text-gray-300 border rounded-l-sm',
		'group_append' => '-ml-1 block p-2 text-base leading-normal bg-gray-100 text-gray-300 border rounded-r-sm',
		'group_help_text' => 'block mt-1 font-normal',
		'group_errors' => 'list-reset mt-2 mb-3',
		'label' => 'inline-block mb-2 font-semibold',
		'input' => 'block w-full leading-normal bg-white border rounded-sm',
		'checkbox' => 'pr-2',
		'checkbox_label' => 'flex items-baseline',
		'checkbox_wrapper' => 'ml-2 flex-1',
		'checkbox_group_label' => 'flex items-baseline mb-2 ml-2 border-transparent border-l',
		'checkbox_group_label_wrapper' => 'flex-1 ml-2',
		'radio_group_label' => 'flex items-baseline mb-2 ml-2 border-transparent border-l',
		'radio_group_label_wrapper' => 'flex-1 ml-2',
		'summary' => 'border border-red-500 bg-red-100 text-red-500 font-bold rounded p-4 my-4',
		'button' => 'font-normal text-center whitespace-no-wrap align-middle select-none border leading-normal',
		'select' => 'block w-full p-2 leading-normal border rounded-sm bg-white appearance-none',
		'textarea' => 'block w-full p-2 text-base leading-normal bg-white border rounded-sm',
	],
	'variant_classes' => [
		'input' => [
			'default' => 'p-2 text-base rounded-sm',
			'sm' => 'p-1 text-sm rounded-sm',
			'lg' => 'p-2 text-lg rounded-lg',
		],
		'label' => [
			'default' => 'text-base',
			'sm' => 'text-sm',
			'lg' => 'text-lg',
		],
		'group_help_text' => [
			'default' => 'text-sm',
			'sm' => 'text-xs',
			'lg' => 'text-base',
		],
		'button' => [
			'default' => [
				'display' => 'inline-block',
				'size' => 'text-base rounded p-2 px-4',
				'color' => 'text-white bg-blue-600 border-blue-700 hover:bg-blue-700 hover:border-blue-900',
			],
			
			'block' => ['display' => 'block'],
			
			'sm' => ['size' => 'text-sm rounded-sm p-1 px-2'],
			'lg' => ['size' => 'text-lg rounded-lg p-3 px-6'],
			
			'gray' => ['color' => 'text-white bg-gray-600 border-gray-700 hover:bg-gray-700 hover:border-gray-900'],
			'red' => ['color' => 'text-white bg-red-600 border-red-700 hover:bg-red-700 hover:border-red-900'],
			'orange' => ['color' => 'text-white bg-orange-600 border-orange-700 hover:bg-orange-700 hover:border-orange-900'],
			'yellow' => ['color' => 'text-white bg-yellow-600 border-yellow-700 hover:bg-yellow-700 hover:border-yellow-900'],
			'green' => ['color' => 'text-white bg-green-600 border-green-700 hover:bg-green-700 hover:border-green-900'],
			'teal' => ['color' => 'text-white bg-teal-600 border-teal-700 hover:bg-teal-700 hover:border-teal-900'],
			'blue' => ['color' => 'text-white bg-blue-600 border-blue-700 hover:bg-blue-700 hover:border-blue-900'],
			'indigo' => ['color' => 'text-white bg-indigo-600 border-indigo-700 hover:bg-indigo-700 hover:border-indigo-900'],
			'purple' => ['color' => 'text-white bg-purple-600 border-purple-700 hover:bg-purple-700 hover:border-purple-900'],
			'pink' => ['color' => 'text-white bg-pink-600 border-pink-700 hover:bg-pink-700 hover:border-pink-900'],
		],
	],
	'validation_classes' => [
		'none' => [
			'input' => 'text-gray-900',
			'select' => 'text-gray-900',
			'textarea' => 'text-gray-900', // TODO: This probably needs to be generalized better
			'group_errors' => 'hidden',
			'group_help_text' => 'text-gray-600',
		],
		'valid' => [
			'label' => 'text-green-600',
			'input' => 'border-green-600 text-green-700',
			'select' => 'border-green-600 text-green-700',
			'textarea' => 'border-green-600 text-green-700',
			'group_errors' => 'hidden',
			'group_help_text' => 'text-green-600 opacity-50',
		],
		'invalid' => [
			'label' => 'text-red-600',
			'input' => 'border-red-600 text-red-700',
			'select' => 'border-red-600 text-red-700',
			'textarea' => 'border-red-600 text-red-700',
			'group_help_text' => 'text-red-600 opacity-50',
		],
	],
];
