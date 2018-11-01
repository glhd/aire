
<div class="mb-6 text-right">
	<a href="https://circleci.com/gh/glhd/aire" target="_blank" class="no-underline">
		<img 
			src="https://circleci.com/gh/glhd/aire.svg?style=svg" 
			alt="Build Status" 
		/>
	</a>
	<a href="https://coveralls.io/github/glhd/aire?branch=master" target="_blank" class="no-underline">
		<img 
			src="https://coveralls.io/repos/github/glhd/aire/badge.svg?branch=master" 
			alt="Coverage Status" 
		/>
	</a>
	<a href="https://packagist.org/packages/glhd/aire" target="_blank" class="no-underline">
        <img 
            src="https://poser.pugx.org/glhd/aire/v/stable" 
            alt="Latest Stable Release" 
        />
	</a>
	<a href="./LICENSE" target="_blank" class="no-underline">
        <img 
            src="https://poser.pugx.org/glhd/aire/license" 
            alt="MIT Licensed" 
        />
    </a>
</div>

# Aire

Aire is a modern Laravel form builder ([demo](https://glhd.github.io/aire/)) with a
focus on the same expressive and beautiful code you expect from the Laravel
ecosystem.

## Basic Usage

The most common usage is via the `Aire` facade in your blade templates. All method calls
are fluent, allowing for easy configuration of your form components:

```php
{{ Aire::open()->route('users.update') }}

{{ Aire::bind($user) }}

<div class="flex flex-col md:flex-row">

  {{ Aire::input('given_name', 'First/Given Name')
    ->id('given_name')
    ->autoComplete('off')
    ->groupClass('flex-1 mr-2') }}
    
  {{ Aire::input('family_name', 'Last/Family Name')
    ->id('family_name')
    ->autoComplete('off')
    ->groupClass('flex-1') }}
  
</div>
  
{{ Aire::email('email', 'Email Address') }}
  
{{ Aire::submit('Update User') }}
  
{{ Aire::close() }}
```

## Customization

Aire comes with classes that should work with the default Tailwind class names
out of the box (`.bg-blue-dark` etc). If you need to change the default class names
for any given element, there are two different ways to go about it.

The first is to publish the `aire.php` config file via `php artisan vendor:publish --tag=config`
and update the `default_classes` config for the element you'd like to change:

```php
return [
  'default_classes' => [
    'input' => 'text-grey-darkest bg-white border rounded-sm',
  ],
];
```

The second option is to publish custom views via `php artisan vendor:publish --tag=views`
which gives you total control over component rendering. There's a view file for each component
type (`input.blade.php` etc) as well as for component grouping. This gives you the most
flexibility, but means that you have the maintain your views as Aire releases add new
features or change component rendering.

## Configuration

When you publish the `aire.php` config file via `php artisan vendor:publish --tag=config`,
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

Javascript validation in Aire is currently **work in progress**. Eventually, Aire will
support automatic client-side validation (just call `rules()` on a field). This will let
you set the rules on a field-by-field basis, or for the whole form, and will let you
pass in a `FormRequest` object to automatically inject rules.

## Misc. Notes

These notes are here mostly to inform development.

### Considerations/Inspiration

  - Form controls should take sizing config
  - 'Read-only plain text' http://getbootstrap.com/docs/4.1/components/forms/#readonly-plain-text
  - 'Form groups' - Label/input/help text/validation text (config how many errors show)
  - Multi-column forms (Name: {first} {last})
  - Configurable support for custom checkboxes and radios?
  - Custom select support?
  - File inputs?
  - Should client-side validation be included?
  - https://github.com/netojose/laravel-bootstrap-4-forms
  - https://tailwindcss.com/docs/examples/forms/
  - https://github.com/glhd/forms
  - https://github.com/glhd/bootforms
  - Append/Prepend (input groups)

### Components

  - Button
  - Checkbox
  - Date
  - DateTimeLocal
  - Email
  - File
  - FormControl
  - FormOpen
  - FormClose
  - Hidden
  - Input
  - Label
  - Password
  - RadioButton
  - Select
  - Text
  - TextArea
  
### Input Types

  - button
  - checkbox
  - color
  - date
  - datetime
  - datetime-local
  - email
  - file
  - hidden
  - image
  - month
  - number
  - password
  - radio
  - range
  - reset
  - search
  - submit
  - tel
  - text
  - time
  - url
  - wee 


