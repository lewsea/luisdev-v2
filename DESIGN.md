# DESIGN.md — luisdev Theme Design Reference

A bento-grid personal portfolio built on Sage 11 (Acorn, Blade, Tailwind CSS v4, Vite).

---

## Design Philosophy

The site is a **bento-grid portfolio** — a mosaic of self-contained cards that each surface one facet of the owner's identity (profile, work, hobbies, real-time data). The aesthetic is:

- **Dark-first.** Dark mode is the default; light mode is opt-in and persisted in `localStorage`.
- **Warm neutrals + neon-green accent.** Light surfaces use a cream/paper palette; the single accent color is a vivid neon green used for interactive highlights, live-status indicators, and call-to-action elements.
- **Minimal chrome.** No persistent header or footer on the front page — the layout shell (`layouts/bento.blade.php`) renders only `<main>`.
- **Motion as delight.** Bento cards animate in with a randomised GSAP stagger on every load; hover states translate/lift cards; status dots pulse with CSS `animate-ping`.

---

## Color System

Defined in `resources/css/app.css` via `@theme {}`.

### Cream (light-mode surfaces)

| Token       | Hex       | Usage                                                  |
| ----------- | --------- | ------------------------------------------------------ |
| `cream-50`  | `#fdfbf3` | Card background (cream tone), floating pill background |
| `cream-100` | `#faf7eb` | Page background in light mode                          |
| `cream-200` | `#f3eedb` | Card borders, hover backgrounds                        |
| `cream-300` | `#e8e1c4` | Subtle borders, badge backgrounds                      |

### Neon Green (accent)

| Token      | Hex       | Usage                                                                              |
| ---------- | --------- | ---------------------------------------------------------------------------------- |
| `neon-300` | `#d4ff5a` | Dark-mode hover text on links, eyebrow labels on dark cards                        |
| `neon-400` | `#b8ff2e` | Status pulse rings, CTA background, card `invert` tone in dark mode, border hovers |
| `neon-500` | `#9eff00` | Inner dot of live-status indicators                                                |
| `neon-600` | `#7ee600` | Repo name hover in light mode                                                      |

### Neutrals

Standard Tailwind neutral scale. Key semantic roles:

| Value           | Light mode                                                  | Dark mode         |
| --------------- | ----------------------------------------------------------- | ----------------- |
| Page background | `neutral-900` body class → `cream-100` (via `bg-cream-100`) | `neutral-950`     |
| Card background | `cream-50`                                                  | `neutral-900`     |
| Card border     | `cream-300/60`                                              | `neutral-800`     |
| Body text       | `neutral-900`                                               | `neutral-100`     |
| Muted text      | `neutral-500–600`                                           | `neutral-400–500` |

---

## Typography

| Property     | Value                                                                                     |
| ------------ | ----------------------------------------------------------------------------------------- |
| Font family  | `"Google Sans"`, `"Google Sans Text"`, then system-ui fallbacks                           |
| Load method  | `<link>` preconnect + stylesheet from `fonts.googleapis.com` in `layouts/bento.blade.php` |
| Base class   | `font-sans` applied to `<body>`                                                           |
| Antialiasing | `antialiased` on `<body>`                                                                 |

Tailwind's `--font-sans` CSS variable is overridden in `@theme` so the Google Sans stack is used everywhere by default.

---

## Layout

### Page Shell — `layouts/bento.blade.php`

- No header or footer. Renders only `<main id="main">`.
- Sets `bg-cream-100 dark:bg-neutral-950` on `<body>` along with `text-neutral-900 dark:text-neutral-100 antialiased transition-colors font-sans`.
- Injects an inline `<script>` **before Vite assets** to read `localStorage` and apply `class="dark"` to `<html>` on first paint, preventing FOUC.
- Favicon is an inline SVG emoji (`😁`).

### Front Page — `front-page.blade.php`

Extends `layouts.bento`. The outer wrapper is `mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8`.

**Three-column bento grid** (stacks on mobile, side-by-side at `lg`):

```
┌─────────────────────┬──────────────────┬───────────────────┐
│ Left  38%           │ Middle  32%      │ Right  30%        │
│ profile             │ quote            │ contact           │
│ youtube             │ now              │ spotify           │
│ clock               │ particles        │                   │
└─────────────────────┴──────────────────┴───────────────────┘
│ Full-width rows                                            │
│ github                                                     │
│ figma (× 2 projects, stacked)                              │
└────────────────────────────────────────────────────────────┘
```

Implemented with `flex flex-col gap-4 lg:flex-row lg:items-start` for the three columns, and a separate `mt-4 flex flex-col gap-4` div for the full-width rows.

A `<div class="h-24">` spacer at the bottom prevents the floating pill from covering the last card.

---

## Blade Components (`resources/views/components/bento/`)

### `<x-bento.card>`

The foundational surface. Every bento panel is wrapped in this component.

**Props:**

| Prop     | Type     | Default   | Description            |
| -------- | -------- | --------- | ---------------------- |
| `tone`   | `string` | `'cream'` | Visual variant         |
| `padded` | `bool`   | `true`    | Whether to apply `p-6` |

**Tones:**

| Tone     | Light                                                     | Dark                                                 | Use cases                                    |
| -------- | --------------------------------------------------------- | ---------------------------------------------------- | -------------------------------------------- |
| `cream`  | `bg-cream-50`, `border-cream-300/60`                      | `bg-neutral-900`, `border-neutral-800`               | Default card (profile, now, spotify, github) |
| `dark`   | `bg-neutral-900`, `border-neutral-900`, `text-neutral-50` | `border-neutral-700`                                 | Dark cards in both modes (contact, clock)    |
| `invert` | `bg-neutral-900`, `text-neutral-50`                       | `bg-neon-400`, `text-neutral-900`, `border-neon-400` | Quote card — inverts to neon in dark mode    |

All cards share: `group relative overflow-hidden rounded-2xl shadow-sm transition hover:shadow-md`.

---

### `<x-bento.eyebrow>`

A small uppercase label used as a section heading within a card.

```
text-sm font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400
```

Rendered as `<h2>`. Accepts additional classes for override (e.g., `text-neon-300` on dark cards).

---

### `<x-bento.status-dot>`

An animated live-indicator dot. Two concentric circles: outer pulses with `animate-ping`, inner is solid.

```
bg-neon-400 (ping) + bg-neon-500 (inner dot)
```

Used inline in the profile avatar and the "now" list items.

---

### `<x-bento.social-icon>`

An icon link button (`40×40 px`, `rounded-xl`) for social profiles.

**Props:** `href`, `label`, `icon` (SVG path data), `imgSrc` (optional — uses `<img>` with `invert` filter instead of SVG).

Dark base with neon-400 border and text on hover; translates up 0.5px.

---

### `<x-bento.theme-toggle>`

A `40×40 px` icon button that switches dark/dark. Shows sun in dark mode, moon in light mode via `dark:block` / `dark:hidden` on the respective SVGs.

Wired to `[data-theme-toggle]` in `app.js`.

---

### `<x-bento.floating-pill>`

A fixed-position pill anchored to the bottom-center of the viewport. Uses `backdrop-blur-xl` and `bg-cream-50/90 dark:bg-neutral-900/90` for a frosted-glass appearance.

**Props:** `href`, `primary` (left label), `secondary` (right label, hidden on mobile).

Contains an animated `<x-bento.status-dot>` (ping + solid dot) as a live indicator. Lifts `-translate-y-0.5` on hover; border switches to `border-neon-400` on hover; secondary text turns `dark:text-neon-300` on hover.

---

## Bento Partials (`resources/views/partials/bento/`)

### `profile`

- `<x-bento.card>` (cream, padded).
- Avatar from `avatars.githubusercontent.com`; `ring-4 ring-cream-200 dark:ring-neutral-800`.
- Inline `bg-neon-400` dot at `bottom-0.5 right-0.5` as an "online" indicator.
- Heading: name (`text-xl font-bold sm:text-3xl`), role subtitle below.
- Short bio text underneath in `text-neutral-700 dark:text-neutral-300`.

### `youtube`

- `<x-bento.card :padded="false">`.
- `aspect-video` iframe embed (YouTube), `loading="lazy"`.

### `clock`

- `<x-bento.card tone="dark">`.
- Neon-300 eyebrow + UTC+8 badge.
- Decorative glow blob: `bg-neon-400/20 blur-3xl`.
- Live time displayed in `#ph-time` (`text-5xl sm:text-6xl font-bold tabular-nums`), updated every second by `initClock()` in JS.
- Date in `#ph-date` (`text-sm font-medium text-neutral-400`).

### `quote`

- `<x-bento.card tone="invert">`.
- Blockquote icon (`fill-current`) + large quote text (`text-xl sm:text-2xl font-medium`).
- Card inverts to `bg-neon-400 text-neutral-900` in dark mode.

### `now`

- `<x-bento.card>` (cream).
- Eyebrow + current date stamp.
- Ordered list of life updates, each prefixed with a `bg-neon-400 ring-neon-400/20` dot that scales on `group-hover`.
- Each item has a micro-eyebrow (`text-[11px] font-semibold uppercase`) and body text (`text-sm`).

### `particles`

- `<x-bento.card :padded="false">`.
- Static GIF of particles.js animation as a decorative visual.
- Gradient overlay at bottom (`from-neutral-950/80 to-transparent`) contains a Nyan Cat timer (`#nyan-timer`) updated by `initNyanTimer()` in JS, and a `canvas` badge with a fast-blinking neon dot.

### `contact`

- `<x-bento.card tone="dark">`.
- Two decorative glow blobs (neon-400/30 and neon-500/20) using `blur-3xl`, absolutely positioned.
- Availability badge: `bg-neon-400/20 text-neon-300`, dot animates with custom `blinking` keyframe.
- CTA link (`<a href="mailto:…">`) styled as `bg-neon-400 text-neutral-900`, glows on hover via `hover:shadow-[0_0_30px_-5px_var(--color-neon-400)]`.
- Social icon row: LinkedIn, GitHub, Lichess, freeCodeCamp.

### `spotify`

- `<x-bento.card>` (cream, flex-1 so it fills remaining height in its column).
- Eyebrow: "On Repeat".
- Spotify embed iframe (`height="410"`, dark theme via `theme=0`), `border-radius:12px`.

### `github`

- `<x-bento.card>` (cream, full-width row).
- Header with eyebrow + "View on GitHub" link badge (cream → neon on hover).
- Fetches pinned repos via `GitHubPinned` view composer; cached 1 hour as WP transient.
- Repo grid: `grid-cols-1 sm:grid-cols-2 lg:grid-cols-3`, each card is a link that lifts on hover, border turns neon-400.
- Shows language color dot, star count, fork count.
- Empty state: dashed border placeholder with GitHub link.

### `figma`

- Two `<x-bento.card :padded="false">` blocks stacked vertically (full-width row).
- Each has a header with project title + "Open in Figma" pill button (dark bg → neon glow on hover; inverted in dark mode to neon-400 bg).
- Figma icon inside the button rotates `group-hover/figma:rotate-12`.
- `aspect-[16/9]` Figma embed iframe below, `loading="lazy"`.
- Projects: _Positive Energy_, _Watermen Plumbing_.

---

## Animations & Motion

### GSAP Bento Intro (`initBentoIntro`)

On page load, all `[data-bento-card]` elements are set to `opacity:0, y:20, scale:0.97`, then **shuffled** and animated in with:

- `duration: 0.55s`, `ease: 'power2.out'`, `stagger: 0.07s`, `delay: 0.2s`.
- Props cleared after animation so they don't interfere with hover/focus.

### CSS Animations

| Name            | Definition                                           | Usage                                          |
| --------------- | ---------------------------------------------------- | ---------------------------------------------- |
| `blinking`      | `opacity: 1 → 0.25 → 1` over 2s                      | Availability status dot in contact card        |
| `animate-ping`  | Tailwind built-in                                    | Status-dot outer ring, floating-pill indicator |
| Hover translate | `hover:-translate-y-0.5`                             | Social icons, repo cards, floating pill        |
| Hover glow      | `hover:shadow-[0_0_30px_-5px_var(--color-neon-400)]` | Contact CTA                                    |

### Dark Mode Transition

`transition-colors` on `<body>` ensures background/text colors crossfade when the dark class is toggled.

---

## JavaScript (`resources/js/app.js`)

Entry point imports GSAP. All features are self-contained init functions called on `DOMContentLoaded`.

| Function            | What it does                                                                                                     |
| ------------------- | ---------------------------------------------------------------------------------------------------------------- |
| `initThemeToggle()` | Reads current `dark` class state; toggles it and persists `localStorage.theme` on click of `[data-theme-toggle]` |
| `initBentoIntro()`  | GSAP randomised stagger fade-in for all `[data-bento-card]`                                                      |
| `initClock()`       | Updates `#ph-time` and `#ph-date` every second using `Intl` with `Asia/Manila` timezone                          |
| `initNyanTimer()`   | Increments a second counter and updates `#nyan-timer` text every second                                          |

---

## Data Layer

### `GitHubPinned` View Composer

- **File:** `app/View/Composers/GitHubPinned.php`
- **Views:** `partials.bento.github`
- **Method:** Fetches pinned repos via the **GitHub GraphQL API** using a stored WP option (`gh_token`).
- **Cache:** WP transient `gh_recent_lewsea_v1`, TTL 1 hour.
- **Fallback:** Returns `[]` on any error so the empty-state placeholder renders.
- **Language colors:** Hardcoded subset of GitHub's language color map (`LANGUAGE_COLORS` constant).

### `App` View Composer

- **File:** `app/View/Composers/App.php`
- **Views:** `*` (all views)
- Passes `$siteName` from `get_bloginfo('name', 'display')` to every template.

---

## Dark Mode Implementation

1. **Anti-FOUC** — Inline `<script>` in `<head>` reads `localStorage.theme`; if not `'light'`, adds `class="dark"` to `<html>` before any CSS is parsed.
2. **Default** — Dark is the default; the script only removes `dark` when the stored value is explicitly `'light'`.
3. **Toggle** — `initThemeToggle()` flips the `dark` class and writes to `localStorage`.
4. **Tailwind variant** — `@custom-variant dark (&:where(.dark, .dark *))` in `app.css` — class-based dark mode, not `prefers-color-scheme`.

---

## Accessibility Notes

- Skip-to-content link: `<a class="sr-only focus:not-sr-only" href="#main">` in both layout shells.
- `aria-label` on all icon-only buttons (theme toggle, social icons).
- `aria-live="polite"` on `#ph-time`.
- `aria-hidden="true"` on all decorative SVGs and glow blobs.
- `loading="lazy"` on all non-critical iframes and images.
