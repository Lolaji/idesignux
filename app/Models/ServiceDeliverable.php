<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDeliverable extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
}
