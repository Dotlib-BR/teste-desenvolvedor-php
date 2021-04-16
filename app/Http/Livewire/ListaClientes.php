<?php

namespace App\Http\Livewire;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ListaClientes extends LivewireDatatable
{
    public $model = User::class;

    /* public function builder()
    {
        return User::where('utype','=','USR')->get();
    } */
    public function columns()
    {
        return [
            NumberColumn::name('id')->filterable()->searchable(),
            NumberColumn::name('cpf')->filterable()->searchable()->label('CPF'),
            Column::name('name')->searchable()->label('Nome do Cliente'),

            Column::name('email')->truncate()->searchable()->label('Email'),

            DateColumn::name('created_at')->filterable()->label('Criado em'),
            

            Column::callback(['id'], function ($id) {
                
                return view('partials.dashboard.tables.table-clientes', ['id' => $id]);
            })->label('Ações'),
            Column::delete()
        ];
    }
}

