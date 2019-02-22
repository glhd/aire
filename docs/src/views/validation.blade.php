@extends('_layout')

<?php
$demo_options = [
	'coates' => 'Ta-Nehisi Coates',
	'roth' => 'Philip Roth',
	'patchett' => 'Ann Patchett',
];
$rules = [
	'demo_input' => 'required|numeric|min:1|max:100',
	'demo_select' => 'in:coates,patchett',
	'demo_multiselect' => 'in:patchett,roth',
	'demo_textarea' => 'required|min:5|max:20',
	'demo_radiogroup' => 'in:roth,patchett',
	'demo_checkboxgroup' => 'in:coates,roth',
];
?>

@section('content')
	
	<h1>
		Javascript Validation
	</h1>
	
	{{ Aire::open()->post()->multipart()->dev()->validate($rules) }}
	
	{{ Aire::input('demo_input', 'Demo Input')
		->helpText('This is demo input with existing help text.') }}
	
	{{ Aire::select($demo_options, 'demo_select', 'Demo Select') }}
	
	{{ Aire::select($demo_options, 'demo_multiselect', 'Demo Multi-Select')->multiple() }}
	
	{{ Aire::textArea('demo_textarea', 'Demo Text Area') }}
	
	{{ Aire::checkbox('demo_checkbox', 'Demo Checkbox') }}
	
	{{ Aire::radioGroup($demo_options, 'demo_radiogroup', 'Demo Radio Group')->defaultValue('coates') }}
	
	{{ Aire::checkboxGroup($demo_options, 'demo_checkboxgroup', 'Demo Checkbox Group') }}
	
	{{ Aire::submit() }}
	
	{{ Aire::close() }}

@endsection
