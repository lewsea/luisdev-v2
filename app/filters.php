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
