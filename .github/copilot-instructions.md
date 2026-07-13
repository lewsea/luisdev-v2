# Sage WordPress Theme — Agent Instructions

This is a **Sage 11** WordPress starter theme using Laravel Blade templating (via Acorn), Tailwind CSS v4, and Vite.

## Key Commands

| Task               | Command             |
| ------------------ | ------------------- |
| Dev server (HMR)   | `npm run dev`       |
| Production build   | `npm run build`     |
| PHP code style     | `vendor/bin/pint`   |
| Generate .pot file | `npm run translate` |

> Always run `npm run build` after editing CSS/JS. Run `composer install` if vendor is missing.

## Architecture

- **`app/`** — PHP application code (PSR-4, namespace `App\`)
  - `setup.php` — theme hooks, Vite asset enqueue, block editor config
  - `filters.php` — WordPress filters
  - `Providers/ThemeServiceProvider.php` — Acorn service provider (extend here, not in functions.php)
  - `View/Composers/` — Blade view composers (pass data to templates)
- **`resources/views/`** — Blade templates
  - `layouts/app.blade.php` — root HTML layout; use `@yield('content')` in child views
  - `sections/` — header, footer, sidebar
  - `partials/` — reusable content fragments
  - `components/` — Blade components (`<x-component-name />`)
- **`resources/css/app.css`** — Tailwind CSS v4 entry (uses `@import "tailwindcss"`)
- **`resources/js/app.js`** — JS entry point
- **`public/build/`** — compiled assets (never edit manually; git-ignored)
- **`theme.json`** — source theme.json; built artifact goes to `public/build/assets/theme.json`

## Conventions

> **IMPORTANT — Tailwind-first styling**: Always use Tailwind utility classes for styling instead of writing vanilla CSS. Only add custom CSS rules in `app.css` when a design requirement cannot be expressed with existing Tailwind utilities (e.g. complex `@keyframes`, third-party widget overrides). Never write inline `style` attributes.

- **Blade templates**: All view files live in `resources/views/` and use the `.blade.php` extension. WordPress template hierarchy maps to Blade files (e.g., `single.blade.php`, `page.blade.php`).
- **Vite aliases**: Use `@scripts`, `@styles`, `@fonts`, `@images` to reference assets from JS/CSS.
- **View Composers**: To pass PHP data to a Blade view, add a composer in `app/View/Composers/` and register it in `ThemeServiceProvider`.
- **Tailwind CSS v4**: Configured via `@import "tailwindcss"` in `app.css`. Sources are scanned from `app/**/*.php` and `resources/**/*.blade.php`. No `tailwind.config.js` — use CSS-native config.
- **Tailwind canonical classes**: Always use Tailwind's suggested canonical utility classes and canonical class ordering when writing or editing class attributes.
- **theme.json**: Tailwind colors/fonts/sizes are auto-merged into the block editor palette via `wordpressThemeJson()` Vite plugin. Edit `theme.json` at the root, not the build output.
- **PHP namespace**: All custom classes go under `App\` (maps to `app/` directory).
- **WordPress hooks**: Add actions/filters directly in `setup.php` or `filters.php` using anonymous functions. For complex logic, use a dedicated class and register in `ThemeServiceProvider`.
- **Asset URLs — never hardcode the domain**: Never write a literal domain name (e.g. `domain.com/wp-content/uploads/…`) in any `src`, `href`, `poster`, or URL attribute. Use the appropriate dynamic helper instead:
  - **Uploaded media** (images, videos, PDFs): retrieve via `wp_get_attachment_url($id)`, `get_the_post_thumbnail_url()`, ACF's `get_field()`, or pass the URL through a View Composer — never construct the path manually.
  - **Theme-bundled assets** (images/fonts shipped with the theme): use `Vite::asset('resources/images/foo.jpg')` so Vite handles cache-busting.
  - **Arbitrary site URLs**: use `home_url('/path')` or `site_url('/path')` — never concatenate a hardcoded domain.
  - In Blade, output any dynamic URL with `{{ $url }}` or `{!! $url !!}` (the latter only when the value is already escaped/trusted).

## Forms

- **Never use vanilla `<form>` tags.** All forms must use Contact Form 7 (CF7).
- Form views live in `resources/views/forms/{name}.blade.php` — one file per form.
- Each file documents the CF7 form template and mail template in Blade comment blocks, then renders via `{!! do_shortcode('[contact-form-7 id="ID" title="Title"]') !!}`.
- CF7 form templates must have no whitespace/blank lines between fields — wrap every tag in an explicit `<div>` on a single line.
- The `[submit]` tag must be wrapped in `<div class="cf7-submit-wrap">` and `.wpcf7-spinner` must be absolutely positioned (top/left 50%, transform -50%/-50%) within it via CSS in `app.css`.
- Use the `cf7-form` skill for full step-by-step guidance.

## Important Notes

- Acorn boots the Laravel container inside WordPress; you can use Laravel facades (e.g., `Vite::asset()`, `Illuminate\Support\Facades\*`).
- Block templates (FSE) are **disabled** (`remove_theme_support('block-templates')` in `setup.php`).
- The `public/hot` file signals that Vite dev server is running; delete it if the dev server isn't running and assets appear broken.
- PHP ≥ 8.3 required. Node ≥ 20.19 required.
- See [Sage docs](https://roots.io/sage/docs/) for full reference.
