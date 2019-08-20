@extends('_layout')

@section('page-title')
	Aire API Overview
@endsection

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		Aire API Overview
	</h1>
	
	<p>
		Aire is designed to be fluent and expressive. Methods are chainable when
		possible, and most things &ldquo;<em>just work</em>&rdquo; without too much
		effort.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		Using the <code>Aire</code> facade or <code>aire()</code> helper
	</h2>
	
	<p>
		For the most part, everything is accessed via the <code>Aire</code> facade
		or the <code>aire()</code> helper method. All code examples from here on out
		will use the facade syntax, but the helper works exactly the same.
	</p>
	
	<p>
		Most calls to <code>Aire</code> are passed down to the currently active form.
		The first call to any method will instantiate a new Form instance for you.
		All subsequent calls will be passed to that instance until you create a new
		form.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		Opening a new <code>Form</code>
	</h2>
	
	<p>
		Typically, the first step to using Aire is to instantiate a new Form and
		open it. You can do that in a single call, with:
	</p>
	
	<p>
		<code>Aire::open($action = null, $bound_data = null)</code>
	</p>
	
	<p class="text-gray-600 ml-4 pl-4 border-l-4 italic">
		You can instantiate a new form with <code>Aire::form()</code>,
		but in practice you'll rarely need this step.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		Adding an <code>Element</code> to the <code>Form</code>
	</h2>
	
	<p>
		Aire provides most common form elements and has helper methods
		to quickly instantiate them. All elements are fluent, which means
		that configuring them is quick and easy.
	</p>
	
	<p>
		The elements that Aire provides are:
	</p>
	
	<ul class="pl-8 pb-8 list-disc">
		<li><code>&lt;form&gt;</code></li>
		<li><code>&lt;input&gt;</code></li>
		<li><code>&lt;select&gt;</code></li>
		<li><code>&lt;textarea&gt;</code></li>
		<li><code>&lt;button&gt;</code></li>
	</ul>
	
	<p>
		The <code>Input</code> element supports the following types:
	</p>
	
	<ul class="pl-8 pb-8 list-disc">
		<li><code>checkbox</code></li>
		<li><code>color</code></li>
		<li><code>date</code></li>
		<li><code>datetime</code></li>
		<li><code>datetime-local</code></li>
		<li><code>email</code></li>
		<li><code>file</code></li>
		<li><code>hidden</code></li>
		<li><code>image</code></li>
		<li><code>month</code></li>
		<li><code>number</code></li>
		<li><code>password</code></li>
		<li><code>radio</code></li>
		<li><code>range</code></li>
		<li><code>reset</code></li>
		<li><code>search</code></li>
		<li><code>submit</code></li>
		<li><code>tel</code></li>
		<li><code>text</code></li>
		<li><code>time</code></li>
		<li><code>url</code></li>
		<li><code>week</code></li>
	</ul>
	
	<p>
		Aire also supports special <code>RadioGroup</code> and <code>CheckboxGroup</code> faux-elements
		that abstract away managing the values of individual radio buttons or multi-value checkboxes.
	</p>
	
	<p>
		Each element and input type can be instantiated directly from the
		<code>Aire</code> facade or from the current <code>Form</code>
		instance.
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::open() }}
			
{{ Aire::input('name', 'Your Name') }} {{-- Creates a text input --}}

{{ Aire::email('email_address', 'Your Email Address') }} {{-- Creates an email input --}}

{{ Aire::submit('Submit') }} {{-- Creates a button input with type="submit" --}}

{{ Aire::close() }}@endverbatim</code></pre>
	
	<p>
		Each helper method provides the most common properties as parameters. Below
		is an overview of each method signature:
	</p>
	
	<ul class="pl-8 pb-8 list-disc">
		<li><code>Aire::input($name = null, $label = null)</code></li>
		<li><code>Aire::hidden($name = null, $value = null)</code></li>
		<li><code>Aire::color($name = null, $label = null)</code></li>
		<li><code>Aire::date($name = null, $label = null)</code></li>
		<li><code>Aire::dateTime($name = null, $label = null)</code></li>
		<li><code>Aire::dateTimeLocal($name = null, $label = null)</code></li>
		<li><code>Aire::email($name = null, $label = null)</code></li>
		<li><code>Aire::file($name = null, $label = null)</code></li>
		<li><code>Aire::image($name = null, $label = null)</code></li>
		<li><code>Aire::month($name = null, $label = null)</code></li>
		<li><code>Aire::number($name = null, $label = null)</code></li>
		<li><code>Aire::password($name = null, $label = null)</code></li>
		<li><code>Aire::radio($name = null, $label = null)</code></li>
		<li><code>Aire::range($name = null, $label = null, $min = 0, $max = 100)</code></li>
		<li><code>Aire::search($name = null, $label = null)</code></li>
		<li><code>Aire::tel($name = null, $label = null)</code></li>
		<li><code>Aire::time($name = null, $label = null)</code></li>
		<li><code>Aire::url($name = null, $label = null)</code></li>
		<li><code>Aire::week($name = null, $label = null)</code></li>
		<li><code>Aire::button(string $label = null)</code></li>
		<li><code>Aire::submit(string $label = 'Submit')</code></li>
		<li><code>Aire::select(array $options, $name = null, $label = null)</code></li>
		<li><code>Aire::textArea($name = null, $label = null)</code></li>
		<li><code>Aire::checkbox($name = null, $label = null)</code></li>
	</ul>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		Summary Helper
	</h2>
	
	<p>
		Aire comes with a special element that can be added to your form using
		<code>Aire::summary()</code>. If you're using Laravel form validation,
		this element will show a short summary of the errors on the page, if any
		exist:
	</p>
	
	<div class="border border-red-500 bg-red-100 text-red-500 font-bold rounded p-4 my-4">
		There are 2 errors on this page that you must fix before continuing.
	</div>
	
	<p>
		You can also add additional information to the summary block with
		<code>Aire::summary()->verbose()</code>.
	</p>
	
	<div class="border border-red-500 bg-red-100 text-red-500 font-bold rounded p-4 my-4">
		There are 2 errors on this page that you must fix before continuing.
		<ul class="pt-4">
			<li>The name is required.</li>
			<li>The email address is required.</li>
		</ul>
	</div>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		Element Groups
	</h2>
	
	<p>
		One of the major benefits of a form builder like Aire is that all the boilerplate
		markup that wraps around your form elements can be generated for you. All Aire
		elements are groupable, which allows you to associate things like a <strong>label</strong>,
		or <strong>help text</strong> to the element without worrying about additional markup.
	</p>
	
	<p>
		Where it makes sense, elements are grouped by default. This means that <code>Aire::input()</code>
		can be passed a <code>->label()</code> and it will just work. You can override these defaults
		by calling <code>grouped()</code> to enable grouping, or <code>withoutGroup()</code> to disable
		it. Groups provide a few additional methods to any element:
	</p>
	
	<ul class="pl-8 pb-8 list-disc">
		<li>
			<code>label(string $text)</code>
			sets the label text for the element
		</li>
		<li>
			<code>helpText(string $text)</code>
			adds help text/instructions below the element
		</li>
		<li>
			<code>valid()</code>
			marks the group as valid (this is usually handled automatically,
			but you have the option to manually set it if you like)
		</li>
		<li>
			<code>invalid()</code>
			marks the group as invalid (this is usually handled automatically,
			but you have the option to manually set it if you like)
		</li>
		<li>
			<code>errors($message)</code>
			adds a specific error message to be shown below the element
		</li>
		<li>
			<code>prepend(string $text)</code>
			prepends text inline before the element
		</li>
		<li>
			<code>append(string $text)</code>
			appends text inline after the element
		</li>
	</ul>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		Resourceful Helper
	</h2>
	
	<p>
		If you're using standard resourceful routing conventions, you can use
		the <code>resourceful()</code> helper. It take an instance of a model
		as its first parameter, and infers the route name, method, and model
		binding for you. For example, these examples are essentially the
		same:
	</p>
	
	<div class="border rounded-lg my-6">
		<div class="font-bold mx-4 mt-2">
			Update:
		</div>
		<div class="md:flex">
			<pre class="flex-1 m-4 md:mr-2"><code class="language-php">@verbatim{{ Aire::resourceful(User::find(1)) }}@endverbatim</code></pre>
			<pre class="flex-1 m-4 md:ml-2"><code class="language-php">@verbatim{{ Aire::open()
	->route('users.update', 1)
	->bind(User::find(1))
	->put() }}@endverbatim</code></pre>
		</div>
		<div class="font-bold mx-4 mt-2">
			Create:
		</div>
		<div class="md:flex">
			<pre class="flex-1 m-4 md:mr-2"><code class="language-php">@verbatim{{ Aire::resourceful(new User()) }}@endverbatim</code></pre>
			<pre class="flex-1 m-4 md:ml-2"><code class="language-php">@verbatim{{ Aire::open()
	->route('users.store')
	->post() }}@endverbatim</code></pre>
		</div>
	</div>
	
	<p>
		This is particularly useful because you can use the same view partial for both
		your create and update views, and simple pass a <code>new Model()</code> into
		your create view.
	</p>
	
	<p>
		By default, Aire will guess the route name based on the model. <code>User</code>
		will become <code>users.store</code> and <code>users.update</code> and so forth.
		If you need your own name, pass it as the second parameter:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::resourceful(User::find(1), 'people') }}@endverbatim</code></pre>
	
	<p>
		Now Aire will use <code>people.store</code> and <code>people.update</code> depending
		on the state of the model passed in.
	</p>
	
	<p>
		If you're using a nested route, you can pass route parameters to prepend as the
		third option:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::resourceful($user, 'teams.users', [$team]) }}@endverbatim</code></pre>
	
	<p>
		Now Aire will use <code>teams.users.update</code> with <code>[$team, $user]</code>
		as the route parameters.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		Variants
	</h2>
	
	<p>
		As of Aire <code>1.5.0</code> we now support variants like <code>primary</code> or
		<code>sm</code>:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::input()->variant('sm') }}@endverbatim</code></pre>
	
	<p>
		If you're just applying one variant, you can use the syntax above or do it fluently:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::input()->variant()->sm() }}@endverbatim</code></pre>
	
	<p>
		If you're applying multiple variants, use the <code>variants()</code> method:
	</p>
	
	<pre><code class="language-php">@verbatim{{ Aire::input()->variants('sm', 'blue') }}@endverbatim</code></pre>
	
	<p>
		When you define your variants, you can use (arbitrary) keys to manage conflict resolution.
		For example, if this were our config:
	</p>
	
	<pre><code class="language-php">@verbatim[
	'variant_classes' => [
		'input' => [
			'default' => [
				'border' => 'border',
				'size' => 'p-2 text-base rounded',
				'color' => 'border-gray-200',
			],
			'primary' => [
				'color' => 'border-blue-300',
			],
			'sm' => [
				'size' => 'p-1 text-sm rounded-sm',
			],
		],
	],
]@endverbatim</code></pre>
	
	<p>
		Using the keys <code>color</code> and <code>size</code> help us manage how
		<code>variants('sm', 'primary')</code> are applied (in this case, it would
		result in <code>class=&quot;border p-1 text-sm rounded-sm border-blue-300&quot;</code>).
	</p>

@endsection
