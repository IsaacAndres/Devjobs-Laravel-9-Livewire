<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Vacancy;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditVacancy extends Component
{
    use WithFileUploads;

    public $vacancy_id;
    public $title;
    public $company;
    public $category;
    public $last_day;
    public $description;
    public $image;
    public $new_image;

    protected $rules  = [
        'title'         => 'required|string',
        'company'       => 'required',
        'category'      => 'required',
        'last_day'      => 'required|date',
        'description'   => 'required',
        'new_image'     => 'nullable|image|max:1024',
    ];

    public function mount(Vacancy $vacancy)
    {
        $this->vacancy_id   = $vacancy->id;
        $this->title        = $vacancy->title;
        $this->company      = $vacancy->company;
        $this->category     = $vacancy->category_id;
        $this->last_day     = $vacancy->last_day->format('Y-m-d');
        $this->description  = $vacancy->description;
        $this->image        = $vacancy->image;
    }

    public function editVacancy()
    {
        $data = $this->validate();
        
        // store image
        if ( $this->new_image ) {
            $img = $this->new_image->store('public/vacancy');
            $data['image'] = str_replace('public/vacancy/', '', $img);
        }
        $vacancy = Vacancy::find($this->vacancy_id);
        $vacancy->title         = $data['title'];
        $vacancy->company       = $data['company'];
        $vacancy->last_day      = $data['last_day'];
        $vacancy->description   = $data['description'];
        $vacancy->image         = $data['image'] ?? $vacancy->image;
        $vacancy->category_id   = $data['category'];
        $vacancy->save();

        session()->flash('msg', 'La vacante se actualizó correctamente');

        return redirect()->route('vacancy.index');
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.edit-vacancy', compact('categories'));
    }
}
