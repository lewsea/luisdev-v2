<x-bento.card tone="dark" class="flex w-full flex-col justify-between">
    {{-- Glow blob --}}
    <div aria-hidden="true" class="pointer-events-none absolute -right-10 -top-10 h-36 w-36 rounded-full bg-neon-400/20 blur-3xl"></div>

    <div class="relative flex items-center justify-between">
        <x-bento.eyebrow class="text-neon-300">{{ __('Local Time', 'sage') }}</x-bento.eyebrow>
        <span class="inline-flex items-center gap-1.5 rounded-full bg-neon-400/10 px-2.5 py-1 text-[11px] font-medium text-neon-300">
            <span class="h-1.5 w-1.5 rounded-full bg-neon-400"></span>
            PH · UTC+8
        </span>
    </div>

    <div class="relative mt-4">
        <p
            id="ph-time"
            class="font-sans text-5xl font-bold tabular-nums tracking-tight text-neutral-50 sm:text-6xl"
            aria-live="polite"
            aria-label="{{ __('Current Philippine time', 'sage') }}"
        >--:--:-- --</p>
        <p
            id="ph-date"
            class="mt-2 text-sm font-medium text-neutral-400"
        ></p>
    </div>
</x-bento.card>
