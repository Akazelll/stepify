<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TutorDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutorial_id',
        'text',
        'code',
        'image',
        'url',
        'order',
        'status',
    ];

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }
}
