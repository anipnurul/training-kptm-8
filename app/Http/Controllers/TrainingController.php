<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  //pegang semua request dpd form
use App\Models\Training;
use File;
use Storage;
use App\Http\Requests\StoreTrainingRequest;
use Mail;

class TrainingController extends Controller
{
    public function index(Request $request){
       
        if($request->keyword){
            $search = $request->keyword;
            
            $trainings=auth()->user()->trainings()->where('title','LIKE','%'.$search.'%')
            //$trainings = Training::where('title','LIKE','%'.$search.'%')
            ->orWhere ('description','LIKE','%'.$search.'%')
            ->orderBy ('created_at','desc')
            ->paginate(4);

        }else{
        //$trainings = \App\Models\Training::all();
        //$trainings=Training::all();

        //get current auth user
        $user = auth()->user();
        //get user training using relationship with pagination
        $trainings=$user->trainings()->paginate(5);
        }
        //$trainings=Training::paginate(1); //by default 15
       // dd($trainings);  //cara debug dump & die
       return view('trainings.index', compact('trainings'));
       //recources/views/trainings/index.blade.php
       // }
    }
    
    public function create(){
        return view('trainings.create');
         //recources/views/trainings/create.blade.php
    }
    //
    public function store(StoreTrainingRequest $request){
        
        // $validated = $request->validate([
        //     'title' => 'required|min:2',
        //     'description' => 'required|min:2',
        //     'attachment' => 'required|mimes:pdf',
        // ]);
    
        //dd($request->all());
        //store all data from form to training table
        $training=new Training();
        $training->title=$request->title;
        $training->description=$request->description;
        $training->trainer=$request->trainer;
        $training->user_id =auth()->user()->id;
        $training->save();

        if($request->hasFile('attachment')){
           $filename=$training->id.'-'. date("Y-m-d").'.'.$request->attachment->getClientOriginalExtension();
           Storage::disk('public')->put($filename, File::get($request->attachment));
           $training->update(['attachment'=>$filename]);
        }

        //send email to user

        // Mail::send('email.training-created',[
        //     'title'=>$training->title,
        //     'description'=>$training->description
        // ],function($message){

        //     $message->to('nurul860@gmail.com');
        //     $message->subject('Training created Email using Inline Mail');
        // });

        //send email to user using mailable
        //Mail::to('nurul860@gmail.com')->send(new \App\Mail\TrainingCreated($training));

        dispatch(new \App\Jobs\SendEmailJob($training));

        //return redirect()->back();
        return redirect()
        ->route('training:list')
        ->with (
            ['alert-type' => 'alert-primary',
            'alert'=>'Your training saved']);
        //return to index
        //return view('trainings.store');
         //recources/views/trainings/create.blade.php
    }

    public function show(Training $training){
        //find id on table using route
       // $training = Training::find($id);  // klu use laravel model binding x perlu find
        //return to view
        return view('trainings.show', compact('training'));

    }

    public function edit(Training $training){
        // $training = Training::find($id);
        return view('trainings.edit',compact('training'));
        // return redirect()
        // ->route('training:list')
        // ->with (
        //     ['alert-type' => 'alert-success',
        //     'alert'=>'Your training updated']);
    }

    public function update(Training $training, Request $request){
        //find id at table
        //$training = Training::find($id);
        
        //update training with edited attributes
        //method 2 - mass assignment
        $training->update($request->only('title','description','trainer'));
        //return to Trainings
        return redirect()
        ->route('training:list')
        ->with (
            ['alert-type' => 'alert-success',
            'alert'=>'Your training updated']);
        
    }

    public function delete(Training $training){
        if($training->attachment != null){
            Storage::disk('public')->delete($training->attachment);
        }

        $training->delete();

        return redirect()
        ->route('training:list')
        ->with (
        ['alert-type' => 'alert-danger',
        'alert'=>'Your training deleted']);
    }

}
