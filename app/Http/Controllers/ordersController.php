<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Response;
class ordersController extends Controller
{
    public function get(){
$data=[];
        $email=Auth::guard('admin')->user()->email;
         
         $order =  DB::table('orders')->where('mart_email', $email)->select('orders.*','admins.name')
         ->join('admins', 'orders.mart_email', '=', 'email')->get();
       
        return view('orders.main_order_page')->with('order',$order);

    }

    public function getProducts(Request $request){
 
        $data=DB::table('table_order_products')->where('order_id',$request->id)->select('products.*','marts_products.product_price')
        ->join('products','table_order_products.ordered_product_id','=','products.id')
        ->join('marts_products','products.id','=','marts_products.product_id')
        ->get();
        
        return view('orders.product')->with('data',$data);


    }
}
