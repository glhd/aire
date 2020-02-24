@extends('_layout')

@section('page-title')
	Aire + Alpine.js
@endsection

@push('head')
	<script src="https://unpkg.com/alpinejs@1.12.0/dist/alpine-ie11.js" defer></script>
@endpush

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		Aire + Alpine.js
	</h1>
	
	<p>
		Aire comes with built-in support for <a href="https://github.com/alpinejs/alpine" target="_blank">Alpine.js</a>,
		a reactive JavaScript library built for server-generated markup. Alpine lets you add sophisticated
		interactions to your forms without committing to a full-scale single page app. 
	</p>
	
	<p>
		All you need to do to enable Alpine integration is use the <code>asAlpineComponent()</code> method:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::route('demo.store')->asAlpineComponent() }}@endverbatim</code></pre>
	
	<p>
		This will do two things for you:
	</p>
	
	<ol class="pl-8 mb-8 list-decimal">
		<li class="my-2">
			Set up the <code>x-data</code> attribute on your <code>{{ '<form>' }}</code> tag.
		</li>
		<li class="my-2">
			Add <code>x-model</code> attributes to each of your elements.
		</li>
	</ol>
	
	<p>
		Aire uses all the same data binding logic for <code>x-data</code>, so that you’re ready
		to go without any additional work:
	</p>
	
	<h2 class="mb-0">
		Sample Code:
	</h2>
	<pre class="mt-2"><code class="language-php">@verbatim{{ Aire::open()->bind(['comment' => 'Alpine.js is great.'])->asAlpineComponent() }}
{{ Aire::input('comment', 'Your Comment') }}
{{ Aire::select(['5' => '5 stars', '11' => '11 stars'], 'alpine_rating')->defaultValue('5') }}

&lt;div class="my-4 p-2 border rounded"&gt;
  &lt;div class="font-bold mb-1"&gt;Preview Your Review&lt;/div&gt;
  &lt;div class="italic text-lg font-serif"&gt;“&lt;span x-text="comment"&gt;&lt;/span&gt;”&lt;/div&gt;
  &lt;div class="text-sm font-bold"&gt;&lt;span x-text="rating"&gt;&lt;/span&gt; stars&lt;/div&gt;
&lt;/div&gt;

{{ Aire::submit('Submit Review') }}
{{ Aire::close() }}@endverbatim</code></pre>
	
	<h2 class="mb-0">
		Resulting Form:
	</h2>
	<div class="border rounded p-2 my-4">
	{{ Aire::open()->bind(['comment' => 'Alpine.js is great.'])->asAlpineComponent() }}
	{{ Aire::input('comment', 'Your Comment') }}
	{{ Aire::select(['5' => '5 stars', '11' => '11 stars'], 'rating')->defaultValue('5') }}
	<div class="my-4 p-2 border rounded">
		<div class="font-bold mb-1">Preview Your Review</div>
		<div class="italic text-lg font-serif">“<span x-text="comment"></span>”</div>
		<div class="text-sm font-bold"><span x-text="rating"></span> stars</div>
	</div>
	{{ Aire::submit('Submit Review') }}
	{{ Aire::close() }}
	</div>
	
	<h2 class="mb-0">
		Effective HTML (just showing Alpine-specific portions):
	</h2>
	<pre class="mt-2"><code class="language-php">@verbatim&lt;form x-data="{'comment': 'Alpine.js is great.', 'rating': '5'}"&gt;
&lt;input name="comment" x-model="comment" /&gt;
&lt;select name="rating" x-model="rating"&gt;
  &lt;option value="5"&gt;5 stars&lt;/option&gt;
  &lt;option value="11"&gt;11 stars&lt;/option&gt;
&lt;/select&gt;
&lt;div class="my-4 p-2 border rounded"&gt;
  &lt;div class="font-bold mb-1"&gt;Preview Your Review&lt;/div&gt;
  &lt;div class="italic text-lg font-serif"&gt;“&lt;span x-text="comment"&gt;&lt;/span&gt;”&lt;/div&gt;
  &lt;div class="text-sm font-bold"&gt;&lt;span x-text="rating"&gt;&lt;/span&gt; stars&lt;/div&gt;
&lt;/div&gt;
&lt;button type="submit"&gt;Submit Review&lt;/button&gt;
&lt;/form&gt;@endverbatim</code></pre>

@endsection
