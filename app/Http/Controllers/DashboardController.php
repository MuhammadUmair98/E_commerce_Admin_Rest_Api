<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class DashboardController extends Controller
{
    public function show(){
$email=Auth::guard('admin')->user()->email;
      $orders=DB::table('orders')->where('mart_email',$email);
      $count=$orders->count();
      $revenue=DB::table('orders')->where('mart_email',$email)->select('total_price')->get();
      $totalPrice=0;
      if(isset($revenue)){
      foreach($revenue as $revenues){
      $totalPrice=$revenues->total_price+$totalPrice;
      }
    }
      $averageRating=DB::table('orders')->where('mart_email',$email)->select('ratings')->get();
      $ratings=0;
      $i=0;
      if(isset($averageRating)){
      foreach($averageRating as $averageRatings){
          $i=$i+1;
          $ratings=$averageRatings->ratings+$ratings;
      }
      $avgratings=$ratings/$i;
    }

      return view('dashboard.Mydashboard')->with('count',$count)->with('totalEarned',$totalPrice)->with('getratings',$avgratings);

     

    }
}
