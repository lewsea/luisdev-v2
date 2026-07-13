---
agent: agent
description: Scaffold a new WordPress custom page template (Blade)
---

Create a new custom WordPress page template for this Sage 11 theme.

## Instructions

1. Create `resources/views/template-${input:name}.blade.php` following the pattern of `template-custom.blade.php`:

```blade
{{--
  Template Name: ${input:label}
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile
@endsection
```

**Rules:**

- The `{{-- Template Name: ... --}}` Blade comment is **required** — WordPress reads it to register the template in the page editor dropdown
- File name must start with `template-` (e.g. `template-landing.blade.php`)
- Always `@extends('layouts.app')` and `@yield('content')` inside `@section('content')`
- Use `@while(have_posts()) @php(the_post())` to loop the WordPress query
- Add a `@section('sidebar')` / `@endsection` block if this template needs a sidebar (the master layout renders it conditionally)
- Use Tailwind utility classes for layout; do not add inline styles

2. If the template needs unique data, create a matching View Composer using the `view-composer` skill and add the template name (e.g. `template-${input:name}`) to its `$views` array.
