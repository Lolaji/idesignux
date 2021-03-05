<?php

namespace App\Http\Controllers;

use App\Models\ServiceDeliverable;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class ServiceDeliverableController extends Controller
{
    use CustomModel;

    protected $_model=ServiceDeliverable::class;

    protected function _hook(Request $request, $model, $flag) {
        switch($flag){
            case 'beforeDestroy':
                return ['force'=>true, 'id'=>$model];
                break;
        }
    }
}
