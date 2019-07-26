@extends('_layout')

@section('page-title')
	HTML in Buttons
@endsection

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		HTML in Buttons
	</h1>
	
	<p>
		Sometimes you want to render HTML inside of a button. Anything passed to the
		<code>label()</code> method is automatically escaped, so you need to use one
		of two options.
	</p>
	
	<h2>
		<code>Button::labelHtml()</code>
	</h2>
	
	<p>
		For simple HTML, use the <code>labelHtml()</code> method on the Button element:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::open() }}
	
{{ Aire::button()->labelHtml('&lt;strong>Important&lt;/strong>') }}

{{ Aire::close() }}@endverbatim</code></pre>
	
	<h2>
		<code>Aire::openButton()</code> and <code>Aire::closeButton()</code>
	</h2>
	
	<p>
		For more complex HTML, you can use Buttons much like Laravel components:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::open() }}
	
{{ Aire::openButton() }}

	@svg('danger-icon')
	This is &lt;strong>dangerous!&lt;/strong>

{{ Aire::closeButton() }}

{{ Aire::close() }}@endverbatim</code></pre>

@endsection
