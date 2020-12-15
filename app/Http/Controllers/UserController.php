<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $users = \App\Models\User::all();
       // dd($trainings);  //cara debug dump & die
       return view('users.index', compact('users'));
       //recources/views/trainings/index.blade.php

    }
    //
}
