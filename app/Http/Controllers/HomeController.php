<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_Categories;
use App\Models\Products;
use Auth;
use App\Models\Marts_Products;
use DB;
use Session;
class HomeController extends Controller
{
   
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.main_layout');
    }
    public function all()
    {
        $email=Auth::guard('admin')->user()->email;
        $qds=Marts_Products::select('product_id')->where('email',$email)->pluck('product_id');
        $sel = Marts_Products::select('product_id')->where('email',$email)->get();
        
       if(isset($sel)){
       foreach($sel as $sels){
        $ang=Products::select('category')->where('id',$sels->product_id)->first();
        
        
        $this->rec[]=[
            "categories"=>$ang->category
        ];
      
    }

    if(isset($this->rec)){
        $cat=array_unique($this->rec,SORT_REGULAR);
   }
   else{
  
       return view('layouts.my_products')->with("err","No Category Left to Show")->with('categorie','');
   }

$categorie= DB::table('Products')->get()->whereIn('id', $qds)->unique('subcategory')->groupBy('category');
///////////////////////////////////////////////////////////////////////////////////////////////////////////
       }
        return view('layouts.all_products')->with('cat',$cat)->with('categorie',$categorie);
    }
    public function save(Request $request){
     
       
       
       $email=Auth::guard('admin')->user()->email;
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////
       $sql=Marts_Products::where('email',$email)->pluck('product_id')->toArray(); 
       $all_product=DB::table('Products')->whereNotIn('id',$sql)->where('category',$request->category)->where('subcategory',$request->subcategory)->get();
     //dd($sql);
       //Products::where('category',$request->category)->where('subcategory',$request->subcategory)->whereIn('id',$sql);
      if(isset($all_product)){
          Session::put('nopro','There are no products in this category');
          
          return view('layouts.all_products')->with('all_product',$all_product)->with('cat',$cat)->with('categorie',$categorie); 
      }
      else{
      return view('layouts.all_products')->with('all_product',$all_product)->with('cat',$cat)->with('categorie',$categorie); 
      }


      }
    }
    public function addTheProduct($id,$product_price){
     //   $cat =Product_Categories::select('categories')->distinct()->get();
     //   $categorie=Product_Categories::get()->groupBy('categories');
     $email=Auth::guard('admin')->user()->email;
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////
        $check_productId=Marts_Products::where('product_id',$id)->first();
        if(isset($check_productId->product_id)){
            return view('layouts.all_products')->with("Ruc","Product has already been Added")->with('cat',$cat)->with('categorie',$categorie);
        }
        else{
       
        $addtoProducts=new Marts_Products;
        
        $email = Auth::guard('admin')->user()->email;
        $addtoProducts->email=$email;
        $addtoProducts->product_id=$id;
        $addtoProducts->product_quantity="none";
        $addtoProducts->product_price=$product_price;
        $addtoProducts->save();
        return view('layouts.all_products')->with("Rec","Product has been Successfully Added")->with('cat',$cat)->with('categorie',$categorie);
        }    
    }
       
        
       
       

    
}


}