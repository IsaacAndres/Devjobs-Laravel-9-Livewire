<?php

namespace App\Http\Livewire;

use App\Models\Vacancy;
use App\Notifications\NewCandidate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApplyVacancy extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacancy;
    protected $rules = ['cv' => 'required|mimes:pdf'];
    
    public function mount(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }

    public function apply()
    {
        $data = $this->validate();

        $cv = $this->cv->store('public/cv');
        $data['cb'] = str_replace('public/cv/', '', $cv);

        $this->vacancy->candidates()->create([
            'user_id' => auth()->user()->id,
            'cv' => $data['cv']            
        ]);

        $this->vacancy->recruiter->notify(new NewCandidate(
            $this->vacancy->id,
            $this->vacancy->title,
            auth()->user()->id
        ));

        session()->flash('msg', 'La postulación fue enviada');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.apply-vacancy');
    }
}
