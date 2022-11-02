<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use stdClass;

class CandidateController extends Controller
{
    
    public function index(Vacancy $vacancy)
    {
        return view('candidates.index', compact('vacancy'));
    }    
}
