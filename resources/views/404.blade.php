@extends('layouts.site')

@section('content')
    @php
        $recentPosts = get_posts(['numberposts' => 3, 'post_status' => 'publish']);
    @endphp

    <section class="mx-auto flex w-full max-w-2xl flex-col items-center gap-8 py-8 text-center">
        <div class="flex flex-col items-center gap-4">
            <span
                class="inline-flex items-center gap-2 rounded-full bg-neon-400/15 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-neon-600 dark:text-neon-300">
                <x-bento.status-dot />
                {{ __('Error 404', 'sage') }}
            </span>

            <h1
                class="bg-gradient-to-b from-neutral-900 to-neutral-500 bg-clip-text text-7xl font-bold tracking-tight text-transparent sm:text-8xl dark:from-neutral-100 dark:to-neutral-500">
                404
            </h1>

            <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                {{ __('This page wandered off', 'sage') }}
            </h2>

            <p class="max-w-md text-base leading-relaxed text-neutral-600 dark:text-neutral-400">
                {{ __('The page you’re looking for doesn’t exist or may have been moved. Try searching, or head back home.', 'sage') }}
            </p>
        </div>

        <x-search-form class="max-w-md" :autofocus="true" />

        <a href="{{ home_url('/') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-neon-400 px-5 py-2.5 text-sm font-semibold text-neutral-900 transition hover:shadow-[0_0_30px_-5px_var(--color-neon-400)]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            {{ __('Back to home', 'sage') }}
        </a>
    </section>

    @if (!empty($recentPosts))
        <section class="mt-16">
            <x-bento.eyebrow class="mb-6 text-center text-neon-600 dark:text-neon-300">
                {{ __('Latest posts', 'sage') }}
            </x-bento.eyebrow>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                @foreach ($recentPosts as $post)
                    @php(setup_postdata($GLOBALS['post'] = $post))
                    <x-post-card :featured="false" />
                @endforeach
                @php(wp_reset_postdata())
            </div>
        </section>
    @endif
@endsection
