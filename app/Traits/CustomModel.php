<?php
namespace App\Traits;

use App\Helpers\Arr as HelpersArr;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;


trait CustomModel 
{
    private $__sorts = ['latest', 'oldest', 'inRandomOrder', 'reorder', 'orderBy'];

    private $__response = [];

    protected $_validate_form_on_update = false;

    public function upsert (Request $request, $id = null) 
    {
        $response = ['success'=>false, 'data'=>null, 'message'=>[]];

        // Run $this->_before_validate() method if exist
        if (method_exists($this, '_before_validate')){
            return $this->_before_validate($request, $id);
        }

        if (!is_null($id)) {
            if ($this->_validate_form_on_update){
                if ($this->__validate($request)){
                    return $this->getResponse();
                }
            }
        } else {
            if ($this->__validate($request)){
                return $this->getResponse();
            }
        }

        $cred = $this->__getRequestData($request);

        $model = $this->_model;
        $instance = new $model();
        $operation = "create";
        if (!is_null($id)){
            $operation = "update";
            $instance = $instance->findOrFail($id);
        }

        $this->__callHook($request, $id, "before{$operation}d");
        
        if ($data = $instance->$operation($cred)) {
            $data = ($operation == 'create')? $data : $model::find($id);
            $call_hook_return_data = $this->__callHook($request, $data, "{$operation}d");

            $response['success'] = true;
            $response['operation'] = $operation;
            // if (isset($this->_send_data_with_request_response) && ($this->_send_data_with_request_response == true)) {
                $response['data'] = $data;
            // }
            $response['message'] = "Sucessfully {$operation}d";

            // append data return from $this->_hook() method in the controller
            // to $response variable if not null
            if (! is_null($call_hook_return_data))
                $response['hook'] = $call_hook_return_data;
        } else {
            $response['success'] = false;
            $response['message'] = "Unable to {$operation} due to system error. Please try again.";
        }
        return $response;
    }

    public function upsertByForeign (Request $request, $id, $relationModel, $relationModelId=null)
    {
        $response = ['success'=>false, 'message'=>[]];

        if ($this->__validate($request, true, $relationModel)){
            return $this->getResponse();
        }

        $cred = $this->__getRequestData($request, true, $relationModel);

        $parentModel = $this->_model::findOrFail($id);
        $modelObj = $parentModel->$relationModel();
        $operation = 'create';

        if (!is_null($relationModelId)) {
            $operation = 'update';
            $modelObj->find($relationModelId);
        }
        
        if ($data = $modelObj->$operation($cred)) {
            $data = ($operation == 'create')? $data : $parentModel->$relationModel()->find($relationModelId);
            $call_hook_return_data = $this->__callHook($request, $data, "{$operation}d", true, $relationModel);
            $response['success'] = true;
            $response['data'] = $data;
            $response['operation'] = $operation;
            $response['message'] = ucfirst($relationModel)." {$operation}d successfully.";

            // append data return from $this->_hook() method in the controller
            // to $response variable if not null
            if (! is_null($call_hook_return_data))
                $response['hook'] = $call_hook_return_data;
        } else {
            $response['success'] = true;
            $response['message'] = "Unable to $operation $relationModel due to system error. Please try again.";
        }

        return $response;
    }

    public function deattach (Request $request, $id, $relationship)
    {
        $response = ['success' => false, 'message'=>''];
        $operations = ['detach', 'attach', 'sync', 'syncWithoutDetaching'];

        $operation = $request->post('operation');
        $value = $request->post('value');

        if (in_array($operation, $operations)) {
            $model = $this->_model;
            $instance = (new $model())->findOrFail($id);

            if ($value && (!empty($value) || !is_null($value))) {
                if ($data = $instance->$relationship()->$operation($value)) {
                    
                    $call_hook_return_data = $this->__callHook(
                        $request, 
                        ['instance'=>$instance, 'relationship'=> $relationship, 'data'=>$data], 
                        "{$operation}ed"
                    );

                    $response['success'] = true;
                    $response['operation'] = $operation;
                    $response['data'] = $data;
                    $response['message'] = "{$operation}ed";

                    // append data return from $this->_hook() method in the controller
                    // to $response variable if not null
                    if (! is_null($call_hook_return_data) && !empty($call_hook_return_data))
                        $response['hook'] = $call_hook_return_data;
                } else {
                    $response['success'] = false;
                    $response['message'] = "Unable to {$operation} due to system error.";
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'empty-value';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'invalid-operation-method';
        }
        return $response;
    }

    public function get (Request $request , $id, $relationModel=null)
    {
        $modelObj = $this->_model::findOrFail($id);
        $loadModel = $request->get('load_models');

        if (!is_null($relationModel)) {
            if ($loadModel){
                return $modelObj->$relationModel->load($loadModel);
            }
            return $modelObj->$relationModel;
        }
        
        return $modelObj;
    }

    public function fetch (Request $request)
    {
        $sort = $request->get('sort');
        $where = $request->get('where');
        $fields = $request->get('fields', []);
        $relationship = $request->get('relationship', []);
        $limit = $request->get('limit');
        $offset = $request->get('offset');

        $model = $this->_model;
        $instance = new $model();

        if ($where) {
            $where_decode = json_decode($where);
            if (is_array($where_decode) && HelpersArr::isMulti($where_decode) && !HelpersArr::hasEmptyMulti($where_decode)) {
                $instance = $instance->where($where_decode);
            }
        }

        if (is_array($relationship) && !empty($relationship)) {
            $instance->with($relationship);
        }

        if ($sort) {
            if (is_array($sort) && (count($sort) == 2)) {
                $instance = $instance->orderBy($sort[0], $sort[1]);
            } elseif (is_string($sort)) {
                $instance = $instance->latest($sort);
            }
        }
        
        if (is_numeric($limit)) {
            $instance->limit($limit);
        }

        if (is_numeric($offset)) {
            $instance->offset($limit);
        }

        if (!empty($fields)) {
            return $instance->get($fields);
        }
        return $instance->get();
    }
    
    public function destroy (Request $request, $id)
    {
        // check ',' is in $id parameter
        // if found, expload $id to array
        if (stripos($id, ',')) {
            $id = explode(',', $id);
        }
        
        $bd_hook = $this->__callHook($request, $id, 'beforeDestroyed');

        if (isset($bd_hook['force']) && $bd_hook['force']) {
            return $bd_hook;
        }
        
        if ( $this->_model::destroy($id)) {
            $this->__callHook($request, $id, 'destroyed');
            return 'true';
        }
        return 'false';
    }

    private function __validate (Request $request, $is_relational=false, $relationModelName="")
    {
        $response = ['success'=>false, 'message'=>[]];
        $validate_message = [];

        // check if _validate_rules method exist
        // and do the validation 
        $method = '_validate_rules';
        $message_method = '_validate_message';
        if ($is_relational) {
            $method = "_validate_{$relationModelName}_rules";
            $message_method = "_validate_{$relationModelName}_message";
        }
        
        if ((int) method_exists($this, $method)){

            if ((int) method_exists($this, $message_method)) {
                $validate_message = $this->$message_method();
            }
            
            $validate = Validator::make($request->all(), $this->$method(), $validate_message);

            if ($validate->fails()) {
                $response['success'] = false;
                foreach($request->all() as $key => $value) {
                    $response['message'][$key] = $validate->errors()->first($key);
                }
                $this->setResponse($response);
                return true;
            }
            return false;
        }
    }

    private function __getRequestData(Request $request, $is_relational=false, $relationModelName="")
    {
        $property = ($is_relational)? "_{$relationModelName}_fillable" : "_fillable";
        
        if (isset($this->$property) && !empty($this->$property)) {
            return $request->only($this->$property);
        }
        return $request->all();
    }

    /**
     * Call protected $this->_hook() method
     * defined in controller after successful
     * model create, update or delete
     * 
     * $model : return model
     * 
     * @return void
     */
    private function __callHook (Request $request, $model, $flag='created', $is_relational=false, $relationModelName="")
    {
        $method = ($is_relational)? "_{$relationModelName}_hook" : "_hook";
        if ( (int) method_exists($this, $method) ) {
            return $this->$method($request, $model, $flag);
        }
    }

    protected function _shouldRunValidateFormOnUpdate ()
    {
        
    }

    public function setResponse ($response) 
    {
        $this->__response = $response;
    }

    public function getResponse()
    {
        return $this->__response;
    }
}