# Sage Theme — AI Agent Instructions

This is a **Sage 11** WordPress starter theme using Roots Acorn, Laravel Blade, Tailwind CSS 4, and Vite.

## Quick Reference

| Concern       | Details                                           |
| ------------- | ------------------------------------------------- |
| PHP namespace | `App\` → `app/` (PSR-4)                           |
| Text domain   | `sage`                                            |
| PHP minimum   | 8.3                                               |
| Node minimum  | 20.19                                             |
| Docs          | [roots.io/sage/docs](https://roots.io/sage/docs/) |

## Build Commands

```bash
npm run dev      # Vite dev server with HMR
npm run build    # Production build
```

PHP linting (dev dependency):

```bash
vendor/bin/pint  # Laravel Pint (PSR-12 formatter)
```

Translation workflow: `npm run translate` (pot → update → compile).

## Architecture

### PHP (app/)

| File/Dir                                 | Purpose                                        |
| ---------------------------------------- | ---------------------------------------------- |
| `functions.php`                          | Entry point — boots Acorn, registers providers |
| `app/setup.php`                          | Theme setup, block editor CSS/JS injection     |
| `app/filters.php`                        | WordPress filters                              |
| `app/Providers/ThemeServiceProvider.php` | Extend here for custom service providers       |

Uses Laravel service container via Roots Acorn. Add custom providers by extending `ThemeServiceProvider`.

### Views (resources/views/)

Laravel Blade templates. Hierarchy:

```
layouts/app.blade.php        ← root layout (@yield content/sidebar)
  sections/header.blade.php  ← @include'd sections
  sections/footer.blade.php
  sections/sidebar.blade.php
partials/                    ← content partials (content.blade.php, entry-meta, etc.)
components/                  ← reusable Blade components
```

WordPress template files map to Blade views (e.g. `single.blade.php`, `page.blade.php`).

### CSS (resources/css/)

Tailwind CSS 4 with static theme mode. Content is scanned from:

- `../../app/**/*.php`
- `../\*\*/\*.blade.php`
- `../\*\*/\*.js`

Use Tailwind utility classes directly. Do **not** add custom CSS when a Tailwind utility exists.

### JavaScript (resources/js/)

- `app.js` — front-end entry (empty by default, add custom JS here)
- `editor.js` — block editor entry

Path aliases in Vite:

- `@scripts` → `resources/js`
- `@styles` → `resources/css`
- `@fonts` → `resources/fonts`
- `@images` → `resources/images`

### Assets

Place images in `resources/images/` and fonts in `resources/fonts/`. Reference in Blade via `@asset('resources/images/...')` or via `@vite`.

## Important Conventions

- **`public/build/assets/theme.json` is generated** by the Vite build from Tailwind config — do not edit `theme.json` manually for color/typography settings; configure Tailwind instead.
- **WordPress i18n**: wrap all user-facing strings with `__('text', 'sage')` or `@lang('text')` in Blade.
- **`@php()` directive**: use `@php(expression)` (single-expression form) for WordPress function calls in Blade — not `<?php ?>` blocks.
- **Blade components** live in `resources/views/components/` and are auto-discovered by Acorn.
- **View Composers** belong in `app/View/Composers/` — register in `ThemeServiceProvider`.
