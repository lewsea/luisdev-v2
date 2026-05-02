<x-bento.card class="flex w-full flex-col justify-between">
    <div class="flex items-center gap-4">
        <div class="relative">
            <img
                src="https://avatars.githubusercontent.com/u/55370617"
                alt="{{ __('Luis Gudmalin', 'sage') }}"
                width="96"
                height="96"
                loading="eager"
                class="h-24 w-24 rounded-full ring-4 ring-cream-200 dark:ring-neutral-800"
            />
            <span aria-hidden="true" class="absolute bottom-0.5 right-0.5 h-3 w-3 shrink-0 rounded-full bg-neon-400 ring-2 ring-white dark:ring-neutral-950 transition group-hover/now:scale-125"></span>
        </div>
        <div>
            <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                {{ __('Hello, I am', 'sage') }}
            </p>
            <h1 class="text-xl font-bold tracking-tight sm:text-3xl">
                {{ __('Luis Gudmalin', 'sage') }}
            </h1>
            <p class="mt-1 text-base text-neutral-600 dark:text-neutral-300">
                {{ __('Web Developer', 'sage') }}
            </p>
        </div>
    </div>
    <p class="mt-6 max-w-md text-base leading-relaxed text-neutral-700 dark:text-neutral-300">
        {{ __('날 이렇게 만들어
내일부턴 너와 남이 되길 비는 내가 싫지만
더, 더, 가봤자, 비참해지는 내 꼴
넌 내 기억 속에 아름다웠던 사랑으로 남길', 'sage') }}
    </p>
</x-bento.card>
