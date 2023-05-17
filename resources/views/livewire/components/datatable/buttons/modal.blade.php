@aware(['component'])

@php
    $theme =$component->getTheme();
@endphp

@if ( $theme === 'bootstrap-4' || $theme === 'bootstrap-5')
<a class="btn border border-secondary text-nowrap {{ $classes ?? ''}}" onclick="livewire.emit('openModal', '{{ $view }}', {{ json_encode(($params) ?? []) }})">
    <span>{{ $text ?? 'Button' }}</span>
</a>
@endif
