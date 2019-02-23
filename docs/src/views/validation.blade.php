@extends('_layout')

<?php
$authors = [
	'coates' => 'Ta-Nehisi Coates',
	'roth' => 'Philip Roth',
	'patchett' => 'Ann Patchett',
];

$after_fixed_date = now()->format('Y-m-d');

// TODO: date_equals, date_format, digits_between, filled, gt, gte, ip, ipv4, ipv6, json, lt, lte, not_regex

$rules = [
	'accepted' => 'accepted',
	// TODO: validatorjs does not support after:2020-02-01 (only after by reference)
	// 'after_fixed' => 'after:'.$after_fixed_date,
	'after_reference' => 'after:reference_date',
	'after_or_equal_reference' => 'after_or_equal:reference_date',
	'before_reference' => 'before:reference_date',
	'before_or_equal_reference' => 'before_or_equal:reference_date',
	'date' => 'date',
	'alpha' => 'alpha',
	'alpha_dash' => 'alpha_dash',
	'alpha_num' => 'alpha_num',
	'array' => 'array',
	'between' => 'between:2,4', // TODO: validatorjs only supports floats (decimal required) in "between"
	'confirmed' => 'confirmed',
	'different' => 'different:different_from',
	'digits' => 'digits:5',
	'email' => 'email',
	'in' => 'in:foo,bar,baz',
	'not_in' => 'not_in:foo,bar,baz',
	'integer' => 'integer',
	'min_string' => 'min:5',
	'min_number' => 'numeric|min:5',
	'max_string' => 'max:5',
	'max_number' => 'numeric|max:5',
	'regex' => 'regex:/^[a-z]\d{4}$/i',
];
?>

@section('content')
	
	<h1>
		Javascript Validation Demo
	</h1>
	
	{{ Aire::open()->dev()->validate($rules) }}
	
	{{ Aire::checkbox('accepted', 'Accept the terms') }}
	
	{{ Aire::date('reference_date', 'Enter a reference date:') }}
	{{ Aire::date('after_reference', 'Must be after whatever date is entered above:') }}
	{{ Aire::date('after_or_equal_reference', 'Must be after or equal to the reference date above:') }}
	{{ Aire::date('before_reference', 'Must be before whatever date is entered above:') }}
	{{ Aire::date('before_or_equal_reference', 'Must be before or equal to the reference date above:') }}
	
	{{ Aire::input('date', 'Must be a valid date format:') }}
	
	{{ Aire::input('alpha', 'Must be only letters:') }}
	{{ Aire::input('alpha_dash', 'Must be letters, numbers, dashes, and underscores:') }}
	{{ Aire::input('alpha_num', 'Must be letters or numbers:') }}
	
	{{ Aire::checkboxGroup($authors, 'array', 'Must be array:') }}
	
	{{ Aire::input('between', 'Must be between 2.0 and 4.0 (floats only for now):') }}
	
	<div class="flex">
		<div class="w-1/2 pr-1">
			{{ Aire::input('confirmed', 'Must be confirmed:') }}
		</div>
		<div class="w-1/2 pl-1">
			{{ Aire::input('confirmed_confirmation', 'Confirm:') }}
		</div>
	</div>
	
	<div class="flex">
		<div class="w-1/2 pr-1">
			{{ Aire::input('different_from', 'Enter any value:') }}
		</div>
		<div class="w-1/2 pl-1">
			{{ Aire::input('different', 'Must be different from that value:') }}
		</div>
	</div>
	
	{{ Aire::input('digits', 'Must be 5 digits:') }}
	
	{{ Aire::email('email', 'Must be a valid email:') }}
	
	{{ Aire::input('in', 'Must be foo, bar, or baz:') }}
	{{ Aire::input('not_in', 'Must NOT be foo, bar, or baz:') }}
	
	{{ Aire::input('integer', 'Must be an integer:') }}
	
	{{ Aire::input('min_string', 'Must be a string of at least 5 characters:') }}
	{{ Aire::input('min_number', 'Must be a number that is 5 or above:') }}
	{{ Aire::input('max_string', 'Must be a string up to 5 characters:') }}
	{{ Aire::input('max_number', 'Must be a number up to 5:') }}
	
	{{ Aire::input('regex', 'Must match the regular expression /^[a-z]\d{4}$/i') }}
	
	{{-- TODO: These are the old inputs below
	
	{{ Aire::input('demo_input', 'Demo Input')
		->helpText('This is demo input with existing help text.') }}
	
	{{ Aire::select($demo_options, 'demo_select', 'Demo Select') }}
	
	{{ Aire::select($demo_options, 'demo_multiselect', 'Demo Multi-Select')->multiple() }}
	
	{{ Aire::textArea('demo_textarea', 'Demo Text Area') }}
	
	{{ Aire::checkbox('demo_checkbox', 'Demo Checkbox') }}
	
	{{ Aire::radioGroup($demo_options, 'demo_radiogroup', 'Demo Radio Group')->defaultValue('coates') }}
	
	{{ Aire::checkboxGroup($demo_options, 'demo_checkboxgroup', 'Demo Checkbox Group') }}
	
	{{ Aire::submit() }}
	
	--}}
	
	{{ Aire::close() }}

@endsection
