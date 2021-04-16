<?php

namespace App\Http\Livewire\Notificacao;

use Livewire\Component;
use Auth;

class Botao extends Component
{
    public $contador;
    public function mount(){
      
        
        
    }
    public function render()
    {
      
            $this->contador = Auth::user()->unreadNotifications->count();
        
      
        return view('livewire.notificacao.botao');
    }

   
}
