<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    //get user list
    public function list(){

        $data['getRecord'] = User::getRecord();
        return view('admin.user.list',$data);


    }
}
