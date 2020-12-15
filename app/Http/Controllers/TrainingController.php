<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  //pegang semua request dpd form
use App\Models\Training;

class TrainingController extends Controller
{
    public function index(){

        //$trainings = \App\Models\Training::all();
        $trainings=Training::all();
       // dd($trainings);  //cara debug dump & die
       return view('trainings.index', compact('trainings'));
       //recources/views/trainings/index.blade.php

    }
    
    public function create(){
        return view('trainings.create');
         //recources/views/trainings/create.blade.php
    }
    //
    public function store(Request $request){
        //dd($request->all());
        //store all data from form to training table
        $training=new Training();
        $training->title=$request->title;
        $training->description=$request->description;
        $training->trainer=$request->trainer;
        $training->user_id =auth()->user()->id;
        $training->save();

        return redirect()->back();
        //return to index
        //return view('trainings.store');
         //recources/views/trainings/create.blade.php
    }

}
