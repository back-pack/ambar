<div class="form-group form-check @isset($classes['wrapper']) {{ $classes['wrapper'] }} @endisset">
  <input type="hidden" name="{{ $name }}" value="{{ $unckeckedValue }}">
  <input
    type="checkbox"
    class="form-check-input @isset($classes['input']) {{ $classes['input'] }} @endisset @error($name) is-invalid @enderror"
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
  <label class="form-check-label @isset($classes['label']) {{ $classes['label'] }} @endisset" for="{{ $name }}_input">{{ $label }}</label>
  @endisset
  
  @field_errors(['name' => $name])
</div>
