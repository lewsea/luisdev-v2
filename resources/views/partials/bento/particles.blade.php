<x-bento.card :padded="false" class="w-full flex-1">
    <div class="relative aspect-video w-full overflow-hidden bg-neutral-950">
        <img
            src="{{ asset('resources/images/nyan-cat.gif') }}"
            alt="{{ __('nyan cat', 'sage') }}"
            class="h-full w-full object-contain"
            loading="lazy"
        />
        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 bg-gradient-to-t from-neutral-950/80 to-transparent p-4">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-neon-300">NON-STOP NYAN CAT</p>
                <p id="nyan-timer" class="text-sm font-medium text-neutral-50">You've NYANED for 0 seconds</p>
            </div>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-2.5 py-1 text-[11px] font-medium text-neutral-100 backdrop-blur">
                <span class="inline-block h-1.5 w-1.5 animate-[blinking_0.75s_ease-in-out_infinite] rounded-full bg-neon-400"></span>
                {{ __('canvas', 'sage') }}
            </span>
        </div>
    </div>
</x-bento.card>
