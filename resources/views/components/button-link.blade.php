@props(['href', 'variant' => 'primary'])

@php
    $classes = $variant === 'secondary'
        ? 'inline-flex items-center rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm font-medium text-zinc-800 hover:bg-zinc-50'
        : 'inline-flex items-center rounded-md bg-zinc-950 px-3 py-2 text-sm font-medium text-white hover:bg-zinc-800';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
