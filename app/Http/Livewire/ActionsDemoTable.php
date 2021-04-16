<?php

namespace App\Http\Livewire;

use App\Models\Produto;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class ActionsDemoTable extends LivewireDatatable
{
    public $model = Produto::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')->filterable()->searchable(),

            Column::name('nome_produto')->searchable()->label('Nome do Produto'),

            Column::name('valor_unitario')->truncate()->searchable()->label('Valor Unitário'),

            DateColumn::name('created_at')->filterable()->label('Criado em'),

            Column::callback(['id', 'slug'], function ($id, $name) {
                
                return view('partials.dashboard.tables.table-actions', ['id' => $id, 'name' => $name]);
            })->label('Ações'),
            Column::delete()
        ];
    }
}