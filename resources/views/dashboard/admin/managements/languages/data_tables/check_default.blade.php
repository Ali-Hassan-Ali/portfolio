<div class="flex items-center gap-2">

    <input class="kt-switch kt-switch-sm checkbox default" id="default-{{ $language->id }}" data-id="{{ $language->id }}" type="checkbox" name="id" value="{{ $language->id }}" {{ $language->default ? 'disabled' : '' }} {{ $language->default ? 'checked' : '' }}>

</div>