@extends('_layout')

@section('content')
	
	<h1>
		Basic Demo
	</h1>
	
	{{ Aire::open() }}
	
	{{ Aire::input()
		->label('Demo Input')
		->id('demo')
		->helpText('This is demo help text.') }}
	
	{{ Aire::select(['Option 1', 'Option 2'])
	    ->label('Demo Select') }}
	
	{{ Aire::textarea()->value('Demo text area') }}
	
	{{ Aire::button('Demo Button') }}
	
	{{ Aire::close() }}

@endsection
