# Card Patterns

Copy-paste-ready Blade snippets for the `sage-bento-page` skill. Adjust spans, copy, and links per use case.

---

## 1. Profile / Intro Card (with live status dot)

```blade
<section class="group relative col-span-1 row-span-2 flex flex-col justify-between overflow-hidden
                rounded-2xl border border-cream-300/60 bg-cream-50 p-6 shadow-sm
                transition hover:shadow-md sm:col-span-2 lg:col-span-2
                dark:border-neutral-800 dark:bg-neutral-900">
  <div class="flex items-center gap-4">
    <div class="relative">
      <img src="{{ $avatar }}" alt="{{ $name }}" width="96" height="96"
           class="h-24 w-24 rounded-full ring-4 ring-cream-200 dark:ring-neutral-800" />
      <span class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center
                   rounded-full bg-neon-400 ring-2 ring-cream-50 dark:ring-neutral-900">
        <span class="h-2 w-2 animate-[blinking_0.75s_ease-in-out_infinite] rounded-full bg-neutral-900"></span>
      </span>
    </div>
    <div>
      <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">{{ __('Hello, I am', 'sage') }}</p>
      <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $name }}<span class="text-neon-500">.</span></h1>
      <p class="mt-1 text-base text-neutral-600 dark:text-neutral-300">{{ $title }}</p>
    </div>
  </div>
  <p class="mt-6 max-w-md text-base leading-relaxed text-neutral-700 dark:text-neutral-300">{{ $bio }}</p>
</section>
```

## 2. Inverted Quote / Statement Card

```blade
<section class="col-span-1 flex flex-col justify-center rounded-2xl border border-neutral-900
                bg-neutral-900 p-6 text-neutral-50 shadow-sm sm:col-span-2 lg:col-span-2
                dark:border-neon-400 dark:bg-neon-400 dark:text-neutral-900">
  <svg class="mb-3 h-6 w-6 text-neon-400 dark:text-neutral-900" viewBox="0 0 24 24" fill="currentColor">
    <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
  </svg>
  <p class="text-xl font-medium leading-snug sm:text-2xl">{{ $quote }}</p>
</section>
```

## 3. Tag Pill Cluster (Tech Stack)

```blade
<section class="col-span-1 rounded-2xl border border-cream-300/60 bg-cream-50 p-6 shadow-sm
                sm:col-span-2 lg:col-span-2 dark:border-neutral-800 dark:bg-neutral-900">
  <h2 class="text-sm font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
    {{ __('Tech Stack', 'sage') }}
  </h2>
  <div class="mt-4 flex flex-wrap gap-2">
    @foreach ($skills as $skill)
      <span class="inline-flex items-center rounded-lg border border-cream-300 bg-cream-100
                   px-3 py-1 text-sm font-medium text-neutral-700 transition
                   hover:border-neon-400 hover:bg-neon-300/40
                   dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200
                   dark:hover:border-neon-400 dark:hover:bg-neon-400/10 dark:hover:text-neon-300">
        {{ $skill }}
      </span>
    @endforeach
  </div>
</section>
```

## 4. Glow-Accent CTA Card (Get in Touch pattern)

```blade
<section class="group relative col-span-1 flex flex-col justify-between overflow-hidden
                rounded-2xl border border-neutral-900 bg-neutral-900 p-6 text-neutral-50
                shadow-sm transition hover:shadow-lg sm:col-span-2 lg:col-span-2
                dark:border-neutral-700">
  {{-- Decorative glow blobs --}}
  <div aria-hidden="true" class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-neon-400/30 blur-3xl"></div>
  <div aria-hidden="true" class="pointer-events-none absolute -bottom-20 -left-10 h-40 w-40 rounded-full bg-neon-500/20 blur-3xl"></div>

  <div class="relative flex items-center justify-between">
    <h2 class="text-sm font-semibold uppercase tracking-wider text-neon-300">{{ $heading }}</h2>
    <span class="inline-flex items-center gap-1.5 rounded-full bg-neon-400/20 px-2.5 py-1 text-xs font-medium text-neon-300">
      <span class="h-1.5 w-1.5 animate-[blinking_0.75s_ease-in-out_infinite] rounded-full bg-neon-400"></span>
      {{ $statusLabel }}
    </span>
  </div>

  <a href="{{ $primaryHref }}"
     class="relative mt-6 inline-flex items-center justify-between gap-3 rounded-xl bg-neon-400
            px-4 py-3 font-medium text-neutral-900 transition hover:bg-neon-300
            hover:shadow-[0_0_30px_-5px_var(--color-neon-400)]">
    <span class="truncate">{{ $primaryLabel }}</span>
    <span aria-hidden="true">→</span>
  </a>
</section>
```

## 5. YouTube Embed Card

```blade
<section class="col-span-1 overflow-hidden rounded-2xl border border-cream-300/60 bg-cream-50
                shadow-sm sm:col-span-2 lg:col-span-2 dark:border-neutral-800 dark:bg-neutral-900">
  <div class="aspect-video w-full">
    <iframe class="h-full w-full"
            src="https://www.youtube.com/embed/{{ $videoId }}"
            title="{{ $title }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
            loading="lazy"></iframe>
  </div>
</section>
```

## 6. Spotify Playlist Card

```blade
<section class="col-span-1 flex flex-col rounded-2xl border border-cream-300/60 bg-cream-50 p-6
                shadow-sm sm:col-span-2 lg:col-span-2 dark:border-neutral-800 dark:bg-neutral-900">
  <h2 class="mb-4 text-sm font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
    {{ __('On Repeat', 'sage') }}
  </h2>
  <iframe style="border-radius:12px"
          src="https://open.spotify.com/embed/playlist/{{ $playlistId }}?utm_source=generator&theme=0"
          width="100%" height="352" frameborder="0" allowfullscreen
          allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
          loading="lazy"></iframe>
</section>
```

## 7. Figma Project Showcase (full-width)

```blade
<section class="col-span-1 flex flex-col overflow-hidden rounded-2xl border border-cream-300/60
                bg-cream-50 shadow-sm sm:col-span-2 lg:col-span-4
                dark:border-neutral-800 dark:bg-neutral-900">
  <div class="flex items-center justify-between p-6 pb-4">
    <div>
      <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
        {{ $eyebrow }}
      </p>
      <h2 class="mt-1 text-xl font-semibold">{{ $title }}</h2>
    </div>
    <a href="{{ $externalUrl }}" target="_blank" rel="noopener noreferrer"
       class="inline-flex items-center gap-1 rounded-lg border border-cream-300 bg-cream-100
              px-3 py-1.5 text-sm font-medium text-neutral-700 transition
              hover:border-neon-400 hover:bg-neon-300/40
              dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200
              dark:hover:border-neon-400 dark:hover:bg-neon-400/10 dark:hover:text-neon-300">
      {{ __('Open in Figma', 'sage') }} <span aria-hidden="true">→</span>
    </a>
  </div>
  <div class="aspect-[16/9] w-full bg-cream-200 dark:bg-neutral-800">
    <iframe class="h-full w-full"
            src="https://embed.figma.com/design/{{ $fileKey }}/{{ $fileName }}?node-id={{ $nodeId }}&embed-host=share"
            allowfullscreen loading="lazy"></iframe>
  </div>
</section>
```
