@extends('_layout')

@section('page-title')
	Themes
@endsection

@section('content')
	
	<h1 class="text-2xl text-gray-900">
		Aire Themes
	</h1>
	
	<div class="mt-4 mb-8 p-6 border rounded leading-normal bg-yellow-100 border-yellow-300 text-yellow-800">
			<strong>Please note:</strong> Aire themes are mostly meant for package developers. If you
			just want to customize the look and feel for your project, see <a href="{{ url('/') }}">
				the customization section of the README</a>.
	</div>
	
	<p>
		Out of the box, Aire comes with <a href="https://tailwindcss.com/" target="_blank">Tailwind</a>-based
		templates that mostly mimic Bootstrap 4's aesthetic. It's easy to publish reusable Aire themes
		using Laravel's package auto-discovery.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-gray-300">
		<code>Aire::setTheme($namespace = null, $prefix = null, $config = [])</code>
	</h2>
	
	<p>
		Calling <code>setTheme()</code> will tell Aire where to look for its associated
		templates &amp; apply any overrides to the configuration. By default, Aire loads views in
		the format <code>&quot;aire::input&quot;</code>.
		Calling <code>Aire::setTheme(&quot;mynamespace&quot;, &quot;dark-variant&quot;)</code> would
		cause Aire to look for the input view at <code>&quot;mynamespace::dark-variant.input&quot;</code>
		which makes it easy to either publish a single theme, or multiple variants of the same theme
		under one package.
	</p>
	
	<p>
		If you're using <a href="https://laravel.com/docs/packages#package-discovery" target="_blank">package discovery</a>,
		you can add a call to <code>Aire::setTheme()</code> in your service provider's <code>boot()</code>
		method, and your theme will be automatically enabled when installed. This means that running…
	</p>
	
	<pre><code class="language-shell">composer require glhd/aire example/aire-sample-theme</code></pre>
	
	<p>
		…is all the end-user needs to do to use Aire and your theme!
	</p>
	
	<h3>
		Theme Package Structure
	</h3>
	
	<p>
		A basic Aire theme would end up looking something like:
	</p>
	
	<ul class="pl-8">
		<li>
			<code>aire-sample-theme/</code>
			<ul class="pl-8 pb-8">
				<li>
					<a href="#theme-composer.json">
						<code>composer.json</code>
					</a>
				</li>
				<li>
					<code>src/</code>
					<ul class="pl-8 pb-8">
						<li>
							<a href="#theme-service-provider">
								<code>AireSampleThemeServiceProvider</code>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<code>views/</code>
					<ul class="pl-8">
						<li>
							<code>form.blade.php</code>
						</li>
						<li>
							<code>input.blade.php</code>
						</li>
						<li>
							<code>...</code>
						</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	
	<h3 id="theme-composer.json">
		Sample <code>composer.json</code> file
	</h3>
	
	<pre><code class="language-json">{
  "name": "example/aire-sample-theme",
  "description": "My custom Aire theme",
  "require": {
    "glhd/aire": "^1.1.0",
  },
  "autoload": {
    "psr-4": {
      "Example\\AireSampleTheme\\": "src/"
    }
  },
  "extra": {
    "laravel": {
      "providers": [
        "Example\\AireSampleTheme\\AireSampleThemeServiceProvider"
      ]
    }
  }
}</code></pre>
	
	<h3 id="theme-service-provider">
		Sample Service Provider
	</h3>
	
	<pre><code class="language-php">namespace Example\AireSampleTheme;

use Galahad\Aire\Aire;
use Illuminate\Support\ServiceProvider;

class AireSampleThemeServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadViewsFrom(dirname(__DIR__).'/views', 'aire-sample');
		
		Aire::setTheme('aire-sample', null, array_replace_recursive(
			// If you want to merge in the default Aire theme,
			// you can load it via this static method
			\Galahad\Aire\Aire::getDefaultThemeConfig(),
			[
				'default_classes' => [
					'input' => 'my-custom-input-class',
				],
			]
		));
	}
}</code></pre>

@endsection
