<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produto;
Use App\Models\User;
Use App\Models\Voucher;

class Pesquisa extends Component
{
    public $pesquisa;
    public $resultados;
    public $resultadosUser;
    public $resultadosVoucher;
    public $error;
    public function mount(){
        $this->pesquisa ='';
        $this->resultados =[];
        $this->resultadosUser =[];
        $this->resultadosVoucher =[];
        $this->error = 0;
        
        
    }
   
    public function updatedQuery(){
        $pesquisa = '%'.$this->pesquisa.'%';
        $this->resultado = Produto::where('nome_produto','like',$pesquisa)->get()->toArray();
    }
    public function render()
    {
        $pesquisa = '%'.$this->pesquisa.'%';
        $this->resultados = Produto::where('nome_produto','like',$pesquisa)->orWhere('sku','like',$pesquisa)->orWhere('cod_barras','like',$pesquisa)
        ->orWhere('id','like',$pesquisa)->get();
        $this->resultadosUser = User::where('name','like',$pesquisa)->orWhere('email','like',$pesquisa)->orWhere('cpf','like',$pesquisa)
        ->orWhere('id','like',$pesquisa)->get();
        $this->resultadosVoucher = Voucher::where('code','like',$pesquisa)->get();
        return view('livewire.pesquisa');
    }

}
