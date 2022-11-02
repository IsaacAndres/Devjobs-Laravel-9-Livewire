<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'vacancy';

    protected $dates = ['last_day'];

    protected $fillable = [
        'title',
        'company',
        'last_day',
        'description',
        'image',
        'category_id',
        'user_id',
        'published',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class)->orderBy('created_at', 'DESC');
    }

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
