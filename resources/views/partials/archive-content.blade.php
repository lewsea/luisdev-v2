@include('partials.archive-hero')

@if (have_posts())
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @while (have_posts())
            @php(the_post())
            <x-post-card />
        @endwhile
    </div>

    @include('partials.pagination')
@else
    @include('partials.no-results', [
        'title' => __('No posts here yet', 'sage'),
        'message' => __(
            'There’s no content in this section right now. Check back soon or search for something else.',
            'sage'),
    ])
@endif
