<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // protected $guarded=[];

    protected $fillable = [
        'imagable_id',
        'imagable_type',
        'url',
        'data',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'data' => 'object'
    ];

    public function imagable ()
    {
        return $this->morphTo();
    }
}
