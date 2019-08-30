<div class="form-group @isset($classes['wrapper']) {{ $classes['wrapper'] }} @endisset">
  <div class="custom-control custom-checkbox">
    <input type="hidden" name="{{ $name }}" value="{{ $unckeckedValue }}">
    <input
      type="checkbox"
      class="custom-control-input @isset($classes['input']) {{ $classes['input'] }} @endisset @error($name) is-invalid @enderror"
      name="{{ $name }}"
      id="{{ $name }}_input"
      value="{{$checkedValue}}"
      @if (old($name) !== null)
        @if (old($name))
          checked
        @endif
      @else
        @if (isset($value) && $value)
          checked
        @endif
      @endif
    >
    <label class="custom-control-label @isset($classes['label']) {{ $classes['label'] }} @endisset" for="{{ $name }}_input">{{ $label }}</label>

    @field_errors(['name' => $name])

  </div>
</div>
