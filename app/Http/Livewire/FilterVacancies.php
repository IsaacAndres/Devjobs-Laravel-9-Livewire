<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class FilterVacancies extends Component
{
    public $search;
    public $category;

    public function readFormData()
    {
        $this->emit('searchData', $this->search, $this->category);
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.filter-vacancies', compact(
            'categories',
        ));
    }
}
