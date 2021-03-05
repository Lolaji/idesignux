<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function viewer()
    {
        return $this->belongsToMany(User::class);
    }

    public function metadatas ()
    {
        return $this->morphMany(Metadata::class, 'metable');
    }

    public function comments ()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function image ()
    {
        return $this->morphOne(Image::class, 'imagable');
    }

    public function tags ()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public static function findBy($where=[], $relationship=[])
    {
        $post = self::where($where)->firstOrFail();

        if (!empty($relationship))
            $post->load($relationship);

        return $post;
    }

    public static function fetch ($relationship=[], $visibility="public")
    {
        $posts = self::where('visibility', $visibility)->latest();

        if (!empty($relationship))
            $posts->with($relationship);

        return $posts->get();
    }

    public static function related($post) 
    {
        if (!is_null($post)) {
            $where = [
                ['id', '!=', $post->id],
                ['category_id', '=', $post->category_id],
                ['visibility', '=', 'public']
            ];
            return self::where($where)
                        ->limit(10)
                        ->with('image')
                        ->latest()
                        ->get();
        }
        return [];
    }

}
