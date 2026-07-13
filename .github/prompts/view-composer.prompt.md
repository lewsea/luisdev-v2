---
agent: agent
description: Scaffold a new View Composer class that passes data to Blade templates
---

Create a new View Composer for this Sage 11 theme.

## Instructions

1. Create `app/View/Composers/${input:name}.php` following the pattern of existing composers (`App.php`, `Post.php`, `Comments.php`):

```php
<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ${input:name} extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        // e.g. 'partials.my-partial', 'sections.my-section', 'partials.content-*'
    ];

    // Each public method becomes a variable available in the matched templates.
    // Example:
    public function items(): array
    {
        return [];
    }
}
```

**Rules:**

- Namespace must be `App\View\Composers`
- Extend `Roots\Acorn\View\Composer` (from `roots/acorn`)
- `$views` is an array of dot-notation view names matching `resources/views/` paths (wildcards with `*` are supported)
- Every **public method** is automatically exposed as a template variable (the method name becomes the variable name)
- No registration step needed — Acorn auto-discovers composers in `app/View/Composers/`

2. The variables become available in matched Blade templates automatically:

```blade
{{-- In the matched partial/section --}}
@foreach($items as $item)
  ...
@endforeach
```
