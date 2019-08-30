<div class="form-group @isset($classes['wrapper']) {{ $classes['wrapper'] }} @endisset">
  @if (isset($label))
    <label
      for="{{ $name }}_input"
      class="@isset($classes['label']) {{ $classes['label'] }} @endisset"
    >
      {{ $label }}
    </label>
  @endif
  <select
    class="custom-select @isset($classes['select']) {{ $classes['select'] }} @endisset @error($name) is-invalid @enderror"
    name="{{ $name }}"
    id="{{ $name }}_input"
    @isset($attributes)
      @foreach ($attributes as $key => $value)
          {{ $key }}="{{ $value }}"
      @endforeach
    @endisset
  >
    @foreach ($options as $option)
      <option
        value="{{ $option[0] }}"
        @if(isset($value) && !old($name))
          @if($value == $option[0])
            selected
          @endif
        @else
          @if(old($name) == $option[0])
            selected
          @endif
        @endif
      >
        {{ $option[1] }}
      </option>
    @endforeach

    @field_errors(['name' => $name])
  <select>
</div>
