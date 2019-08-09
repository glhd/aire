@extends('_layout')

@section('page-title')
	Tailwind Custom Forms
@endsection

@section('content')
	
	<?php (new \Galahad\AireCustomForms\AireCustomFormsServiceProvider(app()))->boot(); ?>
	
	<h1 class="text-2xl text-gray-900">
		Tailwind Custom Forms
	</h1>
	
	<div class="mt-4 mb-8 p-6 border rounded leading-normal bg-yellow-100 border-yellow-300 text-yellow-800">
		<strong>Please note:</strong> This theme is a work-in-progress. It is not ready
		for production&mdash;use at your own risk!
	</div>
	
	<p>
		If you're using the <a href="https://github.com/tailwindcss/custom-forms" target="_blank">Tailwind custom forms</a>
		plugin, you can use it by adding <code>glhd/aire-tailwind-custom-forms</code> to your project. If
		you're using Laravel package auto-discovery, there's nothing else you need to do (just make sure you've
		<a href="https://tailwindcss-custom-forms.netlify.com/" target="_blank">installed the tailwind plugin</a>, too).
	</p>
	
	<h2>
		Installation
	</h2>
	
	<pre>composer require glhd/aire-tailwind-custom-forms</pre>
	
	<p>
		Once the plugin is installed, you can use <code>Aire</code> as you would normally,
		and all the custom forms classes will be applied:
	</p>
	
	<div class="border rounded my-12 relative">
		<h2 class="m-0 px-6 py-3 border-b text-salmon">
			Tailwind Custom Form
		</h2>
		
		<div class="p-4">
			
			{{ Aire::open()->post()->multipart()->validate() }}
			
			{{ Aire::input()
				->label('Demo Input')
				->id('demo')
				->helpText('This is demo help text.') }}
			
			{{ Aire::select(['one' => 'Option 1', 'two' => 'Option 2'])
				->label('Demo Select') }}
			
			{{ Aire::select(['one' => 'Option 1', 'two' => 'Option 2'])
				->multiple()
				->label('Demo Multi-Select') }}
			
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
		</div>
	</div>
	
	<?php Aire::resetTheme(); ?>

@endsection
