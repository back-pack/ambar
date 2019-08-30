@if (isset($attributes) && $attributes['type'] == "hidden")
  <input
    name="{{ $name }}"
    @if (isset($value) && !old($name))
      value="{{ $value }}"
    @else
      value="{{ old($name) }}"
    @endif
    @foreach ($attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
  >
@else
  <div class="form-group @isset($classes['wrapper']) {{ $classes['wrapper'] }} @endisset">
    <label for="{{ $name }}_input" class="@isset($classes['label']) {{ $classes['label'] }} @endisset">{{ $label }}</label>
    <input
      class="form-control @isset($classes['input']) {{ $classes['input'] }} @endisset @error($name) is-invalid @enderror"
      name="{{ $name }}"
      id="{{ $name }}_input"
      @if (isset($value) && !old($name))
        value="{{ $value }}"
      @else
        value="{{ old($name) }}"
      @endif
      @isset($attributes)
        @foreach ($attributes as $key => $value)
            {{ $key }}="{{ $value }}"
        @endforeach
      @endisset
    >
    @field_errors(['name' => $name])
  </div>
@endif
