{{-- [CF7 Form Template]
Copy the block below into CF7 Admin › Contact Forms › Contact Form › Form tab.
No blank lines between fields. No trailing whitespace. [submit] always inside .cf7-submit-wrap.

<div class="cf7-field"><label>Name [text* your-name placeholder "Your name"]</label></div>
<div class="cf7-field"><label>Email [email* your-email placeholder "your@email.com"]</label></div>
<div class="cf7-field"><label>Subject [text your-subject placeholder "Subject"]</label></div>
<div class="cf7-field"><label>Message [textarea* your-message placeholder "Your message"]</label></div>
<div class="cf7-submit-wrap">[submit "Send"]</div>
[/CF7 Form Template] --}}

{{-- [CF7 Mail Template]
Copy the block below into CF7 Admin › Contact Forms › Contact Form › Mail tab.

To: [_site_admin_email]
From: [your-name] <[your-email]>
Subject: [_site_title] — [your-subject]
Reply-To: [your-email]

[your-message]

---

This is a notification that a contact form was submitted on your website ([_site_title] [_site_url]).

Submitted on: [_date "Y-m-d H:i:s"]
Page: [_url]

{{-- TODO: replace FORM_ID with the CF7 form ID from WP Admin › Contact Forms --}}
{!! do_shortcode('[contact-form-7 id="FORM_ID" title="Contact Form"]') !!}
