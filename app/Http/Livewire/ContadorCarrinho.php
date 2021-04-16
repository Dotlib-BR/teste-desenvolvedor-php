<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carrinho;

class ContadorCarrinho extends Component
{
    public $carrinho;
    

    public function mount(): void
    {
        $this->carrinho = Carrinho::get();
      
    }
    
    public function render()
    {
        return view('livewire.contador-carrinho');
    }
}
