
<div class="mb-6 float-right inline-flex">
	<a href="https://github.com/glhd/aire/actions" target="_blank" class="mx-1">
		<img 
			src="https://github.com/glhd/aire/workflows/PHPUnit/badge.svg" 
			alt="Build Status" 
		/>
	</a>
	<a href="https://codeclimate.com/github/glhd/aire/test_coverage" target="_blank" class="mx-1">
		<img 
			src="https://api.codeclimate.com/v1/badges/f597a6e8d9f968a55f03/test_coverage" 
			alt="Coverage Status" 
		/>
	</a>
	<a href="https://packagist.org/packages/glhd/aire" target="_blank" class="mx-1">
        <img 
            src="https://poser.pugx.org/glhd/aire/v/stable" 
            alt="Latest Stable Release" 
        />
	</a>
	<a href="./LICENSE" target="_blank" class="mx-1">
        <img 
            src="https://poser.pugx.org/glhd/aire/license" 
            alt="MIT Licensed" 
        />
    </a>
    <a href="https://twitter.com/airephp" target="_blank" class="mx-1">
        <img 
            src="https://img.shields.io/twitter/follow/airephp?style=social" 
            alt="Follow @airephp on Twitter" 
        />
    </a>
    <a href="https://twitter.com/inxilpro" target="_blank" class="mx-1">
        <img 
            src="https://img.shields.io/twitter/follow/inxilpro?style=social" 
            alt="Follow @inxilpro on Twitter" 
        />
    </a>
</div>

<h1>
	<a href="https://airephp.com">
		<img src="https://airephp.com/logo.svg" width="192" height="181" alt="Aire" border="0" />
	</a>
</h1>

Aire is a modern Laravel form builder ([demo](https://airephp.com)) with a
focus on the same expressive and beautiful code you expect from the Laravel
ecosystem.

## Basic Usage

The most common usage is via the `Aire` facade in your blade templates. All method calls
are fluent, allowing for easy configuration of your form components:

```php
{{ Aire::open()
  ->route('users.update')
  ->bind($user) }}

{{ Aire::input('given_name', 'First/Given Name')
    ->id('given_name') }}
    
{{ Aire::input('family_name', 'Last/Family Name')
    ->id('family_name')
    ->autoComplete('off') }}
  
{{ Aire::email('email', 'Email Address')
    ->helpText('Please use your company email address.') }}
  
{{ Aire::submit('Update User') }}
  
{{ Aire::close() }}
```

### Blade Components

As of Aire 2.4.0, you can also use all Aire elements as [Blade Components](https://laravel.com/docs/8.x/blade#components).
The above form is identical to:

```html
<x-aire::form route="users.update" :bind="$user">

    <x-aire::input 
        name="given_name" 
        label="First/Given Name" 
        id="given_name" 
    />
    <x-aire::input 
        name="family_name" 
        label="Last/Family Name" 
        id="family_name" 
        auto-complete="off" 
    />
    <x-aire::email 
        name="email" 
        label="Email Address" 
        help-text="Please use your company email address." 
    />
    
    <x-aire::submit label="Update User" />
    
</x-aire::form>
```

## Installation

Install via composer with:
```sh
composer require glhd/aire
```

## Customization

Aire comes with classes that should work with the default Tailwind class names
out of the box (`.bg-blue-600` etc). If you need to change the default class names
for any given element, there are two different ways to go about it.

The first is to publish the `aire.php` config file via `php artisan vendor:publish --tag=aire-config`
and update the `default_classes` config for the element you'd like to change:

```php
return [
  'default_classes' => [
    'input' => 'text-gray-900 bg-white border rounded-sm',
  ],
];
```

The second option is to publish custom views via `php artisan vendor:publish --tag=aire-views`
which gives you total control over component rendering. There's a view file for each component
type (`input.blade.php` etc) as well as for component grouping. This gives you the most
flexibility, but means that you have the maintain your views as Aire releases add new
features or change component rendering.

## Configuration

When you publish the `aire.php` config file via `php artisan vendor:publish --tag=aire-config`,
there are a handful of other configuration options. The config file is fully documented,
so go check it out!

## Data Binding

Aire automatically binds old input to your form so that values are preserved if a validation
error occurs. You can also bind data with the `bind()` method.

```php
// Bind Eloquent models
Aire::bind(User::find(1));

// Bind an array
Aire::bind(['given_name' => 'Chris']);

// Bind any object
Aire::bind((object) ['given_name' => 'Chris']);
```

### Binding Precedence

Binding is applied in the following order:

  1. Values set with `value()` are applied no matter what
  2. Old input is applied if available
  3. Bound data is applied last

## Method Spoofing & Inference

Aire will automatically add the Laravel `_method` field for forms that are not `GET` or `POST`.
It will also automatically infer the intended method from the route if possible.

```php
// In routes
Route::delete('/photos/{photo}', 'PhotosController@destroy')
	->name('photos.destroy');

// In your view
{{ Aire::open()->route('photos.destroy', $photo) }}
{{ Aire::close() }}
```

Will generate the resulting HTML:

```html
<form action="/photos/1" method="POST">
<input type="hidden" name="_method" value="DELETE" />
</form>
```

## Automatic CSRF Field

Aire will automatically inject a CSRF token if one exists and the form is not a `GET` form.
Simply enable the session and a hidden `_token` field will be injected for you.

## Server-Side Validation

If you run validations on the server, Aire will pick up any errors and automatically
apply error classes and show error messages within the associated input's group.

You can also include an error summary, which provides an easy way to show your users 
an error at the top of the page if validation failed.

```php
// Print "There are X errors on this page that you must fix before continuing."
{{ Aire::summary() }}

// Also include an itemized list of errors
{{ Aire::summary()->verbose() }}
```

## Client-Side Validation

Javascript validation in Aire is in its early stages. Browser testing is limited, and the
Javascript code hasn't had an performance optimizations applied. That said, Aire
supports automatic client-side validation—simply pass an array of rules or a `FormRequest`
object and Aire will automatically apply most rules on the client side (thanks
to [validatorjs](https://github.com/skaterdav85/validatorjs)!). 

## Laravel Version Support

Aire should run on Laravel 5.8.28 and higher, and PHP 7.1 and higher. Our policy is to test
the last two major releases of PHP and Laravel, so support below that is not guaranteed.

## Translations

Aire comes with support for a handful of languages (feel free to submit a PR!). If you would
like to add your own translations, you can do so by publishing them with:

```bash
php artisan vendor:publish --tag=aire-translations
```

## Under Consideration / Feature Ideas

There are a few things that are still either in-the-works or being considered for a 
later release. These include:

  - [Read-only plain text](http://getbootstrap.com/docs/4.1/components/forms/#readonly-plain-text) 
  - Cross-browser support for custom checkboxes and radio buttons via a config option
  - Support for Choices.js or similar `<select>` UI libraries
  - Better handling of file inputs
  - Better support for [prepending or appending content to inputs](https://getbootstrap.com/docs/4.0/components/input-group/#basic-example)
