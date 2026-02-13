## Aire Form Builder

This project uses **Aire** (`glhd/aire`) for all HTML form rendering. Aire is a Laravel form builder that provides a fluent PHP API and Blade components for building forms with automatic CSRF protection, data binding, validation, and Tailwind CSS styling.

### Key Conventions

- **Always use Aire** for building forms. Never write raw `<form>` or `<input>` HTML tags manually.
- Use the `Aire` facade or `<x-aire::*>` Blade components — never instantiate element classes directly.
- Aire automatically handles CSRF tokens, method spoofing (`PUT`/`PATCH`/`DELETE`), old input repopulation, and validation error display.
- Elements are automatically grouped with their label and error messages by default.
- The default theme uses Tailwind CSS classes.

### When to Activate the Skill

Whenever you are working on anything related to forms — creating, editing, debugging, styling, or validating forms — activate the `aire-development` skill for detailed API reference and usage patterns.
