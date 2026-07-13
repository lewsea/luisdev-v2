@props([
  'title' => null,
  {{-- Add more props with defaults here --}}
])

<div {{ $attributes->merge(['class' => '']) }}>
  @if ($title)
    <h2>{{ $title }}</h2>
  @endif

  {{ $slot }}
</div>
