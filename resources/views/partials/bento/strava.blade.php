<x-bento.card :padded="false" class="flex w-full flex-col">
    <h2 class="mb-4 px-4 pt-4 text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
        {{ __('Yes im the guy running behind you', 'sage') }}
    </h2>
    <iframe class="mx-auto block h-[470px] w-full max-w-[300px] pb-4" src="https://www.strava.com/athletes/1286686360/latest-rides/8826eaafaee4e4e17a1a0e6a2ad53272c6d81d07" title="{{ __('Latest Strava ride', 'sage') }}" frameborder="0" allowtransparency="true" scrolling="no" loading="lazy"></iframe>
</x-bento.card>

<x-bento.card :padded="false" class="flex w-full flex-col">
    <h2 class="mb-4 px-4 pt-4 text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
        {{ __('Hes limping, catch him', 'sage') }}
    </h2>
    <iframe class="mx-auto block h-[176px] w-full max-w-[300px] pb-4" src="https://www.strava.com/athletes/1286686360/activity-summary/8826eaafaee4e4e17a1a0e6a2ad53272c6d81d07" title="{{ __('Strava activity summary', 'sage') }}" frameborder="0" allowtransparency="true" scrolling="no" loading="lazy"></iframe>
</x-bento.card>
