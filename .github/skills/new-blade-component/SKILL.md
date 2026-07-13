---
name: new-blade-component
description: 'Scaffold a new Blade component for this Sage WordPress theme. Use when adding a reusable UI component, creating a new component file, building a Blade component with props, or wiring up a View Composer to pass PHP data to a component.'
argument-hint: 'component name (e.g. "card", "hero", "post-meta")'
---

# New Blade Component

Scaffolds a Blade component and, when PHP data is needed, a matching View Composer.

## When to Use

- Adding a reusable UI element (card, button group, alert, hero, etc.)
- Exposing PHP/WordPress data to a component via a composer
- Building a component that other Blade templates can use with `<x-component-name />`

## Step-by-Step Procedure

### 1. Determine the component name

- Use kebab-case for the filename: `post-card.blade.php`
- The Blade tag will be `<x-post-card />` automatically

### 2. Create the component file

Create `resources/views/components/{name}.blade.php`.

Use the [component template](./assets/component.blade.php) as a starting point:

- Declare all props with `@props([...])`. Give defaults where sensible.
- Add Tailwind classes for styling.
- Use `$attributes->merge(['class' => '...'])` to allow callers to extend classes.
- Use `$slot` for the default slot or named slots (`@slot`/`{{ $slotName }}`).
- Use `@php(...)` for inline expressions — never raw `<?php ... ?>`.

### 3. Decide: does this component need PHP data?

**No PHP data needed** (pure markup/props) → Stop here. Done.

**Yes, needs WordPress/PHP data** → Continue to step 4.

### 4. Create a View Composer

Create `app/View/Composers/{PascalName}.php`.

Use the [composer template](./assets/Composer.php) as a starting point:

- Namespace: `App\View\Composers`
- Extend: `Roots\Acorn\View\Composer`
- Set `protected static $views` to `['components.{name}']` (dot notation, not slashes)
- Each `public function foo(): type` automatically becomes `$foo` in the view

> **Auto-discovery**: Acorn's `SageServiceProvider` (inherited by `ThemeServiceProvider`) automatically discovers all classes in `app/View/Composers/`. No manual registration required.

### 5. Reference the composer data in the component

Use `$variableName` directly in the Blade template — it is injected by the composer.

### 6. Build assets

Run `npm run build` (or keep `npm run dev` running for HMR) to pick up any Tailwind class changes.

### 7. Use the component

```blade
<x-post-card :post="$post" class="mt-4" />
```

## Key Conventions

| Rule           | Detail                                                                                      |
| -------------- | ------------------------------------------------------------------------------------------- |
| Props          | Declared via `@props([])` at top of file                                                    |
| Inline PHP     | Always `@php(expression)` not `<?php ?>`                                                    |
| Tailwind       | No `tailwind.config.js` — add utility classes freely; Vite scans `resources/**/*.blade.php` |
| Composer views | Dot-notation: `components.my-card` for `resources/views/components/my-card.blade.php`       |
| Class naming   | PascalCase composer matching component name: `PostCard.php` for `post-card.blade.php`       |
