<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CustomModel;

    protected $_model = User::class;

    protected $_fillable = ['name', 'email', 'password'];
    protected $_posts_fillable = ['user_id', 'category_id', 'slug', 'title', 'visibility', 'description', 'content'];

    protected function _validate_posts_rules()
    {
        return [
            'title' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'content' => 'required|string'
        ];
    }

    protected function _validate_posts_message ()
    {
        return [
            'category_id.required' => 'The category field is required'
        ];
    }

    protected function _posts_hook(Request $request, $model, $flag)
    {
        $response=[];
        switch($flag) {
            case 'created':
                $cred = $request->metadatas;
                $tags = $request->tags;
                
                if ($data = $model->metadatas()->createMany($cred)) {
                    $response['metadatas'] = $data;
                }

                if (!empty($tags)) {
                    if ($data = $model->tags()->attach($tags)) {
                        $response['tags'] = $data;
                    }
                }

                if (!is_null($request->image)) {
                    if ($data = $model->image()->create(['url' => $request->image['url']])) {
                        $response['image'] = $data;
                    }
                }
                break;

            case 'updated':
                // $response['detach_tags'] = $request->detach_tags;
                // $response['attach_tags'] = $request->attach_tags;

                // if (!empty($request->detach_tags)) {
                //     $response['detached'] = $model->tags()->detach($request->detach_tags);
                // }

                if (!empty($request->tags)) {
                    $response['tags'] = $model->tags()->sync($request->tags);
                }

                if (!is_null($request->image) && ($request->image['url'] != $model->image->url)) {
                    $operation = (!is_null ($request->image['id']))? 'update' : 'create';
                    if ($data = $model->image()->$operation(['url'=>$request->image['url']])) {
                        $response['image'] = $data;
                    }
                }
                break;
        }
        return $response;
    }

    private function __addTags($model, array $tags)
    {
        if ($data = $model->tags()->attach($tags)) {
            return $data;
        }
    }

}
