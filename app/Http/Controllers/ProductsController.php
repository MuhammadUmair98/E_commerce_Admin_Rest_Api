<?php

namespace App\Http\Controllers;

use App\Models\Marts_Products;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Product_Categories;
use Auth;
use DB;

class ProductsController extends Controller
{
  private $rec;
  private $vue;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.all_products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(){
        $email = Auth::guard('admin')->user()->email;
        $qds=Marts_Products::select('product_id')->where('email',$email)->pluck('product_id');
        $sel = Marts_Products::select('product_id')->where('email',$email)->get();
      
       if(isset($sel)){
       foreach($sel as $sels){
        $ang=Products::select('category')->where('id',$sels->product_id)->first();
        
        
        $this->rec[]=[
            "categories"=>$ang->category
        ];
      
    }

    if($this->rec){
        $cat=array_unique($this->rec,SORT_REGULAR);
   }
   else{
  
       return view('layouts.my_products')->with("err","No Category Left to Show")->with('categorie','');
   }

$categorie= DB::table('Products')->get()->whereIn('id', $qds)->unique('subcategory')->groupBy('category');


return view('layouts.my_products')->with('cat',$cat)->with('categorie',$categorie);  
}
else{
    dd("NOT REGISTERED");
}



 //$myvue[]=
       
 
   
        
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
