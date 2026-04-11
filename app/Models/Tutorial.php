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

    public function Details()
    {
        return $this->hasMany(TutorDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($tutorial) {
            $slug = Str::slug($tutorial->title);
            $tutorial->url_presentasi = $slug;
            $tutorial->url_final = $slug;
        });
    }
}
