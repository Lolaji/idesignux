<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use CustomModel;

    protected $_model=Comment::class;
}
