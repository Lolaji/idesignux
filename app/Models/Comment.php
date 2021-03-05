<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function posts (...$relationship)
    {
        return $this->query()->with('commentable', function (MorphTo $morphTo) use ($relationship) {
            $morphTo->morphWith([
                Blog::class => $relationship
            ]);
        })->get();
    }

    public function replies ()
    {
        return $this->hasMany(CommentReply::class);
    }
}
