<article @php(post_class('mx-auto w-full max-w-3xl'))>
    @php($categories = has_category() ? get_the_category() : [])
    @php($primaryCategory = $categories[0] ?? null)
    @php($wordCount = str_word_count(wp_strip_all_tags(get_the_content())))
    @php($readingTime = max(1, (int) ceil($wordCount / 200)))
    @php($authorId = get_the_author_meta('ID'))

    <header class="flex flex-col gap-5">
        <div class="flex flex-wrap items-center gap-3">
            @if ($primaryCategory)
                <a href="{{ get_category_link($primaryCategory) }}"
                    class="inline-flex items-center rounded-full bg-neon-400 px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-neutral-900 transition hover:shadow-[0_0_20px_-4px_var(--color-neon-400)]">
                    {{ $primaryCategory->name }}
                </a>
            @endif
            <span class="text-xs text-neutral-500 dark:text-neutral-500">
                {{ sprintf(__('%s min read', 'sage'), $readingTime) }}
            </span>
        </div>

        <h1 class="text-3xl font-bold leading-tight tracking-tight text-neutral-900 sm:text-4xl dark:text-neutral-100">
            {{ get_the_title() }}
        </h1>

        <div class="flex items-center gap-3 border-b border-cream-300/60 pb-6 dark:border-neutral-800">
            <img src="{{ get_avatar_url($authorId, ['size' => 80]) }}" alt="{{ get_the_author() }}" width="40"
                height="40" loading="lazy"
                class="h-10 w-10 rounded-full object-cover ring-2 ring-cream-200 dark:ring-neutral-800">
            <div class="flex flex-col text-sm">
                <a href="{{ get_author_posts_url($authorId) }}"
                    class="font-semibold text-neutral-900 transition hover:text-neon-600 dark:text-neutral-100 dark:hover:text-neon-300">
                    {{ get_the_author() }}
                </a>
                <time class="text-neutral-500 dark:text-neutral-500" datetime="{{ get_post_time('c', true) }}">
                    {{ get_the_date() }}
                </time>
            </div>
        </div>
    </header>

    @if (has_post_thumbnail())
        <figure class="mt-8 overflow-hidden rounded-2xl border border-cream-300/60 dark:border-neutral-800">
            {!! get_the_post_thumbnail(null, 'large', [
                'class' => 'h-auto w-full object-cover',
                'alt' => get_the_title(),
            ]) !!}
        </figure>
    @endif

    <div class="prose mt-8 max-w-none">
        @php(the_content())
    </div>

    @php($tags = get_the_tags())
    @if ($tags)
        <div class="mt-8 flex flex-wrap gap-2">
            @foreach ($tags as $tag)
                <a href="{{ get_tag_link($tag) }}"
                    class="inline-flex items-center rounded-full border border-cream-300/60 bg-cream-50 px-3 py-1 text-xs font-medium text-neutral-600 transition hover:border-neon-400 hover:text-neon-600 dark:border-neutral-800 dark:bg-neutral-900 dark:text-neutral-400 dark:hover:text-neon-300">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    @endif

    @if ($pagination())
        <footer class="mt-8">
            <nav class="page-nav flex flex-wrap items-center gap-2 text-sm" aria-label="{{ __('Page', 'sage') }}">
                {!! $pagination !!}
            </nav>
        </footer>
    @endif

    {{-- Author bio --}}
    @if ($bio = get_the_author_meta('description', $authorId))
        <aside
            class="mt-12 flex flex-col gap-4 rounded-2xl border border-cream-300/60 bg-cream-50 p-6 sm:flex-row dark:border-neutral-800 dark:bg-neutral-900">
            <img src="{{ get_avatar_url($authorId, ['size' => 128]) }}" alt="{{ get_the_author() }}" width="64"
                height="64" loading="lazy"
                class="h-16 w-16 shrink-0 rounded-2xl object-cover ring-2 ring-cream-200 dark:ring-neutral-800">
            <div class="flex flex-col gap-1">
                <x-bento.eyebrow
                    class="text-neon-600 dark:text-neon-300">{{ __('Written by', 'sage') }}</x-bento.eyebrow>
                <a href="{{ get_author_posts_url($authorId) }}"
                    class="text-lg font-bold text-neutral-900 transition hover:text-neon-600 dark:text-neutral-100 dark:hover:text-neon-300">
                    {{ get_the_author() }}
                </a>
                <p class="text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">{{ $bio }}</p>
            </div>
        </aside>
    @endif

    @include('partials.post-navigation')

    @php(comments_template())
</article>
