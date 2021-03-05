<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use App\Models\Service;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use CustomModel;

    protected $_model = Service::class;

    protected $_fillable = ['title', 'slug','relation', 'description', 'content'];
    protected $_subservice_fillable;
    protected $_milestone_fillable = ['title', 'description'];
    protected $_processes_fillable;

    public function __construct()
    {
        $this->_subservice_fillable = $this->_fillable;
        $this->_processes_fillable = $this->_milestone_fillable;
        $this->_deliverables_fillable = $this->_milestone_fillable;
    }

    protected function _validate_rules ()
    {
        return [
            'title' => 'required|string',
            // 'image' => 'required|string',
            'description' => 'required|string',
            'content' => 'required',
        ];
    }

    protected function _validate_subservice_rules ()
    {
        return $this->_validate_rules();
    }

    protected function _validate_metadatas_rules ()
    {
        return [
            'name' => 'required|string',
            'content' => 'required|string'
        ];
    }

    protected function _validate_milestones_rules ()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }

    protected function _validate_processes_rules ()
    {
        return $this->_validate_milestones_rules();
    }

    protected function _validate_deliverables_rules ()
    {
        return $this->_validate_milestones_rules();
    }

    protected function _hook (Request $request, $model, $flag)
    {
        $response = ['images'=> []];
        switch ($flag) {
            case 'created':
                if ($request->service_id) {
                    Service::find($request->service_id)->subservice()->create(['sub_service_id' => $model->id]);
                }

                if ($data = $model->metadatas()->createMany($request->metadata)) {
                    $response['metadatas'] = $data;
                }

                if ($data = $model->image()->create($request->image)) {
                    $response['image'] = $data;
                }
                break;

            case 'updated': 
                $images = $request->images;
                foreach ($images as $img) {
                    $id = $img['id'] ?? null;

                    if ($data = $model->images()->updateOrCreate(['id' => $id], $img)) {
                        array_push($response['images'], $data);
                    }
                }
                break;

            case 'synced': 
                $instance = $model['instance'];
                $relationship = $model['relationship'];
                $attached_id = $model['data']['attached'];
                $response['attached'] = [];
                
                if (!empty($attached_id))
                    $response['attached'] = $instance->$relationship()->whereIn('portfolio_id', $attached_id)->get();
                
                $response['detached'] = $model['data']['detached'];
                break;

            case 'beforeDestroyed': 
                if (is_array($model)) {
                    array_map(function ($id){
                        $this->__deleteSubservices($id);
                    }, $model);
                } else {
                    $this->__deleteSubservices($model);
                }
                
                break;
        }
        return $response;
    }

    protected function _subservice_hook (Request $request, $model, $flag)
    {
        return $this->_hook($request, $model, $flag);
    }

    public function fetchNavigation()
    {
        return $this->_model::where('relation', 'parent')->get(['title', 'slug']);
    }

    public function saveSelectedPortfolios(Request $request, Service $service)
    {
        $response = ['success' => false, 'message'=>''];
        // return $request->attach;
        if (!empty($request->attach)) {
            if ($portfolios = $service->portfolios()->attach($request->attach)) {
                $response['success'] = true;
                $response['portfolios'] = $portfolios;
                $response['success'] = 'Portfolios added successfully.';
            } else {
                $response['success'] = false;
                $response['success'] = 'Unable to add portfolios due to system error. Please, try again.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'No portfolios selected.';
        }
        return $response;
    }

    private function __deleteSubservices ($id)
    {
        $subservice = Service::find($id)->subservice;
        if (!empty($subservice)){
            foreach ($subservice as $sub) {
                $sub->delete();
            }
        }
    }
}
