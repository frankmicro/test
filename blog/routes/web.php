<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert', function () {
	/*$id = 2;
	$user = App\User::find(Auth::User()->id);

	$productData = new App\Product(['name'=>'newuser']);
	$user->product()->save($productData); dd('war');*/

    $id = 1;
    
    $posts = App\Product::whereHas('productDetails', $filter = function ($query) use ($id) {
        $query->where('description','like','%abc%')->where('product_id',$id);
    })->with(['productDetails'=>$filter])->get();
    dump($posts); die;

    $chk = App\User::withAndWhereHas('product', function ($query) use ($id) {
        $query->where('id', $id);
    })->get();
    dd($chk);
    $product = App\Product::find(1);
    //dd($product->productDetails()->get());
    //$productDetails = new App\ProductDetails(['description'=>'xyz']);

    foreach ($product->productDetails()->get() as $value) {
        $value->description = 'abc';
        $value->save();
    }

    //$product->productDetails()->save($productDetails);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
