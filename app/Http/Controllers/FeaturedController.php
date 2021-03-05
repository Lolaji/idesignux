<?php

namespace App\Http\Controllers;

use App\Models\Featured;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    use CustomModel;

    protected $_model = Featured::class;
}
