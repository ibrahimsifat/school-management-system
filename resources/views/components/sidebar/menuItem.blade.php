@props(['path' => 'false', 'text', 'url', 'iconText'])
<li class="nav-item ">
    <a href="{{ url($url) }}" class="nav-link @if ($path == $url) active @endif">
        <i class="nav-icon {{ $iconText }}"></i>
        <p>
            {{ $text }}
        </p>
    </a>
</li>
