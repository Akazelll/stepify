<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'kode_matkul',
        'url_presentasi',
        'url_final',
        'creator_email',
    ];

    public function details()
    {
        return $this->hasMany(TutorDetail::class, 'tutorial_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($tutorial) {
            if(empty($tutorial->url_presentasi)) {
                $tutorial->url_presentasi = Str::slug($tutorial->title) . '-presentasi';
            }
            if(empty($tutorial->url_final)) {
                $tutorial->url_final = Str::slug($tutorial->title) . '-final';
            }
        });
    }
}
