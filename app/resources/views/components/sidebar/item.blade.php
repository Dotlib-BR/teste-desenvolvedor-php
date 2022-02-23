@props([
    'icon',
    'url',
])

<a href="{{ url($url) }}" class="transition ease-in-out delay-25 flex items-center gap-4 rounded-lg {{ explode("/", Route::current()->uri)[0] === $url ? "bg-green-500 hover:bg-green-400 text-white" : "hover:bg-gray-100" }} -mx-4 px-4 -my-1.5 py-1.5 ">
    <div class="flex h-6 w-6 text-center justify-center items-center">
        <i class="fa-solid fa-{{ $icon }} fa-lg"></i>
    </div>
    <span class="text-sm font-medium">{{ $slot }}</span>
</a>