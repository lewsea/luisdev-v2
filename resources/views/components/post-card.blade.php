@props([
    'featured' => true,
])

@php
    $categories = has_category() ? get_the_category() : [];
    $primaryCategory = $categories[0] ?? null;
@endphp

<article
    {{ $attributes->class(['group relative flex flex-col overflow-hidden rounded-2xl border border-cream-300/60 bg-cream-50 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-neutral-800 dark:bg-neutral-900']) }}>
    <a href="{{ get_permalink() }}" class="flex flex-1 flex-col" aria-label="{{ get_the_title() }}">
        @if ($featured)
            <div class="relative aspect-[16/9] overflow-hidden bg-cream-200 dark:bg-neutral-800">
                @if (has_post_thumbnail())
                    {!! get_the_post_thumbnail(null, 'large', [
                        'class' => 'h-full w-full object-cover transition duration-500 group-hover:scale-105',
                        'loading' => 'lazy',
                        'alt' => get_the_title(),
                    ]) !!}
                @else
                    {{-- Placeholder when a post has no featured image --}}
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-neutral-900 via-neutral-800 to-neutral-900"
                        aria-hidden="true">
                        <span class="text-4xl font-bold text-neon-400/80">
                            {{ strtoupper(mb_substr(wp_strip_all_tags(get_the_title()) ?: '·', 0, 1)) }}
                        </span>
                    </div>
                @endif

                @if ($primaryCategory)
                    <span
                        class="absolute left-3 top-3 inline-flex items-center rounded-full bg-neon-400 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-neutral-900 shadow-sm">
                        {{ $primaryCategory->name }}
                    </span>
                @endif
            </div>
        @endif

        <div class="flex flex-1 flex-col gap-3 p-5">
            @unless ($featured)
                @if ($primaryCategory)
                    <span
                        class="inline-flex w-fit items-center rounded-full bg-neon-400/15 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-neon-600 dark:text-neon-300">
                        {{ $primaryCategory->name }}
                    </span>
                @endif
            @endunless

            <h2
                class="text-lg font-bold leading-snug text-neutral-900 transition group-hover:text-neon-600 dark:text-neutral-100 dark:group-hover:text-neon-300">
                {{ get_the_title() }}
            </h2>

            <p class="line-clamp-3 flex-1 text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">
                {{ get_the_excerpt() }}
            </p>

            <div class="mt-1 flex items-center gap-2 text-xs text-neutral-500 dark:text-neutral-500">
                <time datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
                <span aria-hidden="true">&middot;</span>
                <span>{{ get_the_author() }}</span>
            </div>
        </div>
    </a>
</article>
