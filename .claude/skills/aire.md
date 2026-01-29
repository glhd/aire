# Aire - Laravel Form Builder

Aire is a modern Laravel form builder with a fluent, expressive API and seamless Tailwind CSS integration. It provides automatic data binding, validation, CSRF protection, and accessibility features.

## Installation

```bash
composer require glhd/aire
```

## Two Syntaxes: Facade and Blade Components

### Facade Syntax (Traditional)
```php
{{ Aire::open()->route('users.update')->bind($user) }}
{{ Aire::input('name', 'Full Name') }}
{{ Aire::email('email', 'Email Address') }}
{{ Aire::submit('Save') }}
{{ Aire::close() }}
```

### Blade Component Syntax (Laravel 8+)
```html
<x-aire::form route="users.update" :bind="$user">
    <x-aire::input name="name" label="Full Name" />
    <x-aire::email name="email" label="Email Address" />
    <x-aire::submit label="Save" />
</x-aire::form>
```

Both syntaxes are equivalent. Use whichever fits your project's conventions.

## Opening and Configuring Forms

### Basic Form Opening
```php
{{ Aire::open() }}                                    // Default POST to current URL
{{ Aire::open()->action('/users') }}                  // Explicit action URL
{{ Aire::open()->route('users.store') }}              // Named route
{{ Aire::open()->route('users.update', $user) }}      // Named route with parameters
```

### HTTP Methods
```php
{{ Aire::open()->get() }}
{{ Aire::open()->post() }}
{{ Aire::open()->put() }}      // Adds hidden _method field automatically
{{ Aire::open()->patch() }}    // Adds hidden _method field automatically
{{ Aire::open()->delete() }}   // Adds hidden _method field automatically
```

### Resourceful Forms (RESTful)
```php
// For new models: POST to store route
{{ Aire::open()->resourceful(new User()) }}

// For existing models: PUT to update route
{{ Aire::open()->resourceful($user) }}
```

### Form Encoding
```php
{{ Aire::open()->multipart() }}     // For file uploads (enctype="multipart/form-data")
{{ Aire::open()->urlEncoded() }}    // Standard form encoding
```

### Data Binding
```php
// Bind Eloquent model
{{ Aire::open()->bind($user) }}

// Bind array
{{ Aire::open()->bind(['name' => 'John', 'email' => 'john@example.com']) }}

// Bind object
{{ Aire::open()->bind((object) ['name' => 'John']) }}

// Nested data uses bracket notation: user[profile][bio]
```

**Binding Precedence:**
1. Explicit `value()` calls (highest priority)
2. Old input from session (after validation failure)
3. Bound data (lowest priority)

## Form Elements Reference

### Text Inputs
```php
{{ Aire::input('name', 'Full Name') }}
{{ Aire::email('email', 'Email Address') }}
{{ Aire::password('password', 'Password') }}
{{ Aire::search('query', 'Search') }}
{{ Aire::url('website', 'Website URL') }}
{{ Aire::tel('phone', 'Phone Number') }}
```

### Numeric Inputs
```php
{{ Aire::number('quantity', 'Quantity') }}
{{ Aire::range('volume', 'Volume', 0, 100) }}
```

### Date and Time Inputs
```php
{{ Aire::date('birth_date', 'Date of Birth') }}
{{ Aire::dateTime('appointment', 'Appointment') }}
{{ Aire::dateTimeLocal('meeting', 'Meeting Time') }}
{{ Aire::time('start_time', 'Start Time') }}
{{ Aire::month('month', 'Month') }}
{{ Aire::week('week', 'Week') }}
```

### Special Inputs
```php
{{ Aire::color('theme_color', 'Theme Color') }}
{{ Aire::file('document', 'Upload Document') }}
{{ Aire::hidden('user_id', $user->id) }}
```

### Textarea
```php
{{ Aire::textArea('bio', 'Biography') }}
{{ Aire::textArea('bio', 'Biography')->autoSize() }}  // Auto-expand with content
```

### Select Dropdown
```php
// Simple array
{{ Aire::select(['draft' => 'Draft', 'published' => 'Published'], 'status', 'Status') }}

// With optgroups (nested arrays)
{{ Aire::select([
    'Fruits' => ['apple' => 'Apple', 'banana' => 'Banana'],
    'Vegetables' => ['carrot' => 'Carrot', 'lettuce' => 'Lettuce'],
], 'food', 'Select Food') }}

// Eloquent collection (uses id as value, name as label by default)
{{ Aire::select($categories, 'category_id', 'Category') }}

// PHP Enum
{{ Aire::select(StatusEnum::cases(), 'status', 'Status') }}

// Empty/placeholder option
{{ Aire::select($options, 'country', 'Country')->prependEmptyOption('Select a country...') }}

// Timezone select (pre-populated)
{{ Aire::timezoneSelect('timezone', 'Timezone') }}
```

### Checkboxes and Radio Buttons
```php
// Single checkbox
{{ Aire::checkbox('terms', 'I agree to the terms') }}

// Checkbox group (multiple selection)
{{ Aire::checkboxGroup(['admin' => 'Admin', 'editor' => 'Editor'], 'roles', 'Roles') }}

// Radio group (single selection)
{{ Aire::radioGroup(['male' => 'Male', 'female' => 'Female'], 'gender', 'Gender') }}
```

### Buttons
```php
{{ Aire::button('Click Me') }}
{{ Aire::submit('Save Changes') }}
{{ Aire::submit() }}  // Defaults to "Submit"
```

## Element Configuration Methods

### Common Attributes
```php
{{ Aire::input('name')
    ->id('custom-id')
    ->placeholder('Enter your name')
    ->required()
    ->disabled()
    ->readOnly()
    ->autoFocus()
    ->autoComplete('name')
    ->value('Default Value')
    ->defaultValue('Fallback Value') }}
```

### Labels and Help Text
```php
{{ Aire::input('email', 'Email Address')
    ->helpText('We will never share your email.') }}

// Or set label separately
{{ Aire::input('email')->label('Email Address') }}
```

### CSS Classes
```php
{{ Aire::input('name')
    ->addClass('custom-class')
    ->removeClass('default-class') }}
```

### Data Attributes
```php
{{ Aire::input('search')
    ->data('controller', 'search')
    ->data('action', 'input->search#query') }}
// Renders: data-controller="search" data-action="input->search#query"
```

### Custom Attributes
```php
{{ Aire::input('name')->setAttribute('x-model', 'formData.name') }}
```

### Conditional Methods
```php
{{ Aire::input('name')
    ->when($condition, fn($el) => $el->required())
    ->unless($isAdmin, fn($el) => $el->disabled()) }}
```

## Grouping

By default, Aire wraps inputs in groups containing label, input, help text, and error message.

### Disable Grouping
```php
{{ Aire::input('name')->withoutGroup() }}
```

### Group Configuration
```php
{{ Aire::input('name')
    ->groupClass('custom-group-class')
    ->groupId('name-group')
    ->groupData('section', 'personal') }}
```

## Validation

### Server-Side Validation (Automatic)

Aire automatically:
- Detects validation errors from session
- Applies error CSS classes to invalid elements
- Displays error messages within groups

### Error Summary
```php
// Shows: "There are X errors on this page..."
{{ Aire::summary() }}

// Shows itemized list of all errors
{{ Aire::summary()->verbose() }}
```

### Custom Error Bag
```php
{{ Aire::open()->errorBag('custom_bag') }}
```

### Client-Side Validation

```php
// Using validation rules array
{{ Aire::open()
    ->route('users.store')
    ->validate([
        'email' => 'required|email',
        'name' => 'required|min:3|max:255',
        'age' => 'required|integer|min:18',
    ]) }}

// Using FormRequest class
{{ Aire::open()
    ->route('users.store')
    ->validate(StoreUserRequest::class) }}

// With custom messages
{{ Aire::open()
    ->route('users.store')
    ->validate([
        'email' => 'required|email',
    ], [
        'email.required' => 'Please provide your email address.',
        'email.email' => 'Please enter a valid email format.',
    ]) }}

// Disable validation for specific form
{{ Aire::open()->withoutValidation() }}
```

**Supported Validation Rules (Client-Side):**
`required`, `email`, `url`, `min`, `max`, `between`, `size`, `in`, `not_in`, `integer`, `numeric`, `string`, `alpha`, `alpha_num`, `alpha_dash`, `regex`, `confirmed`, `same`, `different`, `date`, `before`, `after`, `boolean`, `accepted`

## Variants (Styling)

Aire supports variants for element styling:

```php
// Single variant
{{ Aire::input('name')->variant('sm') }}
{{ Aire::input('name')->variant('lg') }}

// Multiple variants
{{ Aire::button('Submit')->variants('lg', 'red') }}

// Fluent variant syntax
{{ Aire::button('Submit')->variant()->lg()->red() }}
```

**Built-in Button Variants:**
- Sizes: `xs`, `sm`, `lg`, `xl`
- Colors: `blue`, `red`, `green`, `orange`, `gray`
- Bootstrap-style: `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`
- Display: `block`

## Customization

### Publishing Configuration
```bash
php artisan vendor:publish --tag=aire-config
```

### Configuration Options (config/aire.php)
```php
return [
    // Wrap elements in groups by default
    'group_by_default' => true,

    // Auto-generate IDs for elements
    'auto_id' => true,

    // Show verbose error summaries by default
    'verbose_summaries_by_default' => false,

    // Enable client-side validation by default
    'validate_by_default' => true,

    // Inline validation JS vs external file
    'inline_validation' => true,

    // Path to validation JS file
    'validation_script_path' => '/vendor/aire/js/aire.js',

    // Default HTML attributes per element
    'default_attributes' => [
        'form' => ['method' => 'POST'],
    ],

    // Default CSS classes per element
    'default_classes' => [
        'input' => 'block w-full border rounded-sm p-2',
        'label' => 'block mb-2 font-semibold',
        'group' => 'mb-6',
        'button' => 'px-4 py-2 rounded',
        // ... etc
    ],

    // Variant class definitions
    'variant_classes' => [
        'input' => [
            'sm' => 'p-1 text-sm',
            'lg' => 'p-3 text-lg',
        ],
        'button' => [
            'primary' => 'bg-blue-600 text-white',
            'danger' => 'bg-red-600 text-white',
        ],
    ],

    // Classes applied based on validation state
    'validation_classes' => [
        'none' => [
            'input' => 'border-gray-300',
        ],
        'valid' => [
            'input' => 'border-green-500',
            'label' => 'text-green-600',
        ],
        'invalid' => [
            'input' => 'border-red-500',
            'label' => 'text-red-600',
        ],
    ],
];
```

### Publishing Views
```bash
php artisan vendor:publish --tag=aire-views
```

Creates customizable templates in `resources/views/vendor/aire/`:
- `form.blade.php`
- `input.blade.php`
- `select.blade.php`
- `textarea.blade.php`
- `checkbox.blade.php`
- `checkbox-group.blade.php`
- `radio-group.blade.php`
- `button.blade.php`
- `group.blade.php`
- `summary.blade.php`
- etc.

### Runtime Theme Switching
```php
// Set custom theme
Aire::setTheme(
    'custom-namespace',    // View namespace
    'admin',               // View prefix
    [                      // Theme config
        'default_classes' => [...],
        'variant_classes' => [...],
    ]
);

// Reset to default theme
Aire::resetTheme();
```

## Alpine.js Integration

```php
{{ Aire::open()
    ->route('users.store')
    ->asAlpineComponent(['count' => 0, 'name' => ''])
}}

<div x-data>
    <span x-text="count"></span>
    {{ Aire::input('name')->setAttribute('x-model', 'name') }}
    {{ Aire::button('Increment')->setAttribute('@click', 'count++') }}
</div>

{{ Aire::close() }}
```

## Translations

```bash
php artisan vendor:publish --tag=aire-translations
```

Supported languages: English, German, Dutch, Arabic

## Complete Form Example

```php
{{ Aire::open()
    ->route('users.store')
    ->validate([
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:admin,editor,viewer',
        'bio' => 'nullable|max:500',
        'terms' => 'accepted',
    ]) }}

    {{ Aire::summary() }}

    {{ Aire::input('name', 'Full Name')
        ->placeholder('John Doe')
        ->required() }}

    {{ Aire::email('email', 'Email Address')
        ->placeholder('john@example.com')
        ->helpText('We will send a confirmation email.') }}

    {{ Aire::password('password', 'Password') }}
    {{ Aire::password('password_confirmation', 'Confirm Password') }}

    {{ Aire::select([
        'admin' => 'Administrator',
        'editor' => 'Editor',
        'viewer' => 'Viewer',
    ], 'role', 'Role')->prependEmptyOption('Select a role...') }}

    {{ Aire::textArea('bio', 'Biography')
        ->helpText('Tell us about yourself (optional)')
        ->autoSize() }}

    {{ Aire::checkbox('terms', 'I agree to the terms and conditions') }}

    {{ Aire::submit('Create Account')->variant()->primary() }}

{{ Aire::close() }}
```

## Blade Component Equivalent

```html
<x-aire::form
    route="users.store"
    :validate="[
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:admin,editor,viewer',
        'bio' => 'nullable|max:500',
        'terms' => 'accepted',
    ]"
>
    <x-aire::summary />

    <x-aire::input
        name="name"
        label="Full Name"
        placeholder="John Doe"
        required
    />

    <x-aire::email
        name="email"
        label="Email Address"
        placeholder="john@example.com"
        help-text="We will send a confirmation email."
    />

    <x-aire::password name="password" label="Password" />
    <x-aire::password name="password_confirmation" label="Confirm Password" />

    <x-aire::select
        :options="['admin' => 'Administrator', 'editor' => 'Editor', 'viewer' => 'Viewer']"
        name="role"
        label="Role"
        prepend-empty-option="Select a role..."
    />

    <x-aire::textarea
        name="bio"
        label="Biography"
        help-text="Tell us about yourself (optional)"
        auto-size
    />

    <x-aire::checkbox name="terms" label="I agree to the terms and conditions" />

    <x-aire::submit label="Create Account" variant="primary" />

</x-aire::form>
```

## Key Features Summary

- **Automatic CSRF**: Token injected automatically for non-GET forms
- **Method Spoofing**: `_method` field added automatically for PUT/PATCH/DELETE
- **Old Input Preservation**: Form values retained after validation errors
- **Server Validation Errors**: Automatically displayed with error styling
- **Client Validation**: Optional JavaScript validation using ValidatorJS
- **Data Binding**: Bind Eloquent models, arrays, or objects
- **Tailwind CSS**: Pre-configured with Tailwind classes
- **Accessibility**: Auto-generated IDs link labels to inputs
- **Grouping**: Labels, inputs, help text, and errors wrapped together
- **Variants**: Easy style variations for buttons and inputs
- **Blade Components**: Modern component syntax (Laravel 8+)
