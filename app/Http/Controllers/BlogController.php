<?php

namespace App\Http\Controllers;

use App\Events\CommentEvent;
use App\Models\Blog;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use CustomModel;

    protected $_model=Blog::class;

    protected $_fillable = ['user_id', 'slug', 'title', 'description', 'content'];
    protected $_metadatas_fillable = ['name', 'content'];

    protected function _validate_rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string'
        ];
    }

    protected function _validate_metadatas_rules()
    {
        return [
            'name' => 'required|string',
            'content' => 'required|string'
        ];
    }

    protected function _validate_comments_rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string'
        ];
    }

    protected function _comments_hook (Request $request, $model, $flag)
    {
        $response = [];
        switch ($flag) {
            case 'created':
                $comment = $model->load('replies');
                broadcast(new CommentEvent($comment))->toOthers();
                $response['comment'] = $comment;
                break;
        }

        return $response;
    }
}
