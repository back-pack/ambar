{{-- @if ($errors->has($name))
  @foreach ($errors->get($name) as $message)
    <div class="invalid-feedback">{{ $message }}</div>
  @endforeach
@endif --}}
@error ($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
