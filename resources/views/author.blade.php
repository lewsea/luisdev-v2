@extends('layouts.site')

@section('content')
    @php
        $authorId = get_the_author_meta('ID');
        $authorName = get_the_author_meta('display_name', $authorId) ?: get_the_author();
        $authorBio = get_the_author_meta('description', $authorId);
        global $wp_query;
        $totalPosts = (int) ($wp_query->found_posts ?? 0);
    @endphp

    <header
        class="mb-10 flex flex-col gap-5 border-b border-cream-300/60 pb-8 sm:flex-row sm:items-center dark:border-neutral-800">
        <img src="{{ get_avatar_url($authorId, ['size' => 160]) }}" alt="{{ $authorName }}" width="80" height="80"
            loading="lazy" class="h-20 w-20 rounded-2xl object-cover ring-4 ring-cream-200 dark:ring-neutral-800">

        <div class="flex flex-col gap-2">
            <x-bento.eyebrow class="text-neon-600 dark:text-neon-300">{{ __('Author', 'sage') }}</x-bento.eyebrow>
            <h1 class="text-3xl font-bold tracking-tight text-neutral-900 sm:text-4xl dark:text-neutral-100">
                {{ $authorName }}
            </h1>

            @if ($authorBio)
                <p class="max-w-2xl text-base leading-relaxed text-neutral-600 dark:text-neutral-400">
                    {{ $authorBio }}
                </p>
            @endif

            @if ($totalPosts > 0)
                <p class="text-sm text-neutral-500 dark:text-neutral-500">
                    {{ sprintf(_n('%s post', '%s posts', $totalPosts, 'sage'), number_format_i18n($totalPosts)) }}
                </p>
            @endif
        </div>
    </header>

    @if (have_posts())
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @while (have_posts())
                @php(the_post())
                <x-post-card />
            @endwhile
        </div>

        @include('partials.pagination')
    @else
        @include('partials.no-results', [
            'title' => __('No posts yet', 'sage'),
            'message' => __('This author hasn’t published anything yet. Check back soon.', 'sage'),
        ])
    @endif
@endsection
