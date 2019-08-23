@extends('_layout')

@section('page-title')
	Working w/ Elements
@endsection

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		Working with Elements
	</h1>
	
	<p>
		Aire&rsquo;s core element APIs are auto-generated from the
		<a href="https://github.com/atom/autocomplete-html" target="_blank">Atom Autocomplete</a>
		package, which in turn sources data from <a href="https://developer.mozilla.org" target="_blank">MDN</a>
		and <a href="https://github.com/adobe/brackets" target="_blank">Adobe Brackets</a>. This means that
		all web standards-compliant HTML attributes are built-in with named methods.
	</p>
	
	<p>
		Nearly all Aire attribute methods are fluent&mdash;they return the element instance to allow
		for chaining. For example:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::input()->label('Demo Input')->id('demo') }}@endverbatim</code></pre>
	
	<h2 class="mt-12">
		Element Class Names
	</h2>
	
	<p>
		If you're using Tailwind, you're going to want an easy way to adjust the class names
		applied to a given form element. Aire makes this easy, with <code>addClass()</code>
		and <code>removeClass()</code>. These are usually all you need to apply small adjustments
		on a case-by-case basis.
	</p>
	
	<h2 class="mt-12">
		Value
	</h2>
	
	<p>
		Most form elements can have a <code>value</code>. This value will automatically get
		set via data binding or using the old form input if there was an error. If you want
		to explicitly override the value, use the <code>value($value)</code> method. If, instead,
		you just want to set a value to use if no bound/old value is available, use
		the <code>defaultValue($value)</code> method.
	</p>
	
	<h2 class="mt-12">
		Data Attributes
	</h2>
	
	<p>
		If you need to add special <code>data-</code> attributes to your elements,
		use the <code>data($key, $value)</code> method. If you pass <code>NULL</code>
		as the value, the data attribute will be unset. If you pass an array or an
		object that implements on of: <code>Jsonable</code>, <code>JsonSerializable</code>,
		or <code>Arrayable</code>, that value will automatically be JSON-encoded for
		you (useful for passing data to javascript).
	</p>
	
	<h2 class="mt-12">
		Arbitrary Attributes
	</h2>
	
	<p>
		If you want to set your own arbitrary attributes on an element (say,
		<a href="https://livewire-framework.com/docs/triggering-actions/" target="_blank"><code>wire:click</code></a>),
		you can use the <code>setAttribute($key, $value)</code> method, which will set
		whatever attribute you choose regardless of whether it's valid HTML.
	</p>
	
	<h2 class="mt-12">
		Global Attributes
	</h2>
	
	<p>
		There are some attributes that are global to all HTML elements. Each of these are documented
		in <code>Galahad\Aire\DTD\Concerns\HasGlobalAttributes</code>. These are:
	</p>
	
	@include('_global-attributes')
	
	<h2 class="mt-12">
		Element Attributes
	</h2>
	
	<p>
		Many elements have their own set of attributes. These include:
	</p>
	
	@include('_element-attributes')

@endsection
