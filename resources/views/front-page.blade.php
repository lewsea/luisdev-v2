@extends('layouts.bento')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">

        {{-- Top bar --}}
        <div class="mb-6 flex items-center justify-end">
            <x-bento.theme-toggle />
        </div>

        {{-- Bento: 3-column layout (stacks on mobile, side-by-side on lg) --}}
        <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-[38fr_32fr_30fr]">

            {{-- Left column — hero identity, video, clock, nyan cat --}}
            <div class="flex min-w-0 flex-col gap-4">
                @include('partials.bento.profile')
                @include('partials.bento.youtube')
                @include('partials.bento.clock')
                @include('partials.bento.particles')
            </div>

            {{-- Middle column — quote, now, spotify --}}
            <div class="flex min-w-0 flex-col gap-4">
                @include('partials.bento.quote')
                @include('partials.bento.now')
                @include('partials.bento.spotify')
            </div>

            {{-- Right column — contact, Strava --}}
            <div class="flex min-w-0 flex-col gap-4">
                @include('partials.bento.contact')
                @include('partials.bento.strava')
            </div>

        </div>

        {{-- Lower row: GitHub (38% + 32%) + image block (30%) --}}
        <div class="mt-4 grid grid-cols-1 items-start gap-4 lg:grid-cols-[70fr_30fr]">
            <div class="flex min-w-0 flex-col gap-4">
                @include('partials.bento.github')
            </div>
            <div class="flex min-w-0 flex-col gap-4">
                @include('partials.bento.image-block')
            </div>
        </div>

        {{-- Figma row --}}
        <div class="mt-4 flex flex-col gap-4">
            @include('partials.bento.figma')
        </div>

        {{-- Spacer so floating pill doesn't cover content --}}
        <div class="h-24"></div>
    </div>

    <x-bento.floating-pill href="mailto:luis.gudmalin@gmail.com" />
@endsection
