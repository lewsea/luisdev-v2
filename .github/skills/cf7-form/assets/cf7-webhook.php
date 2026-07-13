<?php

/**
 * Contact Form 7 — webhook integration.
 *
 * After CF7 successfully sends a mail, POST submitted field data to
 * the configured webhook endpoint.
 */

namespace App;

/**
 * Fire the webhook after every successful CF7 submission.
 *
 * @param  \WPCF7_ContactForm  $contact_form
 * @return void
 */
add_action('wpcf7_mail_sent', function ($contact_form) {
  $submission = \WPCF7_Submission::get_instance();

  if (! $submission) {
    return;
  }

  $posted_data = $submission->get_posted_data();

  // Strip internal CF7 meta-fields that begin with an underscore.
  $payload = array_filter(
    $posted_data,
    fn($key) => ! str_starts_with($key, '_'),
    ARRAY_FILTER_USE_KEY
  );

  // Include source metadata so downstream systems can route by form.
  $payload['_cf7_form_id'] = $contact_form->id();
  $payload['_cf7_form_title'] = $contact_form->title();

  $webhook_url = apply_filters(
    'sage/cf7_webhook_url',
    defined('CF7_WEBHOOK_URL') ? CF7_WEBHOOK_URL : ''
  );

  if (! $webhook_url) {
    return;
  }

  wp_remote_post($webhook_url, [
    'body' => $payload,
    'timeout' => 15,
    'blocking' => false,
    'sslverify' => true,
  ]);
});
