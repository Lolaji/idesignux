<?php

namespace App\Http\Controllers;

use App\Events\ContactEvent;
use App\Models\Contact;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use CustomModel;

    protected $_model = Contact::class;
    protected $_fillable = ['name', 'email', 'company', 'country', 'phone', 'message', 'read'];
    
    protected function _validate_rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'company' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string',
        ];
    }

    protected function _hook(Request $request, $model, $flag)
    {
        switch($flag){
            case 'created':
                broadcast(new ContactEvent($model));
                return $model;
                break;
        }
    }
}
