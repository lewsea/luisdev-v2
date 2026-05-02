<x-bento.card tone="dark" class="flex w-full flex-col justify-between">
    {{-- Decorative glow blobs --}}
    <div aria-hidden="true" class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-neon-400/30 blur-3xl"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -bottom-20 -left-10 h-40 w-40 rounded-full bg-neon-500/20 blur-3xl"></div>

    <div class="relative flex items-center justify-between">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-neon-300">
            {{ __('Get in touch', 'sage') }}
        </h2>
        <span class="inline-flex items-center gap-1.5 rounded-full bg-neon-400/20 px-2.5 py-1 text-xs font-medium text-neon-300">
            <span class="h-1.5 w-1.5 animate-[blinking_2s_ease-in-out_infinite] rounded-full bg-neon-400"></span>
            {{ __('NOT Available for work', 'sage') }}
        </span>
    </div>

    <a
        href="mailto:luis.gudmalin@gmail.com"
        class="relative mt-6 inline-flex items-center justify-between gap-3 rounded-xl bg-neon-400 px-4 py-3 font-medium text-neutral-900 no-underline transition hover:bg-neon-300 hover:shadow-[0_0_30px_-5px_var(--color-neon-400)]"
    >
        <span class="flex items-center gap-2 truncate">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
            </svg>
            <span class="truncate">luis.gudmalin@gmail.com</span>
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
        </svg>
    </a>

    <div class="relative mt-5 flex flex-wrap items-center gap-2">
        @php($socials = [
            ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/luis-gudmalin-8b0349195/', 'icon' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.268 2.37 4.268 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.063 2.063 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z'],
            ['label' => 'GitHub', 'url' => 'https://github.com/lewsea', 'icon' => 'M12 .5C5.73.5.5 5.74.5 12.02c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.87-1.54-3.87-1.54-.52-1.32-1.27-1.67-1.27-1.67-1.04-.71.08-.7.08-.7 1.15.08 1.76 1.18 1.76 1.18 1.02 1.75 2.69 1.25 3.34.95.1-.74.4-1.25.72-1.54-2.55-.29-5.24-1.28-5.24-5.7 0-1.26.45-2.29 1.18-3.1-.12-.29-.51-1.46.11-3.04 0 0 .97-.31 3.18 1.18a11.07 11.07 0 0 1 5.79 0c2.21-1.49 3.18-1.18 3.18-1.18.62 1.58.23 2.75.11 3.04.74.81 1.18 1.84 1.18 3.1 0 4.43-2.7 5.41-5.27 5.69.41.36.78 1.07.78 2.16 0 1.56-.01 2.81-.01 3.19 0 .31.21.68.8.56A11.52 11.52 0 0 0 23.5 12.02C23.5 5.74 18.27.5 12 .5z'],
            ['label' => 'Lichess', 'url' => 'https://lichess.org/@/lewsea', 'imgSrc' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Lichess_Logo_2019.svg/120px-Lichess_Logo_2019.svg.png'],
            ['label' => 'freeCodeCamp', 'url' => 'https://www.freecodecamp.org/lewsea/', 'icon' => 'M19.885 4.34a.69.69 0 0 0-.51.18c-.27.27-.27.69 0 .96 4.05 4.04 4.05 10.61 0 14.66-.27.27-.27.69 0 .96.27.27.69.27.96 0 4.59-4.58 4.59-12 0-16.58a.68.68 0 0 0-.45-.18zm-15.77 0a.68.68 0 0 0-.45.18c-4.59 4.58-4.59 12 0 16.58.27.27.69.27.96 0 .27-.27.27-.69 0-.96-4.05-4.05-4.05-10.62 0-14.66.27-.27.27-.69 0-.96a.69.69 0 0 0-.51-.18zm12.34 2.69c-.27-.04-.55.05-.74.27-.31.36-3.04 3.59-3.04 5.84 0 1.27.61 2 1.16 2.84.49.74.95 1.45.95 2.55 0 1.66-1.62 2.99-1.64 3-.32.25-.39.71-.16 1.04.14.2.36.31.59.31.16 0 .31-.05.45-.15.09-.07 2.21-1.74 2.21-4.2 0-1.55-.65-2.54-1.18-3.34-.49-.74-.84-1.27-.84-2.05 0-1.55 2.16-4.21 2.69-4.81.26-.3.23-.74-.07-.99a.6.6 0 0 0-.38-.31zm-3.66 1.6c-.21-.04-.43.05-.58.23-.13.16-2.95 3.56-1.84 6.4.74 1.91-.07 2.74-.21 2.86-.31.26-.36.71-.11 1.02.13.16.32.25.5.25.16 0 .32-.05.45-.16.55-.45 1.36-2.07.45-4.43-.81-2.07 1.66-5.06 1.7-5.09.25-.3.21-.74-.09-.99a.6.6 0 0 0-.27-.09zM6.55 8.96c-.13 0-.26.04-.36.14a.69.69 0 0 0 0 .96c1.84 1.84 1.84 4.84 0 6.69a.69.69 0 0 0 0 .96c.27.27.69.27.96 0 2.36-2.39 2.36-6.27 0-8.65a.71.71 0 0 0-.6-.1z'],
        ])
        @foreach ($socials as $s)
            <x-bento.social-icon
                :href="$s['url']"
                :label="$s['label']"
                :icon="$s['icon'] ?? ''"
                :imgSrc="$s['imgSrc'] ?? null"
            />
        @endforeach
    </div>
</x-bento.card>
