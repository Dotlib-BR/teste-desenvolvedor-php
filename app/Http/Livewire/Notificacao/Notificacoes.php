<?php

namespace App\Http\Livewire\Notificacao;

use Livewire\Component;
use Auth;


class Notificacoes extends Component
{
    public $contador; 

    public function render()
    {
        $contador = Auth::user()->unreadNotifications->count();
        return view('livewire.notificacao.notificacoes');
    }
    
    public function marcarLido(){
        
       
        Auth::user()->unreadNotifications->markAsRead();
    }
}
