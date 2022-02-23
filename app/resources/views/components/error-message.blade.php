@props(['for'])

<div>
    @error($for)
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>