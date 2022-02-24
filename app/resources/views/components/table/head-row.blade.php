@props([
    'orderBy' => null,
])

<div>
    @if ($orderBy)
        <th onclick="yoo('{{ $orderBy }}')" class="text-sm font-medium cursor-pointer text-gray-600 relative">
            <div class="h-full w-5 flex items-center">
                {{ $slot }}
                <i class="fas fa-angle-down fa-xs pl-2"></i>
            </div>
        </th>
    @else
        <th class="text-sm font-medium text-gray-600">{{ $slot }}</th>
    @endif
</div>