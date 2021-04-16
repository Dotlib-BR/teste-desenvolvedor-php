<?php
namespace App\Carrinho;
use Illuminate\Support\Facades\Facade;
class CarrinhoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'carrinho';
    }
}