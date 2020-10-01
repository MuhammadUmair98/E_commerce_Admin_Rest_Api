<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/signup',function(){
return view('auth.register');
})->name('register');
Route::post('/signup','Auth\RegisterController@created')->name('registered');
Route::post('/login','Auth\AdminLoginController@login')->name('loggedin');

    Route::group(['middleware' => ['Admin']], function () {
        Route::get('/', 'DashboardController@show')->name('dashboard');
        Route::get('/logout','Auth\AdminLoginController@logout')->name('logout'); 
        Route::get('/view/all/products','HomeController@all')->name('viewAll');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/add_product','AddCategory@getAdd')->name('add_product'); 
        
        Route::post('/view/products','ordersController@getProducts')->name('getproducts');
        Route::get('/view/all/orders','ordersController@get')->name('getAllOrders');
                        Route::post('/product_added', 'MartsProductsController@store')->name('MartsProducts');
                        Route::get('/my_products','ProductsController@view')->name('my_products'); 
                        Route::post('/my_products/added','MartsProductsController@show')->name('viewproducts');
                        Route::post('/price/changed/{id}/{email}/{category}/{subcategory}','MartsProductsController@updatePrice')->name('setPrice');
                        Route::get('/destroy/{id}/{email}/{category}/{subcategory}','MartsProductsController@destroy')->name('destroy');
                        Route::post('/show/all/add/to','HomeController@save')->name('postAllProducts'); 
                        Route::get('/insert/to/products/{id}/{product_price}','HomeController@addTheProduct')->name('addtoProduct');
                            });
        Route::group(['middleware' => ['checkAdmin']], function () {
            Route::get('/login',function(){
                return view('auth.login');
                })->name('login');
            
            
            });
            Route::get('/signup',function(){
                return view('auth.register');
                })->name('register');

            
            Route::group(['middleware' => ['checksuperAdmin']],function () {
                Route::get('/superlogout','Auth\AdminLoginController@logout')->name('superlogout');
          Route::get('real/admin',function(){
           return view('Super_Admin.myAdminSidebar');

          })->name('superhome'); 
          Route::get('/all/Categories','AddCategory@showallCategories')->name('AllCategories');  
          Route::get('/add/products/{id}/{category}/{categoryName}','AddCategory@storeProducts')->name('addadminproduct'); 
          Route::post('/dataSaved','AddCategory@save')->name('categorySaved');
          Route::get('/all/products','AddCategory@get')->name('allProducts');
          Route::post('/data/saved','AddCategory@store')->name('Saved');
          Route::post('/data/products/view','AddCategory@post')->name('mypost');
          Route::post('/save/pictures/{category}/{subcategory}/{id}','AddCategory@storePics')->name('submitFile');

        });