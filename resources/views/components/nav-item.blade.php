<li class="nav-item {{ request()->is($url) || request()->is($url.'/*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ $href}}">{{ $text }}</a>
</li>
