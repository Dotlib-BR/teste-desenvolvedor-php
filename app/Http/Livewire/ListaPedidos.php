<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ListaPedidos extends LivewireDatatable
{
    public $model = Pedido::class;

    /* public function builder()
    {
        return User::where('utype','=','USR')->get();
    } */
    public function columns()
    {
       
        return [
            NumberColumn::name('id')->filterable()->searchable(),
            NumberColumn::name('identificador')->searchable()->label('Ref.Pedido'),
            Column::name('status_pedido')->searchable()->label('Status Pedido'),
            DateColumn::name('created_at')->filterable()->label('Data'),
            NumberColumn::name('valor_total_pedido')->searchable()->label('Valor'),
            NumberColumn::name('quantidade_total_pedido')->searchable()->label('Quantidade'),
            

            Column::callback(['id'], function ($id) {
                
                return view('partials.dashboard.tables.table-pedidos', ['id' => $id]);
            })->label('Ações'),
            
        ];
    }
}

