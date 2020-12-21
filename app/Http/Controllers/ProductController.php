<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create(){
        return view('products.create');
         //recources/views/products/create.blade.php
    }

    public function store(Request $request){
        //dd($request->all());
        //store all data from form to product table
        $product=new Product();
        $product->name=$request->name;
        $product->description=$request->description;
       // $training->trainer=$request->trainer;
       // $training->user_id =auth()->user()->id;
        $product->save();

        return redirect()->back();
        //return to index
        //return view('products.store');
         //recources/views/products/create.blade.php
    }
    //
}
