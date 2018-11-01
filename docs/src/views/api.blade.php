@extends('_layout')

@section('content')
	
	<h1>
		Aire API Overview
	</h1>
	
	<p>
		Aire is designed to be fluent and expressive. Methods are chainable when
		possible, and most things &ldquo;<em>just work</em>&rdquo; without too much
		effort.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-grey-lighter">
		<code>Aire</code> <small>(or <code>aire()</code>)</small>
	</h2>
	
	<p>
		For the most part, everything is accessed via the <code>Aire</code> facade
		or the <code>aire()</code> helper method. Use the facade to open a form, and
		all subsequent calls will be passed onto that form.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-grey-lighter">
		<code>
			Aire::form($action = null, $bound_data = null)
		</code>
	</h2>
	
	<p>
		Calling <code>Aire::form()</code> will instantiate a new <code>Form</code>
		object. Pass in a URL to the first parameter to set the form's action. Pass
		and object, array, or Eloquent model to the second parameter to bind that
		data to the form. Bound data is used to populate fields where the field name
		matches the bound data.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-grey-lighter">
		<code>
			Aire::open($action = null, $bound_data = null)
		</code>
	</h2>
	
	<p>
		<code>Aire::open()</code> calls <code>Aire::form()</code> and then opens the form.
		When a form is opened, it begins output buffering and captures all output until
		<code>Aire::close()</code> is called. Typically, this will be your entry point
		for a new form.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-grey-lighter">
		<code>
			Aire::close()
		</code>
	</h2>
	
	<p>
		<code>Aire::close()</code> closes the currently opened form and renders it. Typically,
		you want to call this at the very end of your form.
	</p>

@endsection
