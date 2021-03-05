<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use App\Traits\CustomModel;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    use CustomModel;

    protected $_model=MailingList::class;

    protected $_fillable = ['firstname', 'lastname', 'email', 'is_subscribe'];

    protected function _validate_rules()
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email',
        ];
    }

}
