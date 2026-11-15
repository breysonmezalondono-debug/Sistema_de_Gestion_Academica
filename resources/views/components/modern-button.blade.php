<a href="{{ $href ?? '#' }}"
   class="btn-modern btn-modern-{{ $type ?? 'primary' }} {{ $size === 'sm' ? 'btn-modern-sm' : '' }} {{ $class ?? '' }}"
   {{ $attributes }}>
    @if($icon ?? false)<i class="bi bi-{{ $icon }}"></i>@endif
    {{ $slot }}
</a>
