@extends('_layout')

@section('content')
	
	<h2 id="intro" class="mb-8 font-semibold text-grey-darkest">
		Introduction
	</h2>
	
	<p>
		Aire is a form builder library for Laravel.
	</p>
	
	{!! $readme !!}
	
	<h2 id="demo" class="mb-8 font-semibold text-grey-darkest">
		Basic Demo
	</h2>
	
	{{ Aire::open() }}
	
	{{ Aire::input()
		->label('Demo Input')
		->id('demo')
		->helpText('This is demo help text.') }}
	
	{{ Aire::textarea()->value('Demo text area') }}
	
	{{ Aire::button('Demo Button') }}
	
	{{ Aire::close() }}

@endsection
