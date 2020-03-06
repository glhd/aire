@extends('_layout')

@section('page-title')
	Scaffolding Forms
@endsection

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		Scaffolding Forms
	</h1>
	
	<p>
		If you need to get started quickly, or just want a basic CRUD form that
		doesn't have sophisticated design needs, you can use Aire's scaffolding
		to generate an entire form in seconds.
	</p>
	
	<p>
		Imagine that you had the following Eloquent Model:
	</p>
	
	<pre class="mt-2"><code class="language-php">{{ file_get_contents(__DIR__.'/../Samples/Author.php') }}</code></pre>
	
	<p>
		Now, by calling:
	</p>
	
	<pre class="mt-2"><code class="language-php">@verbatim{{ Aire::scaffold(Docs\Samples\Author::class) }}@endverbatim</code></pre>
	
	<p>
		You get:
	</p>
	
	<div class="border rounded p-2 my-4">
		{{ Aire::scaffold(Docs\Samples\Author::class) }}
	</div>
	
	<p>
		Or, if you need to edit an existing model, pass that in instead of the model class name:
	</p>
	
	<pre class="mt-2"><code class="language-php">@verbatim{{ Aire::scaffold(Docs\Samples\Author::find(1)) }}@endverbatim</code></pre>
	
	<?php
	$author = new Docs\Samples\Author();
	$author->setRawAttributes([
		'id' => 1,
		'name' => 'N.K. Jemisin',
		'is_favorite' => true,
		'last_read_at' => now(),
	], false);
	$author->exists = true;
	?>
	
	<div class="border rounded p-2 my-4">
		{{ Aire::scaffold($author) }}
	</div>

@endsection
