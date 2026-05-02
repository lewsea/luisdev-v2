---
name: sage-bento-page
description: 'Build modern, minimal bento-grid pages (portfolio, landing, profile) in this Sage 11 WordPress theme. Use when the user asks for a bento layout, grid of cards, portfolio/profile/landing page, or wants to add embeds (YouTube, Spotify, Figma), a floating CTA pill, dark-mode toggle, or extend the cream + neon design system.'
---

# Sage Bento Page

Build responsive bento-grid Blade pages that match this theme's design language: cream paper backgrounds (`#faf7eb`), neon-green accents, Google Sans, dark-mode toggle, and rounded-2xl cards.

## When to Use

- New page that should be a bento grid (front page, about, project showcase)
- Adding/removing/reordering cards on the existing front page
- Embedding media (YouTube, Spotify, Figma, X/Twitter, Bandcamp)
- Adding a floating CTA pill (sunday.ai style)
- Extending the cream/neon design tokens

## Design Tokens (already wired)

Defined in [resources/css/app.css](../../../resources/css/app.css) under `@theme`:

| Token                          | Value       | Purpose                                                                                    |
| ------------------------------ | ----------- | ------------------------------------------------------------------------------------------ |
| `--font-sans`                  | Google Sans | Loaded via `<link>` in [bento.blade.php](../../../resources/views/layouts/bento.blade.php) |
| `--color-cream-50`             | `#fdfbf3`   | Card background (light)                                                                    |
| `--color-cream-100`            | `#faf7eb`   | Page background (light)                                                                    |
| `--color-cream-200`            | `#f3eedb`   | Hover / muted surface                                                                      |
| `--color-cream-300`            | `#e8e1c4`   | Borders                                                                                    |
| `--color-neon-300/400/500/600` | green ramp  | CTAs, hover states, glow                                                                   |

Dark mode uses `dark:bg-neutral-900` / `dark:bg-neutral-950` and inverts neon usage.

## Card Anatomy

Every card follows this shell:

```blade
<section class="col-span-1 sm:col-span-2 lg:col-span-2  {{-- responsive sizing --}}
                rounded-2xl border border-cream-300/60 bg-cream-50 p-6 shadow-sm
                transition hover:shadow-md
                dark:border-neutral-800 dark:bg-neutral-900">
  {{-- content --}}
</section>
```

**Inverted (dark) card** — for emphasis (quotes, CTAs):

```
border-neutral-900 bg-neutral-900 text-neutral-50
dark:border-neon-400 dark:bg-neon-400 dark:text-neutral-900
```

## Procedure

### 1. Choose the grid

Outer wrapper:

```blade
<div class="grid auto-rows-[minmax(180px,auto)] grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
```

Plan card spans on the **lg** breakpoint (4-col base) — pick a mix:

| Visual role                   | Suggested span                |
| ----------------------------- | ----------------------------- |
| Hero / profile                | `lg:col-span-2 row-span-2`    |
| Quote / statement             | `lg:col-span-2`               |
| Embed (YouTube/Spotify)       | `lg:col-span-2`               |
| Wide hero embed (Figma/video) | `lg:col-span-4`               |
| Tall feature                  | `lg:col-span-2 lg:row-span-2` |

Always include `col-span-1` (mobile) and `sm:col-span-2` (tablet).

### 2. Pick card patterns

Use the snippets in [./references/card-patterns.md](./references/card-patterns.md):

- Profile / intro card (avatar + name + status dot)
- Tag pill cluster (tech stack, tools)
- Inverted quote card
- Glow-accent CTA card (Get in Touch pattern)
- Embed card (YouTube / Spotify / Figma)
- Project showcase card (header + iframe)

### 3. Embed media

| Platform | Pattern                                                                       | Wrapper                       |
| -------- | ----------------------------------------------------------------------------- | ----------------------------- |
| YouTube  | `https://www.youtube.com/embed/{ID}`                                          | `<div class="aspect-video">`  |
| Spotify  | `https://open.spotify.com/embed/playlist/{ID}`                                | fixed `height="352"`          |
| Figma    | `https://embed.figma.com/design/{KEY}/{NAME}?node-id={NODE}&embed-host=share` | `<div class="aspect-[16/9]">` |

Always add `loading="lazy"` and put the `<iframe>` inside an `overflow-hidden rounded-2xl` parent.

### 4. Floating CTA pill (optional)

Place **outside** the `max-w-7xl` container, as a sibling of the grid wrapper, so it stays centered on viewport:

```blade
<div class="fixed bottom-0 z-10 flex w-full justify-center px-6 pb-4 md:pb-6">
  <a href="..." class="flex w-95 lg:w-100 max-w-full items-center justify-between gap-1
                       rounded-full bg-neon-400 px-5 py-4 text-sm font-medium leading-4
                       text-neutral-900 shadow-lg shadow-neon-500/20 backdrop-blur-xl
                       transition hover:bg-neon-300">
    <p>{{ __('Primary message', 'sage') }}</p>
    <p class="text-right">
      <span class="pr-1.5 text-neutral-700">{{ __('Secondary CTA', 'sage') }}</span>
      <span class="inline-block h-2 w-2 animate-[blinking_0.75s_ease-in-out_infinite]
                   rounded-full bg-neutral-900 max-sm:hidden"></span>
    </p>
  </a>
</div>
```

Add `<div class="h-24"></div>` at the end of the grid container to prevent the pill from covering content.

### 5. Use the bento layout

New pages should `@extends('layouts.bento')` — **not** `layouts.app` — so they get the minimal chrome (no WP header/footer, theme toggle pre-paint script, Google Sans preconnect, `bg-cream-100` body).

```blade
@extends('layouts.bento')

@section('content')
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
    {{-- top bar with theme toggle (copy from front-page.blade.php) --}}
    {{-- bento grid --}}
  </div>
@endsection
```

### 6. Validate

```bash
npm run build      # Tailwind must pick up any new utility classes
```

Visual checklist:

- [ ] Mobile: cards stack to 1 column
- [ ] All cards use `rounded-2xl` (not `3xl`, not `xl`)
- [ ] Light mode shows cream backgrounds, never plain `#fff`
- [ ] Dark mode toggle persists (test reload)
- [ ] Every iframe has `loading="lazy"`
- [ ] User-facing strings wrapped in `__('...', 'sage')`
- [ ] Floating pill has bottom spacer to avoid content overlap

## Conventions

- **Border radius**: cards `rounded-2xl`, pills `rounded-full`, inner buttons `rounded-xl`, chips `rounded-lg`
- **Spacing**: `p-6` for card padding, `gap-4` between cards, `mt-6` between blocks inside a card
- **Typography**: `text-sm font-semibold uppercase tracking-wider text-neutral-500` for card section headers
- **Animation**: reuse `animate-[blinking_0.75s_ease-in-out_infinite]` (defined in [app.css](../../../resources/css/app.css)) for status dots
- **i18n**: never hard-code English; use `__('text', 'sage')` or `@lang('text')`
- **Blade**: prefer `@php(expression)` over `<?php ?>`

## Anti-patterns

- ❌ Plain white card backgrounds (`bg-white`) — breaks the cream design language
- ❌ `rounded-3xl` — too soft for this theme; use `rounded-2xl`
- ❌ Hard-coded hex colors in markup — extend `@theme` tokens in [app.css](../../../resources/css/app.css) instead
- ❌ Adding card content directly into `layouts/app.blade.php` — front-page-style content belongs in a Blade view extending `layouts.bento`
- ❌ Using `@apply` for card shells — keep utilities inline so the design is greppable
- ❌ Embedding iframes without `loading="lazy"` and an `aspect-*` parent — causes layout shift
