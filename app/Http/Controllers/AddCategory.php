<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddCategorys;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Products;
use App\Models\Product_Categories;
use File;

class AddCategory extends Controller
{
    public function save(Request $request){
    
        $insert=new AddCategorys();
        $cat =Product_Categories::select('categories')->distinct()->get();
        $categorie=Product_Categories::get()->groupBy('categories'); 
        $insert->categories=$request->input('main');
        $insert->subcategories=$request->input('sub');
        $insert->save();
        return redirect()->back()->with('successfull','Your Category has been Registered')->with('cat',$cat)->with('categorie',$categorie);
    }
    public function showallCategories(){
        $data;
        $allCategorie=DB::table('product_categories')->get()->groupBy('categories');
     /*   foreach($allCategorie as $allCategories){
            foreach($allCategories as $allCategoriess){
                $count=DB::table('products')->where('category',$allCategoriess->categories)->where('subcategory',$allCategoriess->subcategories);
                $countAll=$count->count();
             $data[]=[
                'id' =>$allCategoriess->id, 
               'categories' => $allCategoriess->categories,
               'subcategory' => $allCategoriess->subcategories,
               'count'   => $countAll
                
             ]; 
          
            }
      
        }
        $result =$data ;
        foreach ($result as $element) {
            $result[$element['categories']] = $element;
        }
       */
  
        
     
        return view('Super_Admin.AllCategory')->with('viewCategorie',$allCategorie);
    
    }

public function get(){
    $cat =Product_Categories::select('categories')->distinct()->get();
    $categorie=Product_Categories::get()->groupBy('categories');
    return view('Super_Admin.getProduct')->with('cat',$cat)->with('categorie',$categorie);
   // return view('');
}
public function post(Request $request){
    $cat =Product_Categories::select('categories')->distinct()->get();
    $categorie=Product_Categories::get()->groupBy('categories'); 
$viewallProducts=Products::where('category',$request->input('main'))->where('subcategory',$request->input('subcategory'))->get();
if($viewallProducts){
    //dd($request->input('main'));
     return view('Super_Admin.getProduct')->with('product',$viewallProducts)->with('cat',$cat)->with('categorie',$categorie);
}
else{
    dd("Not Entered Correctly");
}

}




public function getAdd(){
    $cat =Product_Categories::select('categories')->distinct()->get();
    $categorie=Product_Categories::get()->groupBy('categories');
    return view('layouts.add_product')->with('cat',$cat)->with('categorie',$categorie);
}





public function storePics(Request $request,$category,$subcategory,$id){
    
    $validator = Validator::make($request->all(), [
        'pics' => 'required',
        
    ]);
    $viewallProducts=Products::where('category',$category)->where('subcategory',$subcategory)->get();
    if($validator->fails()){
     
        $cat =Product_Categories::select('categories')->distinct()->get();
        $categorie=Product_Categories::get()->groupBy('categories'); 
          return view('Super_Admin.getProduct')->with('product',$viewallProducts)->with('msg', 'Please insert something to store')->with('cat',$cat)->with('categorie',$categorie);
    }
    else{
        $cat =Product_Categories::select('categories')->distinct()->get();
        $categorie=Product_Categories::get()->groupBy('categories'); 
        $driver=Products::findOrFail($id);
        if ($files = $request->file('pics')) {
            $usersImage = public_path("public/image/{$driver->product_pic}"); // get previous image from folder
            if (File::exists($usersImage)) {
				if(isset($driver->product_pic)){
                unlink($usersImage);
				}
            }
            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalName();
            $files->move($destinationPath, $profileImage);
            $driver->product_pic=$profileImage;
            }
            $driver->save();
            $viewallProductes=Products::where('category',$category)->where('subcategory',$subcategory)->get();
            return view('Super_Admin.getProduct')->with('product',$viewallProductes)->with('cat',$cat)->with('categorie',$categorie);
    }
}

    public function storeProducts($id,$category,$categoryName){

        return view('Super_Admin.Add_Products')->with('category',$category)->with('categoryName',$categoryName);

    }

    public function store(Request $request){
     
    $products=new Products();
    $products->Category=$request->input('category');
    $products->subcategory=$request->input('sub');
    $products->product_name=$request->input('name');
    $products->product_price=$request->input('price');
    $products->product_quantity=$request->input('quantity');
    $save = $products->save();
    $updateCount=Product_Categories::where('categories',$request->input('category'))->where('subcategories',$request->input('sub'))->firstOrFail();
    $get = Products::where('category',$request->input('category'))->where('subcategory',$request->input('sub'))->get();
    $countAll=$get->count();
    $updateCount->count=$countAll;
    $updateCount->save();
    if($save){
        return view('Super_Admin.Add_Products')->with('nice','Products Saved')->with('category',$request->input('category'))->with('categoryName',$request->input('sub'));

    }
    else{
        dd("NOT SAVED");
    }
    

    }
}