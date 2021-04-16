<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Carrinho;
use Cart;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Voucher;
use App\Models\User;
use Auth;
use BeyondCode\Vouchers\Exceptions;
use App\Http\Traits\NotificacaoTrait;

class CarrinhoPagina extends Component
{
    use NotificacaoTrait;
    public $carrinho;
    public $qtd = array();
    public $identificador2;
    public $resultado;
    public $somaProduto = array();
    public $cupomInput;
    public $descontex =0;
    public $cupomLogado =0;
    public $checkoutLogado =0;

    public $cpf;
    public $titular;
    public $numero_cartao;
    public $data_expiracao;
    public $data_expiracao_ano;
    public $codigo_seguranca;
    public $abrir =0;
    public $refresh =0;
    public $nota_vendedor =null;
   
  

    public function mount(): void
    {
        $this->carrinho = Carrinho::get();
        
        $rows  = Cart::content();
        if(isset(Auth::user()->cpf)){
            $this->cpf = Auth::user()->cpf;
        }
        $this->data_expiracao =1;
        $this->data_expiracao_ano =1;
        foreach($rows as $obj){
            $idObjz = strval($obj->id);

            $this->qtd[$idObjz] = 0;
        }
        foreach($rows as $obj2){
            $idObjzz = strval($obj2->id);

            $this->somaProduto[$idObjzz] = 0;
        }
    }

    public function render()
    {
        return view('livewire.carrinho');
    }

    
    public function removerDoCarrinho($produtoId): void
    {
        Carrinho::remover($produtoId);
        $this->carrinho = Carrinho::get();
    }
    public function atualizaProdutoQtdSubt($idpro) :void{

       
        $prodIdx = Produto::find($idpro);
        
        $idProd2 = strval($prodIdx->id);
       
        $rows  = Cart::content();
        $rowId = $rows->where('id', $idProd2)->first()->rowId;
        $objProduto = $rows->where('id', $idProd2)->first();
        
        $idProd2x = strval($objProduto->id);
        $this->qtd[$idProd2x] = (int)$this->identificador2;
     
        Cart::update($rowId,$this->qtd[$idProd2x]);
        
        $this->resultado = $objProduto->price * $objProduto->qty;
        $this->somaProduto[$idpro] = $this->resultado;
       

    }
    public function aplicarCupomCheck($id){
        if($id ===1){
            $this->cupomLogado = 1;
        }
        if($id ===0){
            $this->checkoutLogado = 1;
        }
       
       
    }

    public function aplicarCupom(){
      
        $cupom = Voucher::where('code','=',$this->cupomInput)->first();
        if(!is_null($cupom)){
            $produtoCupom =Produto::find($cupom->model_id);
           
            if(!is_null($produtoCupom)){
                $rows  = Cart::content();
                $rowId = $rows->where('id', $produtoCupom->id)->first();
                
                
                if(!is_null($rowId)){
                    $rowId = $rows->where('id', $produtoCupom->id)->first()->rowId;
                    $objProduto = $rows->where('id', $produtoCupom->id)->first();
                    $porcentagem = json_decode($cupom->data);
                    
                    
                    $voucher = false;
                    
                    try{
                        $this->descontex = 1;
                        $voucher = Auth::user()->redeemCode($this->cupomInput);
                        
                        Cart::setDiscount($rowId, $porcentagem->desconto_porcentagem);
                        
                      return session()->flash('message', 'Cupom Aplicado!');
                      

                    }catch(\Exception $ex){
                        return session()->flash('error', $ex->getMessage());
                    }

                     
                }else{
                   
                    session()->flash('message', 'Cupom Válido mas produto não adicionado ao carrinho!');
                }
              
            }else{
                session()->flash('message', 'Produto não localizado para aplicação deste cupom');
            }
        }else{
            session()->flash('message', 'Cupom Inválido!');
        }
    
   
    }
    
    public function checkout() 
    {
       
       $this->validate([
            'cpf' => 'required|cpf|unique:users,cpf,'. Auth::user()->id,
            'titular' =>'required|max:100',
            'numero_cartao' => 'required|integer|min:3',
            'data_expiracao' =>'required|integer',
            'data_expiracao_ano' =>'required|integer',
            'codigo_seguranca' =>'required|regex:/[0-9]+/|between:0,3'
        ]);
        $subject="Lojinha - Notificação do Sistema";
        $thanks ="-";
       if($this->numero_cartao ==='4242424242424242'){
        $rows  = Cart::content();
        if($rows >'0'){
           
            $pedido  = new Pedido();
            $pedido->identificador = uniqid();
            $pedido->user_id =  Auth::user()->id;
            $usuario = User::find(Auth::user()->id);
            if($usuario->cpf != $this->cpf){
                $usuario->cpf = $this->cpf;
                $usuario->save();
            }
            if(!is_null($this->nota_vendedor)){
                $pedido->nota_vendedor =  $this->nota_vendedor;
            }
            $pedido->status_pedido ='pendente';
            $pedido->status_compra ='aprovada';
            $pedido->valor_total_pedido = Cart::total();
            $pedido->subtotal_pedido = Cart::priceTotal();
            $descontos = Cart::discount();
            if($descontos >0){
                $pedido->desconto_total_pedido = Cart::discount();
            }else{
                $pedido->desconto_total_pedido = 0;
            }
            $pedido->quantidade_total_pedido = Cart::count();
            $containers = [];
            $pedido->save();
            foreach($rows as $row){
                
                $idP = (int)$row->id;
                
                $pedidoP =  new PedidoProduto;
                $produtoP = Produto::find($idP);
                    $pedidoP->pedido_id = $pedido->getKey();
                    $pedidoP->produto_id =  $idP;
                    $pedidoP->quantidade_total = $row->qty;
                    $pedidoP->valor_comprado = $row->price;
                    $pedidoP->save();
                    $produtoP->quantidade_estoque = $produtoP->quantidade_estoque - $row->qty;
                    $produtoP->save();
 }
        //    $pedido->pedidoProduto()->saveMany($containers);
            Carrinho::limpar();
            Cart::destroy();
            $this->carrinho = Carrinho::get();
            
            $this->refresh = 1;
            $aprovado ='aprovado';
           
            $greeting ="Nova Compra Efetuada no sistema";
            $body ="Sua compra foi aprovada. Seu pedido encontra-se em processamento";
            if(Auth::user()->utype==="ADM"){
                $this->notificacoesBase($subject,$greeting,$body,$thanks,Auth::user()->id);
            }else{
                $admins = User::where('utype','=','ADM');
               
                foreach($admins as $adm){
                    $this->notificacoesBase($subject,$greeting,$body,$thanks,$adm->id);
                }
                 $this->notificacoesBase($subject,$greeting,$body,$thanks,Auth::user()->id);
            }
            
            return redirect()->route('checkoutStatus',$aprovado);
        } 
       }else{
           $reprovado ='reprovado';
           $greeting ="Tentativa de compra detectada";
           $body ="Sua compra não foi aprovada. Reveja seu método de pagamento";
           if(Auth::user()->utype==="ADM"){
            $this->notificacoesBase($subject,$greeting,$body,$thanks,Auth::user()->id);
        }else{
            $admins = User::where('utype','=','ADM');
            foreach($admins as $adm){
                $this->notificacoesBase($subject,$greeting,$body,$thanks,$adm->id);
            }
             $this->notificacoesBase($subject,$greeting,$body,$thanks,Auth::user()->id);
        }
          
        return redirect()->route('checkoutStatus',$reprovado);
       }
       
        
    }



}
