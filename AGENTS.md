# AGENTS.md

Guidance for AI coding agents working on this [Sage](https://roots.io/sage/) WordPress starter theme (Sage 11, Acorn 6, Blade, Vite 8, Tailwind 4).

## Project at a glance

- **Type:** WordPress theme (`composer.json` → `"type": "wordpress-theme"`).
- **Stack:** PHP ≥ 8.3, Laravel Blade via [Acorn](https://roots.io/acorn/), Vite 8 + Tailwind v4, Node ≥ 20.19.
- **PSR-4:** `App\` → [app/](app/). New PHP classes go under [app/](app/) with namespace `App\…`.
- **Templates:** Blade files live in [resources/views/](resources/views/). Do **not** add classic WP `*.php` templates at theme root — Sage routes everything through Blade via Acorn.
- **Front-end source:** [resources/css/](resources/css/), [resources/js/](resources/js/), [resources/images/](resources/images/), [resources/fonts/](resources/fonts/). Built artifacts go to `public/build/` (gitignored output of Vite).

## Build, dev, lint

Run from the theme root:

| Task             | Command                                                                           |
| ---------------- | --------------------------------------------------------------------------------- |
| Install PHP deps | `composer install`                                                                |
| Install JS deps  | `npm install`                                                                     |
| Dev server (HMR) | `npm run dev`                                                                     |
| Production build | `npm run build` (writes [public/build/manifest.json](public/build/manifest.json)) |
| PHP lint/format  | `vendor/bin/pint` (Laravel Pint, configured by package defaults)                  |
| i18n POT/PO/MO   | `npm run translate*` (requires WP-CLI on PATH)                                    |

There is no PHP test suite in this theme. Don't add one unless asked.

## Architecture conventions

- **Bootstrapping** — [functions.php](functions.php) requires Composer's autoloader and boots Acorn; [app/setup.php](app/setup.php) and [app/filters.php](app/filters.php) register WordPress hooks. Add new theme-setup hooks in those files (or a new file in [app/](app/) included from [functions.php](functions.php)), not in [index.php](index.php).
- **Service providers** — Register Acorn services in [app/Providers/ThemeServiceProvider.php](app/Providers/ThemeServiceProvider.php).
- **View composers** — Add classes under [app/View/Composers/](app/View/Composers/) extending `Roots\Acorn\View\Composer`. The `$views` array is glob-style (`'*'` = every view). See [app/View/Composers/App.php](app/View/Composers/App.php) for the canonical pattern.
- **Blade structure**:
  - `layouts/` — page shells (`@extends('layouts.app')`)
  - `sections/` — header/footer/sidebar partials included by layouts
  - `partials/` — reusable fragments (entry meta, page header, etc.)
  - `components/` — Blade components invoked as `<x-alert>`
  - `forms/` — comments form etc.
  - Top-level templates (`index.blade.php`, `single.blade.php`, `page.blade.php`, `404.blade.php`, `search.blade.php`) map to the WP template hierarchy.
- **Assets in Blade/PHP** — Use the `Vite` facade: `Vite::asset('resources/css/editor.css')`, `Vite::withEntryPoints([...])->toHtml()`. Do **not** hand-roll `wp_enqueue_*` for theme JS/CSS — let `@vite` / the Vite facade handle hashed URLs and HMR.
- **Path aliases (JS/CSS imports):** `@scripts`, `@styles`, `@fonts`, `@images` → see [vite.config.js](vite.config.js).
- **Tailwind v4** uses CSS-first config: see `@import "tailwindcss"` and `@source` directives in [resources/css/app.css](resources/css/app.css). There is no `tailwind.config.js`; add new content sources via `@source` in CSS.
- **theme.json** — The committed [theme.json](theme.json) is the source; `wordpressThemeJson()` in [vite.config.js](vite.config.js) generates the served `public/build/assets/theme.json` from Tailwind tokens. A filter in [app/setup.php](app/setup.php) redirects WP to the built file. Edit tokens via Tailwind/CSS or [theme.json](theme.json), not the build output.

## Pitfalls

- **`base` URL in Vite** — [vite.config.js](vite.config.js) hard-codes `base: '/app/themes/sage/public/build/'`, which assumes a [Bedrock](https://roots.io/bedrock/) layout. If this theme is deployed to a vanilla `wp-content/themes/<slug>/` site, asset URLs will 404. Update `base` to match the deployed theme path before shipping a non-Bedrock build.
- **APP_URL** — Vite falls back to `http://example.test`. Set `APP_URL` in the environment for HMR to point at the right dev host.
- **Block editor scripts** — Editor JS is enqueued from [app/setup.php](app/setup.php) by reading `editor.deps.json` from the build manifest. A fresh checkout must be built (`npm run build`) before the block editor will load editor assets in non-HMR mode.
- **Production deps** — The deploy workflow installs Composer production dependencies in CI and uploads `vendor/`.
- **PHP version floor** — `composer.json` requires PHP 8.3. Use 8.3+ syntax freely (readonly props, typed constants, etc.); don't downgrade for older PHP.

## Forms (Contact Form 7)

- **No vanilla Blade/PHP forms.** Every form in this theme uses Contact Form 7 (CF7).
- Output: `resources/views/forms/{name}.blade.php` — one file per form.
- Each Blade file has three sections: (1) CF7 form template in a `{{-- [CF7 Form Template] --}}` Blade comment, (2) CF7 mail template in a `{{-- [CF7 Mail Template] --}}` Blade comment, (3) rendering via `{!! do_shortcode('[contact-form-7 id="ID" title="Title"]') !!}`.
- **No-whitespace rule for form templates:** wrap every CF7 tag in an explicit block element on a single line; no blank lines between fields; `[submit]` always inside `<div class="cf7-submit-wrap">`.
- **Spinner CSS** (in `resources/css/app.css`): `.cf7-submit-wrap { position: relative; display: inline-block; }` and `.cf7-submit-wrap .wpcf7-spinner { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0; pointer-events: none; }`.
- See `.github/skills/cf7-form/SKILL.md` for the full step-by-step procedure and canonical Blade file template.

## Conventions for changes

> **IMPORTANT — Tailwind-first styling**: Always use Tailwind utility classes for styling instead of writing vanilla CSS. Only add custom CSS rules in `resources/css/app.css` when a design requirement cannot be expressed with existing Tailwind utilities (e.g. complex `@keyframes`, third-party widget overrides). Never write inline `style` attributes.

- Match existing Pint/Laravel style: 4-space indent, short array syntax, single quotes, trailing commas in multi-line arrays, PHPDoc blocks on hook callbacks describing return type and intent (mirror [app/setup.php](app/setup.php)).
- When writing or editing Tailwind classes, always use Tailwind's suggested canonical utility classes and canonical class ordering.
- Translatable strings use the `'sage'` text domain: `__('Primary', 'sage')`.
- Prefer Blade components / `@include` over raw `get_template_part`.
- When adding a view that needs server-side data, create a matching View Composer rather than computing values inline in the template.
- **Asset URLs — never hardcode the domain**: Never write a literal domain name (e.g. `domain.com/wp-content/uploads/…`) in any `src`, `href`, `poster`, or URL attribute. Use the appropriate dynamic helper:
  - **Uploaded media** (images, videos, PDFs): `wp_get_attachment_url($id)`, `get_the_post_thumbnail_url()`, ACF's `get_field()`, or pass through a View Composer.
  - **Theme-bundled assets**: `Vite::asset('resources/images/foo.jpg')`.
  - **Arbitrary site URLs**: `home_url('/path')` or `site_url('/path')`.
  - In Blade, output with `{{ $url }}` or `{!! $url !!}` (only when already trusted/escaped).

## Reference docs

- Sage docs: https://roots.io/sage/docs/
- Acorn docs: https://roots.io/acorn/docs/
- Local: [README.md](README.md)
