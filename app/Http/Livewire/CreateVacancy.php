<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Vacancy;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVacancy extends Component
{
    use WithFileUploads;

    public $title;
    public $company;
    public $category;
    public $last_day;
    public $description;
    public $image;

    protected $rules  = [
        'title'         => 'required|string',
        'company'       => 'required',
        'category'      => 'required',
        'last_day'      => 'required|date',
        'description'   => 'required',
        'image'         => 'nullable|image|max:1024',
    ];

    public function createVacancy()
    {
        $data = $this->validate();
        
        // store image
        if ( $data['image'] ) {
            $img = $this->image->store('public/vacancy');
            $data['image'] = str_replace('public/vacancy/', '', $img);
        }

        // store vacancy
        Vacancy::create([
            'title' => $data['title'],
            'company' => $data['company'],
            'last_day' => $data['last_day'],
            'description' => $data['description'],
            'image' => $data['image'],
            'category_id' => $data['category'],
            'user_id' => auth()->user()->id,
            'published' => now(),
        ]);

        // set message
        session()->flash('msg', 'La vacante se publico correctamente');

        return redirect()->route('vacancy.index');
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.create-vacancy', compact('categories'));
    }
}
