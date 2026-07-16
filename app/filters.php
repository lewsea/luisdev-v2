<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
  return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Remove WordPress global-styles inline CSS that overrides anchor decoration.
 */
add_action('wp_enqueue_scripts', function () {
  wp_dequeue_style('global-styles');
  wp_deregister_style('global-styles');
}, 100);

/**
 * Strip the default prefix (e.g. "Category:", "Tag:") from archive titles so
 * templates can display a clean term name alongside their own context label.
 *
 * @return string
 */
add_filter('get_the_archive_title', function ($title) {
  return preg_replace('/^[^:]+:\s*/', '', $title);
});

/**
 * Use a larger, cleaner excerpt length for card summaries.
 *
 * @return int
 */
add_filter('excerpt_length', function () {
  return 24;
});
