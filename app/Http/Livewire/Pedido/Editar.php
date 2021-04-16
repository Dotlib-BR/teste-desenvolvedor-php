<?php

namespace App\Http\Livewire\Pedido;

use Livewire\Component;
use App\Http\Traits\NotificacaoTrait;
use Auth;
use App\Models\Pedido;
use App\Models\User;

class Editar extends Component
{
    use NotificacaoTrait;
    public $processando;
    public $cancelado;
    public $concluido;
    public $modelo;
    public $idP;
    public  $pedido;

    public function mount($id)
    {
        $this->idP = $id;
        $this->pedido = Pedido::find($this->idP);
    }
    public function render()
    {
        return view('livewire.pedido.editar');
    }
    public function editarPedido($pedido){
        $pedidoP = Pedido::find($pedido);

        
        $usuarioP = User::find($pedidoP->user_id);
      
        if($pedidoP){
           
            $subject="Lojinha - Notificação do Sistema";
            $thanks ="-";
            
            
            switch ($this->modelo) {
                case 1:
                    $pedidoP->status_pedido = "completo";
                    $pedidoP->save();
                    $greeting ="Pedido: ".$pedidoP->identificador." - Seu pedido foi finalizado.";
                    $body ="Pedido: ".$pedidoP->identificador." - Seu pedido foi finalizado.";
                    $this->notificacoesBase($subject,$greeting,$body,$thanks,$usuarioP->id);
                    break;
                case 2:
                    $pedidoP->status_pedido = "pendente";
                    $pedidoP->save();
                    $greeting ="Pedido: ".$pedidoP->identificador." - O seu pedido está sendo processado.";
                    $body ="Pedido: ".$pedidoP->identificador." - O seu pedido está sendo processado.";
                    $this->notificacoesBase($subject,$greeting,$body,$thanks,$usuarioP->id);
                    break;
                case 3:
                    $pedidoP->status_pedido = "cancelado";
                    $pedidoP->save();
                    $greeting = "Pedido: ".$pedidoP->identificador." - O seu pedido foi cancelado";
                    $body ="Pedido: ".$pedidoP->identificador." - O seu pedido foi cancelado";
                    $this->notificacoesBase($subject,$greeting,$body,$thanks,$usuarioP->id);
                    break;
                default:
                    
                    break;
             }
           
        
            
        }
        
    }



}
