<a class="dropdown-item {{ request()->is($url) || request()->is($url.'/*') ? 'active' : '' }}" href="{{ $href }}">{{ $text }}</a>
