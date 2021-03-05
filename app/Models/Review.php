<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable=[
        'firstname',
        'lastname',
        'email',
        'designation',
        'body'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imagable');
    }
}
