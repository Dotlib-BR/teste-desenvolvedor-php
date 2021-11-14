<?php


namespace App\Repository;

use App\Models\TipoContratacao;

class TipoContratacaoRepository
{

    public function __construct(public TipoContratacao $model){}

    public function getListaTipoContratacao(){
        try{
            return $this->model::all();
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }
}
