@extends('_layout')

@section('page-title')
	Basic Demo
@endsection

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		Basic Demo
	</h1>
	
	@if(request()->request->count())
		<?php dump(request()->all()); ?>
	@endif
	
	<pre><code class="language-php">@verbatim{{ Aire::open() }}
	
{{ Aire::input()
	->label('Demo Input')
	->id('demo')
	->helpText('This is demo help text.') }}

{{ Aire::select(['one' => 'Option 1', 'two' => 'Option 2'])
    ->label('Demo Select') }}
			
{{ Aire::timezoneSelect('timezone', 'Timezone') }}

{{ Aire::textarea()
	->value('Demo text area') }}

{{ Aire::checkbox()
	->label('Demo check box') }}

// Radio groups must have a name
{{ Aire::radioGroup(['one' => 'Option 1', 'two' => 'Option 2'], 'demo_radios')
	->defaultValue('two')
	->label('Demo radio group') }}

{{ Aire::submit('Demo Submit Button') }}

{{ Aire::close() }}@endverbatim</code></pre>
	
	<h2>Resulting Form</h2>
	
	{{ Aire::open()->post()->multipart()->validate() }}
	
	{{ Aire::input()
		->label('Demo Input')
		->id('demo')
		->helpText('This is demo help text.') }}
	
	{{ Aire::select(['one' => 'Option 1', 'two' => 'Option 2'])
	    ->label('Demo Select') }}
	
	{{ Aire::timezoneSelect('timezone', 'Timezone') }}
	
	{{ Aire::textarea()->value('Demo text area') }}
	
	{{ Aire::checkbox()->label('Demo check box') }}
	
	{{ Aire::radioGroup(['one' => 'Option 1', 'two' => 'Option 2'], 'foo')
		->defaultValue('two')
		->label('Demo radio group') }}
	
	{{ Aire::checkboxGroup(['one' => 'Option 1', 'two' => 'Option 2', 'three' => 'Option 3'], 'bar')
		->defaultValue(['one', 'three'])
		->label('Demo checkbox group') }}
	
	{{ Aire::submit('Demo Button') }}
	
	{{ Aire::close() }}

@endsection
