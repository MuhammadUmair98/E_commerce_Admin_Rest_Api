<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Marts_Products;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product_Categories;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class MartsProductsController extends Controller
{
    private $check=true;
    private $prName;
    private $rec;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $email=Auth::guard('admin')->user()->email;
        
      
        $getProduct=Products::where('category',$request->category)->where('subcategory',$request->subcategory)->get();
        $savedProduct = Marts_Products::where('email',$email)->get();
        foreach($getProduct as $getproducts){
            foreach($savedProduct as $savedProducts){
               
           if($getproducts->id == $savedProducts->product_id){
             
              $this->check=false;
             
           } 
           
        }

        }
        
      
        //$check = Marts_Products::where('category',$request->category)->where('subcategory',$request->subcategory)->where('email',$email)->first();
        if($this->check){
        foreach( $getProduct as  $getProducts){
        $data[] =[
            'email' => $email,
            'product_id' => $getProducts->id,
        /*    'category' => $request->category,
            'subcategory' => $request->subcategory,
            'product_name' => $getProducts->product_name,
            'product_price' => $getProducts->product_price,
            */'product_quantity'=>'none',
            'product_price' => $getProducts->product_price
           ];
       
    }
}
else{
  //  dd(is_null($check));
    return redirect()->back()->withErrors(['msg', 'You have already registered this category']);
}
if(isset($data)){
    Marts_Products::insert($data);
    return redirect()->back()->with('success', 'You have successfully registered this category');
}
else{
    return redirect()->back()->withErrors(['msg', 'You have already registered this category']);
}
   // dd("Success");
    
    
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marts_Products  $marts_Products
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $email=Auth::guard('admin')->user()->email;
        
       $product=Products::where('category',$request->category)->where('subcategory',$request->subcategory)->get();
        
       $sel=Marts_Products::select('product_id')->where('email',$email)->get();
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
$qds=Marts_Products::select('product_id')->where('email',$email)->pluck('product_id');
$categorie= DB::table('Products')->get()->whereIn('id', $qds)->unique('subcategory')->groupBy('category');  
        foreach($product as  $products){
            $product_id=$products->id;
            $showMartProduct=Marts_Products::where('email',$email)->where('product_id',$product_id)->first();
            
            if(isset($showMartProduct->id)){
            $data[] =[
                'email' => $email,
                'product_id'=> $showMartProduct->id,
                'category' => $products->category,
                'subcategory' => $products->subcategory,
                'product_name' => $products->product_name,
                'product_quantity'=>$products->product_quantity,
                'product_pic'=>$products->product_pic,
                'product_price' =>$showMartProduct->product_price
               ];
            }
           
        }
      if(isset($data)){
        return view('layouts.my_products')->with('data',$data)->with('cat',$cat)->with('categorie',$categorie);
      }
      else{
        return view('layouts.my_products')->with('cat',$cat)->with('categorie',$categorie);
      }


    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marts_Products  $marts_Products
     * @return \Illuminate\Http\Response
     */
    public function edit(Marts_Products $marts_Products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marts_Products  $marts_Products
     * @return \Illuminate\Http\Response
     */
    public function updatePrice(Request $request,$id,$email,$category,$subcategory)
    {
        $email=Auth::guard('admin')->user()->email;
      
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            
        ]);
        if ($validator->fails()) {
            $product=Products::where('category',$category)->where('subcategory',$subcategory)->get();
            
            foreach($product as  $products){
                $myMartProducts=Marts_Products::where('product_id',$products->id)->where('email',$email)->first();
               // $myproducts = $products->product_pic;
              //  $product_price = $products->product_price;
              if(isset($myMartProducts->id)){
                $data[] =[
                    'email' => $email,
                    'product_id' => $myMartProducts->id,
                    'category' => $products->category,
                    'subcategory' => $products->subcategory,
                    'product_name' => $products->product_name,
                    'product_quantity'=>$products->product_quantity,
                    'product_pic'=>$products->product_pic,
                    'product_price' =>$myMartProducts->product_price
                   ];
                   
                }
               
            }
         
            Session::flash('error', $validator->messages()->first());
            $sel=Marts_Products::select('product_id')->where('email',$email)->get();
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
$qds=Marts_Products::select('product_id')->where('email',$email)->pluck('product_id');
$categorie= DB::table('Products')->get()->whereIn('id', $qds)->unique('subcategory')->groupBy('category');  
           
            return view('layouts.my_products')->with('data',$data)->withErrors(['msg', 'You have already registered this category'])->with('cat',$cat)->with('categorie',$categorie);
            
            

        }
       else{
      
            $staff = Marts_Products::find($id);
            if(isset($staff)){
            $productPrice=$request->input('price');     
            $staff->product_price=$productPrice;
            $staff->save();
            $sel=Marts_Products::select('product_id')->where('email',$email)->get();
            
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
$qds=Marts_Products::select('product_id')->where('email',$email)->pluck('product_id');
$categorie= DB::table('Products')->get()->whereIn('id', $qds)->unique('subcategory')->groupBy('category');  
            $productName=Products::find($staff->product_id);
            $this->prName=$productName->product_name;
            }
            $showMartProduct=Products::where('category',$category)->where('subcategory',$subcategory)->get();
            foreach($showMartProduct as  $showMartProducts){
            $products=Marts_Products::where('product_id',$showMartProducts->id)->where('email',$email)->first();
            //$myproducts = $products->product_pic;
            if(isset($products->id)){
           $data[] =[
                    'email' => $email,
                    'product_id' => $products->id,
                    'category' => $showMartProducts->category,
                    'subcategory' => $showMartProducts->subcategory,
                    'product_name' => $showMartProducts->product_name,
                    'product_quantity'=>$products->product_quantity,
                    'product_pic'=>$showMartProducts->product_pic,
                    'product_price' =>$products->product_price
                   ];
           
                   
                }
                }
                if(isset($data)){
                   
                return view('layouts.my_products')->with('data',$data)->with('youaregood','The Price of Item '.$this->prName.' is Updated Successfully')->with('cat',$cat)->with('categorie',$categorie);
                }
                else{
                    return view('layouts.my_products');
                }
    }
}
       

        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marts_Products  $marts_Products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$email,$category,$subcategory)
    {
        $email=Auth::guard('admin')->user()->email;
        $res=Marts_Products::where('id',$id)->delete();
        $showMartProduct=Products::where('category',$category)->where('subcategory',$subcategory)->get();
        foreach($showMartProduct as  $showMartProducts){
            $products=Marts_Products::where('product_id',$showMartProducts->id)->where('email',$email)->first();
           
       if(isset($products->id)){
           $data[] =[
                    'email' => $email,
                    'product_id' => $products->id,
                    'category' => $showMartProducts->category,
                    'subcategory' => $showMartProducts->subcategory,
                    'product_name' => $showMartProducts->product_name,
                    'product_quantity'=>$products->product_quantity,
                    'product_pic'=>$showMartProducts->product_pic,
                    'product_price' =>$products->product_price
                   ];
           
                }
                   
                }
            if(isset($data)){
                $sel=Marts_Products::select('product_id')->where('email',$email)->get();
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
         $qds=Marts_Products::select('product_id')->where('email',$email)->pluck('product_id');
         $categorie= DB::table('Products')->get()->whereIn('id', $qds)->unique('subcategory')->groupBy('category'); 
                return view('layouts.my_products')->with('data',$data)->with('cat',$cat)->with('categorie',$categorie);
            }
            else{
                $sel=Marts_Products::select('product_id')->where('email',$email)->get();
       foreach($sel as $sels){
        $ang=Products::select('category')->where('id',$sels->product_id)->first();
        
       if(isset($ang->category)){
        $this->rec[]=[
            "categories"=>$ang->category
        ];
    }
      
    }
    if($this->rec){
        $cat=array_unique($this->rec,SORT_REGULAR);
   }
   else{
  
       return view('layouts.my_products')->with("err","No Category Left to Show")->with('categorie','');
   }
                $qds=Marts_Products::select('product_id')->where('email',$email)->pluck('product_id');
               $categorie = DB::table('Products')->get()->whereIn('id', $qds)->unique('subcategory')->groupBy('category'); 
                return view('layouts.my_products')->with('cat',$cat)->with('categorie',$categorie);
            }
    }
}
