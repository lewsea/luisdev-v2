@php
    global $wp_query;
    $totalPosts = (int) ($wp_query->found_posts ?? 0);

    // Contextual eyebrow label for the current archive type.
    $eyebrow = __('Archive', 'sage');
    if (is_category()) {
        $eyebrow = __('Category', 'sage');
    } elseif (is_tag()) {
        $eyebrow = __('Tag', 'sage');
    } elseif (is_author()) {
        $eyebrow = __('Author', 'sage');
    } elseif (is_date()) {
        $eyebrow = __('Archive', 'sage');
    } elseif (is_post_type_archive()) {
        $eyebrow = __('Archive', 'sage');
    } elseif (is_tax()) {
        $taxObject = get_queried_object();
        $taxonomy = $taxObject && isset($taxObject->taxonomy) ? get_taxonomy($taxObject->taxonomy) : false;
        $eyebrow = $taxonomy ? $taxonomy->labels->singular_name : __('Archive', 'sage');
    } elseif (is_home()) {
        $eyebrow = __('The Blog', 'sage');
    }

    // Resolve a clean title with a sensible fallback for the posts page.
    if (isset($archiveTitle)) {
        $heroTitle = $archiveTitle;
    } elseif (is_home()) {
        $postsPage = get_option('page_for_posts');
        $heroTitle = $postsPage ? get_the_title($postsPage) : __('Latest Posts', 'sage');
    } else {
        $heroTitle = get_the_archive_title();
    }

    $postsPageId = is_home() ? (int) get_option('page_for_posts') : 0;
    $description = $postsPageId
        ? apply_filters('the_content', get_post_field('post_content', $postsPageId))
        : (is_home()
            ? ''
            : get_the_archive_description());
    $description = trim(wp_strip_all_tags((string) $description)) !== '' ? $description : '';
@endphp

<header class="mb-10 flex flex-col gap-4 border-b border-cream-300/60 pb-8 dark:border-neutral-800">
    <x-bento.eyebrow class="text-neon-600 dark:text-neon-300">{{ $eyebrow }}</x-bento.eyebrow>

    <h1 class="text-3xl font-bold tracking-tight text-neutral-900 sm:text-4xl dark:text-neutral-100">
        {!! $heroTitle !!}
    </h1>

    @if ($description)
        <div class="max-w-2xl text-base leading-relaxed text-neutral-600 dark:text-neutral-400">
            {!! $description !!}
        </div>
    @endif

    @if ($totalPosts > 0)
        <p class="text-sm text-neutral-500 dark:text-neutral-500">
            {{ sprintf(_n('%s post', '%s posts', $totalPosts, 'sage'), number_format_i18n($totalPosts)) }}
        </p>
    @endif
</header>
