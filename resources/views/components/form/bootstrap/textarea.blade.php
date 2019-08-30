<div class="form-group @isset($classes['wrapper']) {{ $classes['wrapper'] }} @endisset">
  <label
    for="{{ $name }}_input"
    class="@isset($classes['label']) {{ $classes['label'] }} @endisset"
  >
    {{ $label }}
  </label>
  <textarea
    name="{{ $name }}"
    id="{{ $name }}_input"
    rows="3"
    class="form-control @isset($classes['wrapper']) {{ $classes['wrapper'] }} @endisset @error($name) is-invalid @enderror"
    @isset($attributes)
      @foreach ($attributes as $key => $value)
          {{ $key }}="{{ $value }}"
      @endforeach
    @endisset
  >{{ isset($value) ? $value : '' }}</textarea>
  
  @field_errors(['name' => $name])
</div>
