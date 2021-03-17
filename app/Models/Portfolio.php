<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $casts = [
        'challenge' => 'object',
        'solution' => 'object',
        'result' => 'object',
        'setting' => 'object'
    ];

    public function metadatas ()
    {
        return $this->morphMany(Metadata::class, 'metable');
    }

    public function feature () 
    {
        return $this->morphOne(Featured::class, 'featurable');
    }

    public function images ()
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function services ()
    {
        return $this->belongsToMany(Service::class, 'service_portfolios');
    }
}
