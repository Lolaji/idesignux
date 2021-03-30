<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $casts = [
        'settings' => 'object'
    ];

    public static function settings (string $name)
    {
        return self::where('name', $name)->first();
    }
}
