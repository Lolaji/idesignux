<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    use CustomModel;

    protected $_model=Preference::class;

    protected $_fillable = ['settings'];


}
