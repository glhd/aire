
<div>
  <a href="https://travis-ci.org/glhd/aire" target="_blank">
    <img 
      src="https://travis-ci.org/glhd/aire.svg?branch=master" 
      alt="Build Status" 
    />
  </a>
  <a href="https://coveralls.io/github/glhd/aire?branch=master" target="_blank">
      <img 
          src="https://coveralls.io/repos/github/glhd/aire/badge.svg?branch=master" 
          alt="Coverage Status" 
      />
    </a>
</div>

# Aire

Aire is a modern Laravel form builder ([demo](https://glhd.github.io/aire/)).

# Configuration

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

# Usage

The most common usage is via the `Aire` facade in your blade templates. All method calls
are fluent, allowing for easy configuration of your form components:

```php
{{ Aire::bind($user) }}

{{ Aire::open()->route('users.update') }}

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

## Considerations/Inspiration

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

## Components

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
  
## Input Types

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


