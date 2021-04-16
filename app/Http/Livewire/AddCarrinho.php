<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Produto;
use Carrinho;
class AddCarrinho extends Component
{
    public $idx;
   
    public function mount($id): void
    {
        
        $this->idx = $id;
    }

    public function render()
    {
        return view('livewire.add-carrinho');
    }
    public function adicionarAoCarrinho(int $productId): void
    {
        $alpha = Produto::where('id', $productId)->first();
       
        Carrinho::adicionar($alpha->id);
    }
}
