@props([
    'icon',
    'url',
])

<a href="{{ $url }}" class="transition ease-in-out delay-25 flex items-center gap-4 rounded-lg {{ Route::current()->uri === $url ? "bg-green-400 hover:bg-green-500" : "hover:bg-gray-100" }} -m-1 p-1">
    <div class="relative h-6 w-6 text-center">
        <i class="fa-solid fa-{{ $icon }} fa-lg"></i>
    </div>
    <span class="text-sm font-medium">{{ $slot }}</span>
</a>