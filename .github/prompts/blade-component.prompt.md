---
agent: agent
description: Scaffold a new Blade component in resources/views/components/
---

Create a new Blade component for this Sage 11 theme.

## Instructions

1. Create `resources/views/components/${input:name}.blade.php` using this pattern (based on `components/alert.blade.php`):

```blade
@props([
  'propName' => null,
  // add more props as needed
])

<div {{ $attributes->merge(['class' => '']) }}>
  {!! $slot !!}
</div>
```

**Rules:**

- Use `@props([])` at the top to declare all props with defaults
- Use `@php($var = ...)` for inline PHP logic (e.g. `match` expressions for conditional classes)
- Use `$attributes->merge(['class' => '...'])` so callers can pass extra HTML attributes
- Use `{!! $slot !!}` for unescaped HTML slot content, or `{{ $slot }}` for escaped text
- Use Tailwind utility classes for all styling — no custom CSS
- Use `{{ $propName ?? $slot }}` when a prop and slot are interchangeable (see `alert.blade.php`)

2. Use the component in Blade templates as:

```blade
<x-${input:name} propName="value">Slot content</x-${input:name}>
```

No PHP class is needed for simple components — Blade resolves them automatically from the file path.
