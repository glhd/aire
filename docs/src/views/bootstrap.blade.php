@extends('_layout')

@section('page-title')
	Twitter Bootstrap Support
@endsection

@push('head')
	<script src="https://unpkg.com/srcdoc-polyfill@1.0.0/srcdoc-polyfill.js"></script>
@endpush

@section('content')
	
	<?php (new \Galahad\AireBootstrap\AireBootstrapServiceProvider(app()))->boot(); ?>
	
	<h1 class="text-2xl text-gray-900">
		Twitter Bootstrap Theme
	</h1>
	
	<p>
		Hey, maybe you're still using <a href="https://getbootstrap.com/">Bootstrap</a>. That's OK.
		Aire has a custom Bootstrap theme just for you.
	</p>
	
	<h2>
		Installation
	</h2>
	
	<pre>composer require glhd/aire-bootstrap</pre>
	
	<p>
		Once the plugin is installed, you can use <code>Aire</code> as you would normally,
		and all the Bootstrap classes will be applied:
	</p>
	
	<?php ob_start(); ?>
	
	<div style="padding: 1rem;">
		<link rel="stylesheet"
		      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		      crossorigin="anonymous" />
		
		{{ Aire::open()->post()->multipart()->validate(['demo' => 'required']) }}
		
		{{ Aire::input('demo')
			->label('Demo Input')
			->id('demo')
			->helpText('This is demo help text.') }}
		
		{{ Aire::number()
			->step(1)
			->defaultValue(20)
			->label('Input Group')
			->prepend('$')
			->append('.00') }}
		
		{{ Aire::range('range', 'Range', 1, 10)->defaultValue(5) }}
		
		{{ Aire::select(['one' => 'Option 1', 'two' => 'Option 2'])
			->label('Demo Select') }}
		
		{{ Aire::select(['one' => 'Option 1', 'two' => 'Option 2'])
			->multiple()
			->label('Demo Multi-Select') }}
		
		{{ Aire::textarea()->value('Demo text area') }}

		{{ Aire::file()->label('Demo File Input') }}
		
		{{ Aire::checkbox()->label('Demo check box') }}
		
		{{ Aire::radioGroup(['one' => 'Option 1', 'two' => 'Option 2'], 'foo')
			->defaultValue('two')
			->label('Demo radio group') }}
		
		{{ Aire::checkboxGroup(['one' => 'Option 1', 'two' => 'Option 2', 'three' => 'Option 3'], 'bar')
			->defaultValue(['one', 'three'])
			->label('Demo checkbox group') }}
		
		{{ Aire::submit('Demo Button') }}
		
		{{ Aire::submit('Secondary Button')->variant()->secondary() }}
		
		{{ Aire::close() }}
	</div>
	
	<?php $html = ob_get_clean(); ?>
	
	<div class="border rounded my-12 relative">
		<h2 class="m-0 px-6 py-3 border-b text-salmon">
			Bootstrap 4 Form
		</h2>
		<iframe class="w-full h-screen" srcdoc="{{ $html }}"></iframe>
	</div>
	
	<?php Aire::resetTheme(); ?>

@endsection
