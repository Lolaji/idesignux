<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use CustomModel;

    protected $_model = Tag::class;

    protected $_fillable = ['title', 'description'];

    protected function _validate_rules ()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }
}
