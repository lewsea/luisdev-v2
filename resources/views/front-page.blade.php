@extends('layouts.bento')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">

        {{-- Top bar --}}
        <div class="mb-6 flex items-center justify-end">
            <x-bento.theme-toggle />
        </div>

        {{-- Bento: 3-column layout (stacks on mobile, side-by-side on lg) --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start">

            {{-- Left column — hero identity + video + clock --}}
            <div class="flex flex-col gap-4 lg:w-[38%]">
                @include('partials.bento.profile')
                @include('partials.bento.youtube')
                @include('partials.bento.clock')
            </div>

            {{-- Middle column — quote, now, nyan cat --}}
            <div class="flex flex-col gap-4 lg:w-[32%]">
                @include('partials.bento.quote')
                @include('partials.bento.now')
                @include('partials.bento.particles')
            </div>

            {{-- Right column — contact, spotify --}}
            <div class="flex flex-col gap-4 lg:w-[30%]">
                @include('partials.bento.contact')
                @include('partials.bento.spotify')
            </div>

        </div>

        {{-- Full-width rows --}}
        <div class="mt-4 flex flex-col gap-4">
            @include('partials.bento.github')
            @include('partials.bento.figma')
        </div>

        {{-- Spacer so floating pill doesn't cover content --}}
        <div class="h-24"></div>
    </div>

    <x-bento.floating-pill href="mailto:luis.gudmalin@gmail.com" />
@endsection
