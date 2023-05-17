@aware(['component'])

@php
    $theme =$component->getTheme();
@endphp

@if ( $theme === 'bootstrap-4' || $theme === 'bootstrap-5')
<a class="btn border border-secondary text-nowrap {{ $classes ?? ''}}" href="{{ $link }}" {{ (isset($blank) && $blank) ? 'target="_blank"' : '' }}>
    <span>{{ $text ?? 'Link' }}</span>
</a>
@endif
