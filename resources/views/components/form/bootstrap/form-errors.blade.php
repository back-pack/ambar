@if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif
{{-- @if ($errors->has('exists'))
    <div class="alert alert-info">{{ $errors->first('exists') }} Puedes editarlo <a href="{{ route('reports.edit', ['id' => session('exists_id')]) }}">aqui</a></div>
@endif --}}
