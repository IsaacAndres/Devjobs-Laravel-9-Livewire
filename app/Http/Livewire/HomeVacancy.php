<?php

namespace App\Http\Livewire;

use App\Models\Vacancy;
use Livewire\Component;

class HomeVacancy extends Component
{
    public $search;
    public $category;

    protected $listeners = ['searchData' => 'search'];

    public function search($word, $category)
    {
        $this->search = $word;
        $this->category = $category;
    }

    public function render()
    {
        
        $vacancies = Vacancy::when($this->search, function($query) {
            $query->where('title', 'LIKE', "%$this->search%");
        })
        ->when($this->search, function($query) {
            $query->orWhere('company', 'LIKE', "%$this->search%");
        })
        ->when($this->category, function($query) {
            $query->where('category_id', $this->category);
        })
        ->paginate(10);
        
        return view('livewire.home-vacancy', compact('vacancies'));
    }
}
