<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RestoreAll extends Component
{
    public $model;

    public function mount($model)
    {
        $this->model = $model;
    }

    public function restoreAll()
    {
        $this->model::onlyTrashed()->get()->each->restore();
        $this->emit('refreshLivewireDatatable');
    }

    public function render()
    {
        return <<<'blade'
        <div class="flex justify-center pt-3">
            <button wire:click="restoreAll" class="px-3 py-2 bg-red-600 text-white rounded hover:bg-orange-800 focus:outline-none">Restaurar Todos os Produtos Deletados</button>
        </div>
    blade;
    }
}