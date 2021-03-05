<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CustomModel;

    protected $_model = Category::class;

    protected $_fillable = ['title', 'description'];

    protected function _validate_rules ()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }
}
