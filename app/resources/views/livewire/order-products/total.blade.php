<div>
    <x-card>
        <span for="created_at" class="text-sm font-medium text-gray-700">Total</span>
        @isset($products)
        <div class="flex w-full justify-end flex-col px-4">
            @foreach($products as $product)
            <span class=" text-slate-700 text-right font-medium">
                {{ App\Services\HelperService::numberToMoney($product->product->price * $product->quantity) }}
            </span>
            @endforeach
            <div class="flex justify-end flex-col">
                @if ($discount)
                    <div class="text-right flex gap-2 justify-end flex-row">
                        @if($discount->value_off)
                            <span class="bg-red-200 text-red-900 font-medium rounded-lg px-1">
                                - {{ App\Services\HelperService::numberToMoney($discount->value_off) }}
                            </span>
                        @endif
                        @if($discount->percent_off)
                            <div>
                                <span class="bg-red-200 text-red-900 font-medium rounded-lg px-1">
                                - {{ $discount->percent_off }}%
                                </span>
                            </div>
                        @endif
                        <div>
                            <span class="text-gray-400 line-through">{{ App\Services\HelperService::numberToMoney($order->totalValue) }}</span>
                        </div>
                    </div>
                @endif
                <div class="border-t border-slate-300 mt-1 ml-20"></div>
                <span class="tracking-tight text-green-600 text-right text-2xl font-bold ">
                    {{ App\Services\HelperService::numberToMoney($order->totalDiscounted) }}
                </span>
            </div>
        </div>
        @else
        <span for="created_at" class="text-sm font-medium text-slate-500 my-2">Nenhum produto adicionado ao pedido.</span>

        @endisset
    </x-card>
</div>