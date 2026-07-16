<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Set theme class before paint to avoid FOUC --}}
    <script>
        (function() {
            try {
                var stored = localStorage.getItem('theme');
                if (stored !== 'light') {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>

    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>😁</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body @php(body_class('bg-cream-100 text-neutral-900 dark:bg-neutral-950 dark:text-neutral-100 antialiased transition-colors font-sans'))>
    @php(wp_body_open())

    <div id="app" class="flex min-h-screen flex-col">
        <a class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-neon-400 focus:px-4 focus:py-2 focus:font-medium focus:text-neutral-900"
            href="#main">
            {{ __('Skip to content', 'sage') }}
        </a>

        @include('sections.site-header')

        <main id="main" class="flex-1">
            <div class="mx-auto w-full max-w-5xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">
                @yield('content')
            </div>
        </main>

        @include('sections.site-footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
</body>

</html>
