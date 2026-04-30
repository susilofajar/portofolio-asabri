@props(['icon', 'value', 'label', 'color' => 'blue', 'link' => null])

@php
    $colors = [
        'blue' => ['bg' => 'rgba(0, 41, 102, 0.1)', 'text' => '#002966'],
        'purple' => ['bg' => 'rgba(0, 64, 128, 0.1)', 'text' => '#004080'],
        'green' => ['bg' => 'rgba(212, 175, 55, 0.1)', 'text' => '#D4AF37'],
        'orange' => ['bg' => 'rgba(244, 208, 63, 0.1)', 'text' => '#F4D03F'],
        'red' => ['bg' => 'rgba(211, 47, 47, 0.1)', 'text' => '#D32F2F'],
    ];
@endphp

<div class="stat-card fade-in">
    <div class="icon-box" style="background: {{ $colors[$color]['bg'] }}; color: {{ $colors[$color]['text'] }};">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <div class="label">{{ $label }}</div>
    <h3>{{ $value }}</h3>

    @if($link)
        <div class="mt-3">
            <a href="{{ $link }}" class="btn btn-asabri btn-sm py-1 px-3" style="font-size: 0.75rem;">
                <i class="fas fa-arrow-right"></i> Detail
            </a>
        </div>
    @endif

    {{ $slot }}
</div>