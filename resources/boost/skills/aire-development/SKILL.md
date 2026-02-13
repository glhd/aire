---
name: aire-development
description: Build and work with Aire forms in Laravel, including the fluent PHP API, Blade components, data binding, validation, and theming.
---

# Aire Form Development

## When to use this skill

Use this skill when creating, modifying, debugging, or styling HTML forms in a Laravel application that uses the `glhd/aire` package. This includes any work involving form elements, data binding, validation, or form theming.

## Overview

Aire is a Laravel form builder with a fluent API. It is accessed via the `Aire` facade (`Galahad\Aire\Support\Facades\Aire`) or via `<x-aire::*>` Blade components. Aire automatically handles CSRF tokens, HTTP method spoofing, old input repopulation, and server-side validation error display.

## Opening and Closing Forms

Every form must be opened and closed. Aire uses output buffering between open and close to capture form fields.

### Facade API

```php
{{ Aire::open()->route('users.store') }}
    {{-- form fields --}}
{{ Aire::close() }}
```

### Blade Component API

```html
<x-aire::form route="users.store">
    {{-- form fields --}}
</x-aire::form>
```

### Setting the Action

```php
// From a named route (method is inferred automatically):
Aire::open()->route('users.store')
Aire::open()->route('users.update', $user)

// From a URL:
Aire::open()->action('/users')

// Resourceful (auto-detects store vs. update based on model existence):
Aire::open()->resourceful($user)
Aire::open()->resourceful($user, 'admin.users')
```

### HTTP Methods

Aire automatically infers the method from the route. You can also set it explicitly:

```php
Aire::open()->route('users.store')           // POST (inferred)
Aire::open()->route('users.update', $user)   // PUT (inferred)
Aire::open()->post()
Aire::open()->put()
Aire::open()->patch()
Aire::open()->delete()
```

For `PUT`, `PATCH`, and `DELETE`, Aire automatically adds a hidden `_method` field and sets the real method to `POST`.

### Form Encoding

```php
Aire::open()->multipart()    // multipart/form-data (required for file uploads)
Aire::open()->urlEncoded()   // application/x-www-form-urlencoded
```

## Data Binding

Bind an Eloquent model, array, or object to auto-populate form fields:

```php
{{ Aire::open()->route('users.update', $user)->bind($user) }}
    {{ Aire::input('name', 'Name') }}   {{-- pre-filled with $user->name --}}
{{ Aire::close() }}
```

Or with `resourceful` (which calls `bind` internally):

```php
{{ Aire::open()->resourceful($user) }}
```

**Value precedence** (highest to lowest):
1. Explicitly set via `->value()`
2. Old input from session (after validation failure)
3. Bound data from the model/array/object

## Available Form Elements

### Text Inputs

```php
Aire::input('name', 'Full Name')
Aire::email('email', 'Email Address')
Aire::password('password', 'Password')
Aire::search('q', 'Search')
Aire::tel('phone', 'Phone')
Aire::url('website', 'Website')
Aire::number('age', 'Age')
Aire::range('rating', 'Rating', 1, 10)
```

### Date and Time Inputs

```php
Aire::date('start_date', 'Start Date')
Aire::dateTime('event_at', 'Event Date/Time')
Aire::dateTimeLocal('local_at', 'Local Date/Time')
Aire::time('start_time', 'Start Time')
Aire::month('birth_month', 'Birth Month')
Aire::week('target_week', 'Target Week')
```

### Other Inputs

```php
Aire::color('theme_color', 'Theme Color')
Aire::file('avatar', 'Avatar')
Aire::hidden('user_id', $user->id)
```

### Textarea

```php
Aire::textArea('bio', 'Biography')
```

### Select

```php
// Options as key => value array:
Aire::select(['draft' => 'Draft', 'published' => 'Published'], 'status', 'Status')

// Timezone select (pre-populated):
Aire::timezoneSelect('timezone', 'Timezone')
```

### Checkboxes

```php
// Single checkbox:
Aire::checkbox('terms', 'I agree to the terms')

// Checkbox group (multiple values):
Aire::checkboxGroup(['red' => 'Red', 'blue' => 'Blue', 'green' => 'Green'], 'colors', 'Favorite Colors')
```

### Radio Buttons

```php
Aire::radioGroup(['sm' => 'Small', 'md' => 'Medium', 'lg' => 'Large'], 'size', 'Size')
```

### Buttons

```php
Aire::submit('Save')
Aire::button('Cancel')
```

### Error Summary

Display a summary of all validation errors at the top of the form:

```php
Aire::summary()            // Shows error count
Aire::summary()->verbose() // Shows itemized error list
```

## Blade Component Syntax

All elements are available as `<x-aire::*>` Blade components. Method names become kebab-case attributes:

```html
<x-aire::form route="users.store" :bind="$user">
    <x-aire::input name="name" label="Full Name" required />
    <x-aire::email name="email" label="Email Address" />
    <x-aire::select name="role" label="Role" :options="['admin' => 'Admin', 'user' => 'User']" />
    <x-aire::text-area name="bio" label="Biography" />
    <x-aire::checkbox name="active" label="Active" />
    <x-aire::radio-group name="plan" label="Plan" :options="['free' => 'Free', 'pro' => 'Pro']" />
    <x-aire::summary />
    <x-aire::submit label="Create User" />
</x-aire::form>
```

## Fluent Element Methods

All elements support chaining. Common methods available on every input element:

```php
Aire::input('name', 'Name')
    ->id('custom-id')               // Set the element ID
    ->value('default')              // Set an explicit value
    ->required()                    // HTML required attribute
    ->disabled()                    // HTML disabled attribute
    ->readOnly()                    // HTML readonly attribute
    ->placeholder('Enter name')     // Placeholder text
    ->autoComplete('name')          // Autocomplete attribute
    ->autoFocus()                   // Autofocus attribute
    ->addClass('custom-class')      // Add CSS class
    ->removeClass('old-class')      // Remove CSS class
    ->data('key', 'value')          // data-* attribute
    ->variant('lg')                 // Apply a theme variant
    ->variants('lg primary')        // Apply multiple variants
```

## Grouping (Labels, Help Text, Errors)

By default, every form element is wrapped in a "group" that renders a label, the input, help text, and validation errors together. This is controlled by the `group_by_default` config option.

```php
Aire::input('name')
    ->label('Full Name')             // Set the label text
    ->helpText('Enter your legal name')  // Help text below the input
    ->withoutGroup()                 // Render input without the group wrapper
    ->grouped()                     // Force grouping (if disabled by default)
    ->groupClass('mb-4')             // Add CSS class to the group wrapper
    ->groupId('name-group')          // Set group wrapper ID
    ->prepend('$')                   // Prepend content inside the group
    ->append('.00')                  // Append content inside the group
```

## Validation

### Server-Side Validation Errors

Aire automatically reads errors from the session (set by Laravel's `validate()` or `FormRequest`) and displays them inline within each element's group. No extra configuration needed.

### Using a Custom Error Bag

```php
Aire::open()->errorBag('login')
```

### Client-Side Validation

Aire includes optional JavaScript-based client-side validation using the `validatorjs` library:

```php
// Pass validation rules directly:
Aire::open()
    ->route('users.store')
    ->validate([
        'name' => 'required|min:3',
        'email' => 'required|email',
    ])

// Or reference a FormRequest class:
Aire::open()
    ->route('users.store')
    ->validate(StoreUserRequest::class)

// Disable client-side validation for a specific form:
Aire::open()->withoutValidation()
```

## Alpine.js Integration

Aire can generate `x-data` and `x-model` attributes for Alpine.js:

```php
Aire::open()->asAlpineComponent()
Aire::open()->asAlpineComponent(['extra_key' => 'value'])
```

When enabled, each input element will get an `x-model` attribute matching its name, and the form gets an `x-data` attribute with JSON-serialized initial values.

## Theming and Customization

### Publishing Configuration

```bash
php artisan vendor:publish --tag=aire-config
```

This publishes `config/aire.php` where you can set:

- `default_classes`: CSS classes for each element type
- `variant_classes`: Named style variants (e.g., `sm`, `lg`, `primary`)
- `validation_classes`: CSS classes for validation states (`none`, `valid`, `invalid`)
- `group_by_default`: Whether elements are grouped by default
- `validate_by_default`: Whether client-side validation is on by default

### Publishing Views

```bash
php artisan vendor:publish --tag=aire-views
```

Override any Blade template in `resources/views/vendor/aire/`.

### Custom Themes

```php
// In a service provider:
$aire->setTheme('my-theme-namespace', 'optional-prefix', $configArray);
```

## Complete Form Examples

### Create Form

```php
{{ Aire::open()->route('posts.store') }}
    {{ Aire::summary() }}
    {{ Aire::input('title', 'Title')->required() }}
    {{ Aire::textArea('body', 'Content') }}
    {{ Aire::select(['draft' => 'Draft', 'published' => 'Published'], 'status', 'Status') }}
    {{ Aire::submit('Create Post') }}
{{ Aire::close() }}
```

### Edit Form with Model Binding

```php
{{ Aire::open()->resourceful($post) }}
    {{ Aire::summary() }}
    {{ Aire::input('title', 'Title')->required() }}
    {{ Aire::textArea('body', 'Content') }}
    {{ Aire::select(['draft' => 'Draft', 'published' => 'Published'], 'status', 'Status') }}
    {{ Aire::submit('Update Post') }}
{{ Aire::close() }}
```

### Delete Form

```php
{{ Aire::open()->route('posts.destroy', $post) }}
    {{ Aire::submit('Delete Post')->variant('danger') }}
{{ Aire::close() }}
```

### Form with Client-Side Validation

```php
{{ Aire::open()->route('users.store')->validate(StoreUserRequest::class) }}
    {{ Aire::summary() }}
    {{ Aire::input('name', 'Name')->required() }}
    {{ Aire::email('email', 'Email')->required() }}
    {{ Aire::password('password', 'Password')->required() }}
    {{ Aire::password('password_confirmation', 'Confirm Password')->required() }}
    {{ Aire::submit('Register') }}
{{ Aire::close() }}
```

### File Upload Form

```php
{{ Aire::open()->route('avatars.store')->multipart() }}
    {{ Aire::file('avatar', 'Profile Photo') }}
    {{ Aire::submit('Upload') }}
{{ Aire::close() }}
```

### Blade Component Form

```html
<x-aire::form :resourceful="$user">
    <x-aire::summary />
    <x-aire::input name="name" label="Name" required />
    <x-aire::email name="email" label="Email" required />
    <x-aire::select name="role" label="Role" :options="$roles" />
    <x-aire::checkbox name="is_admin" label="Administrator" />
    <x-aire::submit label="Save" />
</x-aire::form>
```
