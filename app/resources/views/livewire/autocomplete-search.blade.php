<div class="flex flex-col" wire:keydown.escape="closeDropdown">
    <input type="hidden" name="{{ $form }}" wire:model="selected">
    <input type="text"
        wire:model="content"
        wire:keydown="search"
        placeholder="Digite para pesquisar..."
        class="py-2 px-3 border rounded-lg text-gray-800 w-full
        outline-none focus:border-green-500 transition
        placeholder:text-gray-400 placeholder:italic
    ">
    <div class="relative">
        @if ($results && $isOpen)
            <div class="absolute bg-white rounded-lg w-full mt-2 max-h-56 overflow-auto p-2 shadow-md border border-gray-100">
                @forelse($results as $result)
                    <div wire:click="selected({{ $result->id }})" class="hover:bg-green-500 hover:text-green-900 text-gray-700 transition p-1 rounded-lg cursor-pointer">
                        <span class="select-none text-sm font-medium">
                            {{ $result->listedFormat() }}
                        </span>
                    </div>
                @empty
                    <div class="text-green-900 transition p-1 rounded-lg">
                        <span class="select-none text-sm font-medium">
                            Nenhum resultado encontrado :(
                        </span>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</div>
