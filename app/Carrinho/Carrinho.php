<?php

namespace App\Carrinho;

use App\Models\Produto;
use Cart;
class Carrinho
{
    public function __construct()
    {
        if($this->get() === null)
            $this->set($this->vazio());
    }

    public function adicionar(int $produto): void
    {
      /*$carrinho = $this->get();   
      $produto = Produto::find($id);
       
        array_push($carrinho['produtos'], $produto);
        $this->set($carrinho);
        dd($carrinho); */
    
        $carrinho = $this->get();
        $produto =Produto::where('id', $produto)->first();
     
        array_push($carrinho['produtos'], $produto);
      
        $idProduto = strval($produto->id);
       
        if(!is_null($produto->imagem)){
            $imagem = $produto->imagem;
        }else{
            $imagem="indisponivel.png";
        }
       
        if(!is_null($produto->preco_promocional)){
            
            Cart::add($idProduto, $produto->nome_produto,1, $produto->preco_promocional, 0,['size' => $imagem]);
           
        }else{
            Cart::add($idProduto, $produto->nome_produto,1, $produto->valor_unitario, 0,['size' => $imagem]);
       
        }
             
       
        $this->set($carrinho);
    }

    public function remover(int $produtoId): void
    {
        
        $carrinho = $this->get();
        $prod = Produto::find($produtoId);
        
        $idProd = strval($prod->id);
        $rows  = Cart::content();
        $rowId = $rows->where('id', $idProd)->first()->rowId;
        Cart::remove($rowId);
        array_splice($carrinho['produtos'], array_search($produtoId, array_column($carrinho['produtos'], 'id')), 1);
        $this->set($carrinho);
    }

    public function limpar(): void
    {
        $this->set($this->vazio());
    }

    public function vazio(): array
    {
        return [
            'produtos' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('carrinho');
    }

    private function set($carrinho): void
    {
        request()->session()->put('carrinho', $carrinho);
    }

  
    public function teste()
    {
        echo "Jesus!";
    }
}