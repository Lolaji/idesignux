<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use CustomModel;

    protected $_model = Review::class;

    protected function _validate_rules()
    {
        return [
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'email' => 'string|required',
            'designation' => 'string|required',
            'body' => 'string|required',
        ];
    }

    protected function _hook (Request $request, $model, $flag)
    {
        $response = [];

        switch($flag){
            case 'created':
                $image = $request->image;
                if (isset($image) && !empty($image)){
                    if ($data = $model->images()->createMany($image)) {
                        $response['images'] = $data;
                    }
                }
                break;

            case 'updated':

                break;
        }

        return $response;
    }
}
