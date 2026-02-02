@props(['field'])

@if ($errors->has($field))
  <ul class="form-error-list">
    @foreach ($errors->get($field) as $message)
      <li class="form-error">{{ $message }}</li>
    @endforeach
  </ul>
@endif
