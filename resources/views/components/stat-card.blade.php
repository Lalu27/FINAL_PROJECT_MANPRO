@props(['title', 'value', 'icon', 'color' => 'blue'])

@php
    $colorMap = [
        'blue' => 'bg-blue-50 text-[#004ac6]',
        'amber' => 'bg-amber-50 text-amber-600',
        'green' => 'bg-green-50 text-green-700',
        'red' => 'bg-red-50 text-red-600'
    ];
    $resolvedColor = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex items-center gap-4">
    <div class="p-3 rounded-xl {{ $resolvedColor }}">
        <span class="material-symbols-outlined text-2xl">{{ $icon }}</span>
    </div>
    <div>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $title }}</p>
        <h3 class="text-2xl font-black text-slate-800 mt-0.5">{{ $value }}</h3>
    </div>
</div>