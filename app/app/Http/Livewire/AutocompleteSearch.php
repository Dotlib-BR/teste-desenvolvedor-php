<?php

namespace App\Http\Livewire;

use App\Contracts\AdvancedSearchable;
use Exception;
use Livewire\Component;

class AutocompleteSearch extends Component
{
    public ?string $query = null;
    public $results;
    public $model;
    public $content;
    public $isOpen;

    public ?string $form = null;

    public function mount($model, $form = null)
    {
        $isAdvancedSearchable = array_key_exists(AdvancedSearchable::class, class_implements($model));
        if (! $isAdvancedSearchable) {
            throw new Exception("$model does not implements ".AdvancedSearchable::class);
        }
        $this->model = $model;
        $this->isOpen = false;
        $this->form = $form;
    }
    
    public function search()
    {
        $this->query = $this->content;
        $this->results = $this->model::advancedSearch($this->query)->get();
        $this->isOpen = true;
    }
    
    public function selected($id)
    {
        $selected = $this->model::find($id);
        $this->emitUp('selected', $selected);
        $this->dispatchBrowserEvent('selected', $id);
        $this->isOpen = false;
        $this->content = $selected->displayResultFormat();
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.autocomplete-search');
    }
}
