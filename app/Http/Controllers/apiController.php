<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marts_Products;
use App\Models\Products;
use App\Models\Order;
use App\Models\order_product;
use App\Models\Admins;
use DB;
use Response;
class apiController extends Controller
{
    public function getMarts(){
        $getallMarts = DB::table('admins')->get();
        return Response::json(array(
            'error' => false,
            'pages' => $getallMarts->toArray()),
            200
        );
    }
    public function getOrders(Request $request){
      $manage = $request;
		
			// Parsing Strings
			$request = $request->order;
			$request = json_decode($request);
	
               $storeInorders=new Order();   
               $storeInorders->user_email=$request->user_email;
               $storeInorders->mart_email=$request->mart_email;
               $storeInorders->total_price=$request->total_price;
               $storeInorders->total_items=$request->total_items;
               $storeInorders->order_status=$request->order_status;
               $storeInorders->save();
              
				// Parsing Array
				$manage = $manage->order;
				$manage = json_decode($manage,true);

                $refArr[]=$manage['arr'];
             
               	foreach($refArr as $refArrs){
                
             	foreach($refArrs as $refArrss){
              	$saveorderProduct=new order_product();
                $saveorderProduct->order_id=$storeInorders->id;
                $saveorderProduct->ordered_product_id=$refArrss['product_id'];
                $saveorderProduct->product_quantity=$refArrss['product_quantity'];
                $saveorderProduct->save();     
                
                

            // $j = $refArrss['product_id'];
             }
            
                /*  for($i=0;$i<count($refArrs);$i++) {
                      if(isset($refArrs[$i])){
                    $saveorderProduct=new order_product();
                    $saveorderProduct->order_id=$storeInorders->id;
                    $saveorderProduct->ordered_product_id=$refArrs[$i];
                    $saveorderProduct->save();
                      }
                  }
               */


               }
             //  $storeValue=new Admins();
            $totalOrders = DB::table('orders')->where('mart_email',$request->mart_email)->get();
            $countIt=$totalOrders->count();
            $saved = Admins::where('email',$request->mart_email)->firstOrFail();
            $saved->total_Orders=$countIt;
            $saved->save();
            return Response::json(array(
            'error' => false,
            'pages' => $storeInorders->id),
             200
            );
    }

    public function getSpecificOrders(Request $request){
     
        $getProducts=DB::table('orders')
        
        ->where('user_email',$request->email)
        ->join('table_order_products','orders.id','=','order_id')
        
        ->join('products','table_order_products.ordered_product_id','=','products.id')
        ->select('product_name','product_price','products.product_quantity','table_order_products.order_id')
        
        ->get()->groupBy('order_id');
        
        $getOrders=DB::table('orders')
        
        ->where('user_email',$request->email)->get();

if(isset($getOrders)){
        return Response::json(array(
          'error' => false,
          'pages' => $getOrders,
          'products' => $getProducts),
           200
          );
        }
        else{
          return Response::json("Not found");
        }
    }


public function storeRatings(Request $request){
 $storeRatings=Order::findOrFail($request->order_id);
 
 $storeRatings->order_status=$request->order_status;
 $storeRatings->ratings=$request->ratings;
 $storeRatings->save();
 $getRating=DB::table('orders')->where('mart_email',$storeRatings->mart_email)->where('ratings','!=',null)->get();
 $countallRat=$getRating->count();
 $getAllRatings=0.0;
 foreach($getRating as $getRatings){
  $getAllRatings=floatval($getRatings->ratings)+$getAllRatings;




 }
 $avg_ratings=$getAllRatings/$countallRat;
 $storeRatings=Admins::where('email',$storeRatings->mart_email)->firstOrFail();
 $storeRatings->Avg_Ratings=$avg_ratings;
 $storeRatings->save();

   
 
 return Response::json(array(
  'error' => false,
  'pages' =>"Ratings stored Thank u for using"),
   200
  );


 
}



    public function getCategory(Request $request){
        $getSubCategory=DB::table('marts_products')->get()->where('email',$request->email);

      //  $all_Categories=DB::table('products')->get()->whereIn('id',$getSubCategory);
        foreach($getSubCategory as $getSubCategorys){
      $category=Products::where('id',$getSubCategorys->product_id)->first();
      if(isset($category)){
$data[]=[
'category'=>$category->category,
'subcategory'=>$category->subcategory,
'product_name'=>$category->product_name,
'product_pic'=>$category->product_pic,
'product_price'=>$getSubCategorys->product_price,
'product_quantity'=>$category->product_quantity
];
      }
        }
    
        return Response::json(array(
            'error' => false,
            'pages' => $data),
            200
        );
    }
    public function getProducts(Request $request){
       $getProduct=DB::table('Marts_products')->where('email',$request->email)->get();
       foreach($getProduct as $getProducts){
        $getspecific=Products::where('category',$request->category)->where('subcategory',$request->subcategory)->where('id',$getProducts->product_id)->first(); 
        if (isset($getspecific->category)) {
        $data[]=[
         'category'=>$getspecific->category,
         "subcategory"=>$getspecific->subcategory,
         "product_name"=>$getspecific->product_name,
         "product_price"=>$getProducts->product_price
         
        ];

       }
    }
       return Response::json(array(
        'error' => false,
        'pages' => $data),
        200
    );

    }
}
