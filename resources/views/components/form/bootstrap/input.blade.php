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
    <div class="input-group">
      @isset($input_group_prepend_text)
        <div class="input-group-prepend">
          @foreach ($input_group_prepend_text as $text)
              <div class="input-group-text">{{ $text }}</div>
          @endforeach
        </div>
      @endisset
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
      @isset($input_group_append_text)
        <div class="input-group-append">
          @foreach ($input_group_append_text as $text)
              <div class="input-group-text">{{ $text }}</div>
          @endforeach
        </div>
      @endisset
    </div>
    @field_errors(['name' => $name])
  </div>
@endif
