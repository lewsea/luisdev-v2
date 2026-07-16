@extends('layouts.site')

@section('content')
    @php
        global $wp_query;
        $totalResults = (int) ($wp_query->found_posts ?? 0);
        $query = get_search_query();
    @endphp

    <header class="mb-10 flex flex-col gap-5 border-b border-cream-300/60 pb-8 dark:border-neutral-800">
        <x-bento.eyebrow class="text-neon-600 dark:text-neon-300">{{ __('Search', 'sage') }}</x-bento.eyebrow>

        <h1 class="text-3xl font-bold tracking-tight text-neutral-900 sm:text-4xl dark:text-neutral-100">
            @if ($query)
                {{ __('Results for', 'sage') }} <span class="text-neon-600 dark:text-neon-300">“{{ $query }}”</span>
            @else
                {{ __('Search', 'sage') }}
            @endif
        </h1>

        @if ($query)
            <p class="text-sm text-neutral-500 dark:text-neutral-500">
                {{ sprintf(_n('%s result found', '%s results found', $totalResults, 'sage'), number_format_i18n($totalResults)) }}
            </p>
        @endif

        <x-search-form class="max-w-xl" />
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
            'title' => __('No results found', 'sage'),
            'message' => $query
                ? sprintf(__('We couldn’t find anything matching “%s”. Try different keywords.', 'sage'), $query)
                : __('Type something above to search the site.', 'sage'),
            'showSearch' => false,
        ])
    @endif
@endsection
