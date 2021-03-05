<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class MetadataController extends Controller
{
    use CustomModel;

    protected $_model = Metadata::class;

    protected function _validate_rules() 
    {
        return [
            'name' => 'required|string',
            'content' =>  'required|string'
        ];
    }
}
