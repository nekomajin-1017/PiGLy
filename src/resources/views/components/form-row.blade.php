@props(['label', 'field', 'required' => false, 'id' => null])

<div class="form-row">
  <label class="form-label" for="{{ $id ?? $field }}">
    {{ $label }}
    @if ($required)
      <span class="required">必須</span>
    @endif
  </label>
  {{ $slot }}
  <x-form-error field="{{ $field }}" />
</div>
