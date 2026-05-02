<!doctype html>
<html @php(language_attributes()) class="{{ $htmlClass ?? '' }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Set theme class before paint to avoid FOUC --}}
    <script>
      (function () {
        try {
          var stored = localStorage.getItem('theme');
          if (stored !== 'light') {
            document.documentElement.classList.add('dark');
          }
        } catch (e) {}
      })();
    </script>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>😁</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body @php(body_class('bg-cream-100 text-neutral-900 dark:bg-neutral-950 dark:text-neutral-100 antialiased transition-colors font-sans'))>
    @php(wp_body_open())

    <div id="app" class="min-h-screen">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content', 'sage') }}
      </a>

      <main id="main">
        @yield('content')
      </main>
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
