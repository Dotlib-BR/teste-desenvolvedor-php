@props([
    'searchable' => false,
    'pagination'
])

<div class="border border-gray-200 rounded-lg">
    <div class="bg-white w-full p-2  rounded-t-lg flex justify-end border-b border-gray-200">
        @if ($searchable)    
            <div class="relative w-full md:w-auto">
                <div class="absolute flex justify-center items-center w-9 h-9 ">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
                <input type="text" placeholder="Pesquisa"
                    class="h-9 pl-9 border rounded-lg placeholder:text-slate-400 w-full
                    transition-all
                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
            </div>
        @else
            <div class="w-full h-9 p-2">

            </div>
        @endif
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white min-w-max overflow-x-auto">
            <thead>
                <tr class="bg-gray-50 text-left">
                    {{ $header }}
                </tr>
            </thead>
                <tbody>
                    {{ $body }}
                </tbody>
        </table>
    </div>
    <div class="bg-white w-full p-2 rounded-b-lg flex justify-end border-t border-gray-200">
        <div class="flex justify-between">
        </div>
    </div>

    <style>
        thead > tr {
            background-color: #F9FAFB;
        }
        
        th, td {
            padding: 0.5rem 1rem;
            border-width: 1px 0;
            border-color: #e5e7eb;
            text-align: start;
        }
    </style>
</div>
