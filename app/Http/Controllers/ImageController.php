<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use CustomModel;

    protected $_model=Image::class;
}
