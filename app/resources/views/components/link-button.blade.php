@props([
    'url',
    'bgColor' => 'green',
    'textColor' => 'white',
    'borderColor' => false,
])

<div>
    <a
        href="{{ url($url) }}"
        {{ $attributes->merge(['class' => "font-medium tracking-tight rounded-lg px-4 py-1.5
        hover:bg-$bgColor ring-$bgColor-500 hover:ring-$bgColor-400 bg-$bgColor-500
        bg-$bgColor text-$textColor
        transition ease-in-out
        hover:scale-105 focus:ring-2 ring-offset-2"]) }}
    >{{ $slot }}</a>
</div>