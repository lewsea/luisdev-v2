---
name: cf7-form
description: 'Implement a Contact Form 7 form in this Sage theme. Use when adding any user-facing form — contact, inquiry, booking, etc. Never generate a vanilla Blade/PHP <form> — always generate a CF7 form template and mail template stored in resources/views/forms/.'
argument-hint: 'form purpose and fields (e.g. "contact form with name, email, subject, message")'
---

# CF7 Form

Generates a CF7 form template, mail template, spinner CSS, and a Blade rendering view for this Sage 11 theme. Contact Form 7 is the **only** acceptable form implementation — never produce a vanilla Blade/PHP `<form>`.

## When to Use

- Any time a form is needed in the theme (contact, inquiry, booking, newsletter, etc.)
- Never scaffold plain `<form>` tags or Blade form partials
- Always use the CF7 shortcode system and output to `resources/views/forms/`

---

## File Layout

One Blade file per form:

```
resources/views/forms/{name}.blade.php
```

Each file contains **three clearly separated sections** in this exact order:

| Section           | Blade Delimiter                                                    | Purpose                                                   |
| ----------------- | ------------------------------------------------------------------ | --------------------------------------------------------- |
| CF7 Form Template | `{{-- [CF7 Form Template] --}}` … `{{-- [/CF7 Form Template] --}}` | Raw CF7 tag markup — copy-paste into CF7 Admin › Form tab |
| CF7 Mail Template | `{{-- [CF7 Mail Template] --}}` … `{{-- [/CF7 Mail Template] --}}` | Mail config — copy-paste into CF7 Admin › Mail tab        |
| Blade rendering   | (outside comments)                                                 | `{!! do_shortcode(...) !!}` renders the live form         |

---

## Step-by-Step Procedure

### 1. Identify the form name and fields

- Use **kebab-case** for the filename: `contact.blade.php`, `booking-inquiry.blade.php`
- List every field with its type: `text`, `email`, `tel`, `textarea`, `select`, `checkbox`, `radio`, `submit`
- Assign CF7 field name slugs (lowercase, hyphens only): `your-name`, `your-email`, `your-message`
- Decide the recipient address: `[_site_admin_email]` for the site admin, or a literal address

### 2. Write the CF7 Form Template

The form template uses **CF7 shortcode syntax** (the `[tag]` syntax) wrapped in **explicit HTML**. This content goes between the `{{-- [CF7 Form Template] --}}` delimiters.

#### ⚠ No-Whitespace Rules (required)

`wpcf7_autop` behaves like WordPress's `wpautop` — double newlines become `<p>` tags and extra whitespace creates unexpected markup. Prevent this by following these rules strictly:

1. **Every CF7 tag must be on a single line**, inside an explicit block element — never let CF7 tags stand alone on their own line
2. **No blank lines** between field groups (blank lines → `<p>` wrappers)
3. **No trailing spaces** on any line
4. **No indentation** on lines containing CF7 tags (leading whitespace can confuse some CF7 versions)
5. The `[submit]` tag **must** be inside `<div class="cf7-submit-wrap">` — this is required for spinner CSS (see §5)

#### Field Line Format

```
<div class="cf7-field"><label>Label [tag* slug placeholder "Hint"]</label></div>
```

All on one line. No internal newlines.

#### Complete Form Template Example (contact form)

```html
<div class="cf7-field">
  <label>Name [text* your-name placeholder "Your name"]</label>
</div>
<div class="cf7-field">
  <label>Email [email* your-email placeholder "your@email.com"]</label>
</div>
<div class="cf7-field">
  <label>Subject [text your-subject placeholder "Subject"]</label>
</div>
<div class="cf7-field">
  <label>Message [textarea* your-message placeholder "Your message"]</label>
</div>
<div class="cf7-submit-wrap">[submit "Send"]</div>
```

No blank lines between the field divs. The last line is the submit wrapper — no trailing newline after it.

#### Common CF7 Tag Reference

| Field type        | CF7 tag syntax                                               |
| ----------------- | ------------------------------------------------------------ |
| Required text     | `[text* slug placeholder "Hint"]`                            |
| Optional text     | `[text slug placeholder "Hint"]`                             |
| Required email    | `[email* slug placeholder "Hint"]`                           |
| Required textarea | `[textarea* slug placeholder "Hint"]`                        |
| Tel               | `[tel slug placeholder "+1 555 000 0000"]`                   |
| Select            | `[select slug "Option A" "Option B" "Option C"]`             |
| Checkbox          | `[checkbox slug use_label_element "Option"]`                 |
| Submit            | `[submit "Button Label"]` — always inside `.cf7-submit-wrap` |

### 3. Write the CF7 Mail Template

The mail template goes between the `{{-- [CF7 Mail Template] --}}` delimiters.

CF7 mail template format (literal — no HTML):

```
To: [_site_admin_email]
From: [your-name] <[your-email]>
Subject: [_site_title] — Contact: [your-subject]
Reply-To: [your-email]

[your-message]

--
Sent via [_site_title] ([_site_url])
```

**Rules:**

- `To:` line uses `[_site_admin_email]` unless a specific address is required
- `From:` line combines a CF7 name field with a CF7 email field so replies go to the sender
- `Subject:` includes `[_site_title]` for clarity in the inbox
- Body contains the message field; append the site signature line
- No HTML in the mail body (use CF7's Mail (2) tab for HTML confirmation emails)
- No indentation on mail-template field lines (`To:`, `From:`, `Subject:`, `Reply-To:`) for clean copy/paste

### 4. Write the Blade rendering block

Below the comment sections, add the `do_shortcode` call that renders the live CF7 form:

```blade
{!! do_shortcode('[contact-form-7 id="FORM_ID" title="FORM_TITLE"]') !!}
```

- `FORM_ID` — the integer ID from CF7 Admin › Contact Forms (available after saving the form)
- `FORM_TITLE` — the title string you gave the form in CF7 Admin
- Until the form exists in the database, leave `FORM_ID` as the literal placeholder and add a TODO comment directly above the line
- CF7 output contains unescaped HTML — always use `{!! !!}`, never `{{ }}`

### 5. Add spinner CSS to app.css

CF7 renders `[submit "Label"]` as two **sibling** elements:

```html
<input type="submit" class="wpcf7-form-control wpcf7-submit" value="Label" />
<span class="wpcf7-spinner"></span>
```

The `<div class="cf7-submit-wrap">` wrapper from the form template contains both. Apply these styles in `resources/css/app.css`:

```css
/* CF7 submit + spinner */
.cf7-submit-wrap {
  position: relative;
  display: inline-block;
}

.cf7-submit-wrap .wpcf7-spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  margin: 0; /* override CF7 default: margin: 0 0 0 1em */
  pointer-events: none; /* spinner must never block button clicks */
}
```

`position: relative` on the wrapper makes it the positioning context so the absolutely-positioned spinner sits centered over the submit button.

### 6. Prevent duplicate submissions (CSS + JS)

CF7 adds the class `submitting` to `.wpcf7-form` while the AJAX request is in flight. Use that to block re-clicks via CSS, and disable the button in JS so the AJAX call itself cannot fire twice.

**`resources/css/app.css`**

```css
/* CF7 — prevent duplicate submissions */
.wpcf7-form.submitting .wpcf7-submit {
  pointer-events: none;
  opacity: 0.6;
  cursor: not-allowed;
}
```

**`resources/js/app.js`**

```js
// CF7 — prevent duplicate submissions
// Disables the submit button on first click; re-enables if CF7 reports an error.
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.wpcf7').forEach((wrap) => {
    wrap.addEventListener('wpcf7beforesubmit', () => {
      const btn = wrap.querySelector('[type="submit"]');
      if (btn) btn.disabled = true;
    });

    for (const ev of ['wpcf7invalid', 'wpcf7mailfailed', 'wpcf7spam']) {
      wrap.addEventListener(ev, () => {
        const btn = wrap.querySelector('[type="submit"]');
        if (btn) btn.disabled = false;
      });
    }
  });
});
```

- `wpcf7beforesubmit` fires the moment CF7 begins its AJAX call → button is disabled immediately.
- `wpcf7invalid` / `wpcf7mailfailed` / `wpcf7spam` fire when CF7 aborts → button is re-enabled so the user can correct and resubmit.
- On `wpcf7mailsent` the button stays disabled (form is done).

### 7. (Optional) Disable CF7 auto-paragraphs globally

To give the theme full control over form markup and eliminate `<p>` wrappers entirely, add to `app/filters.php`:

```php
add_filter('wpcf7_autop_or_not', '__return_false');
```

### 8. (Optional) Load form template from file via filter

To keep CF7 Admin in sync with the Blade file automatically, extract the raw CF7 tags to a `.cf7` plain-text sidecar file and register a filter in `app/filters.php`. (Blade files cannot be used directly with `file_get_contents` because of Blade compilation.)

**Sidecar file:** `resources/views/forms/{name}.cf7` — contains only the CF7 tag lines from §2, no Blade syntax.

**Filter in `app/filters.php`:**

```php
add_filter('wpcf7_contact_form_properties', function (array $properties, $form): array {
    $map = [
        'Contact Form' => 'contact',
        // 'CF7 Admin Title' => 'blade-file-slug',
    ];

    $slug = $map[$form->title()] ?? null;

    if ($slug === null) {
        return $properties;
    }

    $file = locate_template("resources/views/forms/{$slug}.cf7");

    if ($file && is_readable($file)) {
        $properties['form'] = file_get_contents($file);
    }

    return $properties;
}, 10, 2);
```

### 9. (Optional) Send CF7 submissions to a webhook (CRM/Zapier/etc.)

Use this exact pattern across projects when submissions must be forwarded to an external system.

#### File location

Create `app/cf7-webhook.php` (single responsibility: webhook forwarding).

Then load it from `functions.php` by adding `cf7-webhook` to the registered theme files list.

```php
collect(['setup', 'filters', 'cf7-webhook'])
  ->each(function ($file) {
    if (! locate_template($file = "app/{$file}.php", true, true)) {
      wp_die(
        /* translators: %s is replaced with the relative file path */
        sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
      );
    }
  });
```

#### Canonical webhook implementation (`app/cf7-webhook.php`)

```php
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
    fn ($key) => ! str_starts_with($key, '_'),
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
```

#### Configuration rules

- Do not hardcode webhook URLs in theme code; define `CF7_WEBHOOK_URL` in environment-specific config (e.g., `wp-config.php`)
- Keep `'blocking' => false` so CF7 UX is not delayed by third-party API latency
- Keep `'sslverify' => true` in all environments with valid certificates
- Preserve `_cf7_form_id` and `_cf7_form_title` in payloads for multi-form routing
- If needed, override endpoint per environment via `add_filter('sage/cf7_webhook_url', ...)`

---

## Complete Blade File (canonical template)

```blade
{{-- [CF7 Form Template]
Copy the block below into CF7 Admin › Contact Forms › {Form Title} › Form tab.
No blank lines between fields. No trailing whitespace. [submit] always inside .cf7-submit-wrap.

<div class="cf7-field"><label>Name [text* your-name placeholder "Your name"]</label></div>
<div class="cf7-field"><label>Email [email* your-email placeholder "your@email.com"]</label></div>
<div class="cf7-field"><label>Message [textarea* your-message placeholder "Your message"]</label></div>
<div class="cf7-submit-wrap">[submit "Send"]</div>
[/CF7 Form Template] --}}

{{-- [CF7 Mail Template]
Copy the block below into CF7 Admin › Contact Forms › {Form Title} › Mail tab.

To: [_site_admin_email]
From: [your-name] <[your-email]>
Subject: [_site_title] — New Message
Reply-To: [your-email]

[your-message]

--
Sent via [_site_title] ([_site_url])
[/CF7 Mail Template] --}}

{{-- TODO: replace FORM_ID with the CF7 form ID from WP Admin › Contact Forms --}}
{!! do_shortcode('[contact-form-7 id="FORM_ID" title="Contact Form"]') !!}
```

---

## Key Conventions

| Rule                                | Detail                                                                         |
| ----------------------------------- | ------------------------------------------------------------------------------ |
| No vanilla forms                    | Always CF7 — never `<form action="...">` or Blade form helpers                 |
| One file per form                   | `resources/views/forms/{name}.blade.php`                                       |
| No whitespace in form template      | Explicit HTML wrappers; single line per field; no blank lines                  |
| Spinner wrapper required            | `<div class="cf7-submit-wrap">[submit "..."]</div>` — no exceptions            |
| Spinner CSS location                | `resources/css/app.css` — `.cf7-submit-wrap` + `.wpcf7-spinner` rules          |
| Unescaped output                    | Always `{!! do_shortcode(...) !!}` — never `{{ do_shortcode(...) }}`           |
| Form ID placeholder                 | Use `FORM_ID` literal + TODO comment until WP Admin ID is known                |
| Webhook integration                 | Use `app/cf7-webhook.php` + `wpcf7_mail_sent` + filtered `CF7_WEBHOOK_URL`     |
| `do_shortcode` returns empty string | CF7 plugin must be active; if the form ID is invalid CF7 silently returns `''` |

## Reference

- [CF7 Tag Syntax](https://contactform7.com/docs/tag-syntax/)
- [CF7 Mail Tags](https://contactform7.com/docs/special-mail-tags/)
- Sage forms directory: `resources/views/forms/`
- Example: [assets/contact.blade.php](assets/contact.blade.php)
- Webhook example: `app/cf7-webhook.php`
