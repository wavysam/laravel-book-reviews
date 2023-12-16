@props(['field'])

@error($field)
    <p class="text-red-500">{{ $message }}</p>
@enderror
