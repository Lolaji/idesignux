<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    use CustomModel;

    protected $_model=Portfolio::class;
    protected $_fillable = ['title', 'slug', 'description', 'content', 'challenge', 'solution', 'result', 'tech_stack', 'settings', 'url'];
    protected $_metadatas_fillable = ['name', 'content'];

    protected function _validate_rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string'
        ];
    }

    protected function _validate_metadatas_rules ()
    {
        return [
            'name' => 'required|string',
            'content' => 'required|string'
        ];
    }

    protected function _hook (Request $request, $model, $flag)
    {
        $response=['images'=>[]];
        switch($flag){
            case 'created':
                $metadatas = $request->metadatas;
                $images = $request->images;

                if (!empty($metadatas)){
                    if ($data = $model->metadatas()->createMany($metadatas)) {
                        $response['metadata'] = $data;
                    }
                }

                if (!empty($images)){
                    if ($data = $model->images()->createMany($images)) {
                        $response['images'] = $data;
                    }
                }
                break;

            case 'updated': 
                $images = $request->images;
                
                if (!empty($images)){
                    foreach ($images as $img) {
                        $id = $img['id'] ?? null;

                        if ($data = $model->images()->updateOrCreate(['id' => $id], $img)) {
                            array_push($response['images'], $data);
                        }
                    }
                }
                break;

            case 'beforeDestroyed':
                if (is_array($model)){
                    foreach($model as $key => $id) {
                        Portfolio::find($id)->images()->delete();
                    }
                } else {
                    Portfolio::find($model)->images()->delete();
                }
                break;
        }
        return $response;
    }

    public function _feature_hook (Request $request, $model, $flag)
    {
        switch($flag){
            case 'created':
                $model->featurable;
                return $model;
                break;
        }
    }

    private function __createImage($model, array $img) 
    {
        if ($data = $model->images()->createMany($img)) {
            return $data;
        }
    }
}
