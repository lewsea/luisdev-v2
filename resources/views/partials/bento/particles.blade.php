<x-bento.card :padded="false" class="w-full flex-1">
    <div class="relative aspect-video w-full overflow-hidden bg-neutral-950">
        <img
            src="https://camo.githubusercontent.com/9753f1e01652edc8891a08c991ea4257ab55e1e7ba9a2dc627e188f5154624d8/68747470733a2f2f76696e63656e74676172726561752e636f6d2f7061727469636c65732e6a732f6173736574732f696d672f6b624c643976625f6e65772e676966"
            alt="{{ __('particles.js animation', 'sage') }}"
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
