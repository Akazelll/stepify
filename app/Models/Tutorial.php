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
            if (empty($tutorial->url_presentasi)) {
                $tutorial->url_presentasi = Str::random(10);
            }
            if (empty($tutorial->url_final)) {
                $tutorial->url_final = Str::random(10);
            }
        });
    }
    private static function generateUniqueUrl($column)
    {
        do {
            $url = Str::random(10);
        } while (self::where($column, $url)->exists());

        return $url;
    }
}
