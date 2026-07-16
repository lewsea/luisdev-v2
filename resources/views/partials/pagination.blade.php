@php
    $pagination = paginate_links([
        'type' => 'array',
        'prev_text' => __('Previous', 'sage'),
        'next_text' => __('Next', 'sage'),
        'mid_size' => 1,
        'end_size' => 1,
    ]);
@endphp

@if (!empty($pagination))
    <nav class="mt-12 flex justify-center" aria-label="{{ __('Posts pagination', 'sage') }}">
        <ul class="flex flex-wrap items-center gap-2">
            @foreach ($pagination as $link)
                <li>
                    @php
                        $isCurrent = str_contains($link, 'aria-current');
                        $base =
                            'inline-flex h-10 min-w-10 items-center justify-center rounded-xl border px-3 text-sm font-medium transition';
                        $active = 'border-neon-400 bg-neon-400 text-neutral-900';
                        $idle =
                            'border-cream-300/60 bg-cream-50 text-neutral-700 hover:border-neon-400 hover:text-neon-600 dark:border-neutral-800 dark:bg-neutral-900 dark:text-neutral-300 dark:hover:border-neon-400 dark:hover:text-neon-300';
                        $classes = $base . ' ' . ($isCurrent ? $active : $idle);
                        // Inject Tailwind classes into the generated anchor/span markup.
                        $link = preg_replace('/class="([^"]*)"/', 'class="$1 ' . $classes . '"', $link, 1);
                        if (!str_contains($link, 'class=')) {
                            $link = preg_replace('/^<(a|span)/', '<$1 class="' . $classes . '"', $link, 1);
                        }
                    @endphp
                    {!! $link !!}
                </li>
            @endforeach
        </ul>
    </nav>
@endif
