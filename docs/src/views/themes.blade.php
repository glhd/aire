@extends('_layout')

@section('content')
	
	<h1>
		Aire Themes
	</h1>
	
	<p>
		Out of the box, Aire comes with <a href="https://tailwindcss.com/" target="_blank">Tailwind</a>-based
		templates that mostly mimic Bootstrap 4's aesthetic. It's easy to publish reusable Aire themes
		using Laravel's package auto-discovery.
	</p>
	
	<h2 class="mt-8 pt-8 border-t border-grey-lighter">
		<code>Aire::setTheme($namespace = null, $prefix = null)</code>
	</h2>
	
	<p>
		Calling <code>setTheme()</code> will tell Aire where to look for its associated
		templates. By default, Aire loads views in the format <code>&quot;aire::input&quot;</code>.
		Calling <code>Aire::setTheme(&quot;mynamespace&quot;, &quot;dark-variant&quot;)</code> would
		cause Aire to look for the input view at <code>&quot;mynamespace::dark-variant.input&quot;</code>
		which makes it easy to either publish a single theme, or multiple variants of the same theme
		nder one package.
	</p>
	
	<p>
		If you're using <a href="https://laravel.com/docs/packages#package-discovery" target="_blank">package discovery</a>,
		you can add a call to <code>Aire::setTheme()</code> in your service provider's <code>boot()</code>
		method, and your theme will be automatically enabled when installed. This means that running…
	</p>
	
	<pre><code class="language-shell">composer require glhd/aire demo/aire-bootstrap-theme</code></pre>
	
	<p>
		…is all the end-user needs to do to use Aire and your theme!
	</p>
	
	<h3>
		Theme Package Structure
	</h3>
	
	<p>
		A basic Aire theme would end up looking something like:
	</p>
	
	<ul>
		<li>
			<code>my-theme/</code>
			<ul>
				<li>
					<a href="#theme-composer.json">
						<code>composer.json</code>
					</a>
				</li>
				<li>
					<code>src/</code>
					<ul>
						<li>
							<a href="#theme-service-provider">
								<code>MyThemeServiceProvider</code>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<code>views/</code>
					<ul>
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
  "name": "example/aire-bootstrap-theme",
  "description": "Aire theme providing Bootstrap 4-compatible markup and styling.",
  "require": {
    "glhd/aire": "dev-master",
  },
  "autoload": {
    "psr-4": {
      "Example\\AireBootstrapTheme\\": "src/"
    }
  },
  "extra": {
    "laravel": {
      "providers": [
        "Example\\AireBootstrapTheme\\AireBootstrapThemeServiceProvider"
      ]
    }
  }
}</code></pre>
	
	<h3 id="theme-service-provider">
		Sample Service Provider
	</h3>
	
	<pre><code class="language-php">namespace Example\AireBootstrapTheme;

use Galahad\Aire\Aire;
use Illuminate\Support\ServiceProvider;

class AireBootstrapThemeServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->loadViewsFrom(dirname(__DIR__).'/views', 'example-aire-bootstrap');
		Aire::setTheme('example-aire-bootstrap');
	}
}</code></pre>

@endsection
