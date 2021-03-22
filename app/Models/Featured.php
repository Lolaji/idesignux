<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function featurable ()
    {
        return $this->morphTo();
    }

    public static function Portfolios (...$relationship)
    {
        return self::query()->with('featurable', function (MorphTo $morphTo) use ($relationship) {
            $morphTo->morphWith([
                Portfolio::class => $relationship
            ]);
        })->get();
    }
}
