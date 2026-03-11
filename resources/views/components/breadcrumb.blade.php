@php
    $segments = collect(request()->segments())
        ->reject(fn($s) => is_numeric($s))
        ->values();
@endphp



<div class="text-muted" style="font-size: 14px;">
    <span>
        <a href="{{ url('/') }}" class="crumb-link">Home</a>
    </span>

    @foreach ($segments as $i => $segment)
        @php
            $url = url(implode('/', $segments->take($i + 1)->toArray()));
            $name = ucfirst(str_replace('-', ' ', $segment));
        @endphp

        <span> / </span>

        @if ($loop->last)
            <span class="fw-bold">{{ $name }}</span>
        @else
            <a href="{{ $url }}" class="crumb-link">{{ $name }}</a>
        @endif
    @endforeach
</div>
