@props(['href', 'label', 'icon' => '', 'imgSrc' => null])

<a
    href="{{ $href }}"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="{{ $label }}"
    title="{{ $label }}"
    class="group/link inline-flex h-10 w-10 items-center justify-center rounded-xl border border-neutral-700 bg-neutral-800/60 text-neutral-300 no-underline transition hover:-translate-y-0.5 hover:border-neon-400 hover:bg-neutral-800 hover:text-neon-300"
>
    @if ($imgSrc)
        <img
            src="{{ $imgSrc }}"
            alt="{{ $label }}"
            width="18"
            height="18"
            class="block invert opacity-60 transition group-hover/link:opacity-100"
        />
    @else
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="block">
            <path d="{{ $icon }}"/>
        </svg>
    @endif
</a>
