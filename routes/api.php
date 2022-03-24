<?php


// use App\Models\Product;
use App\Http\Controllers\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




// Route::get('/products', function() {
//     return 'products';
// });

// Route::get('/products', function() {
//     return Product::all();
// });

// Route::get('/products', [ProductController::class,'index']);

// Route::post('/products', function() {
//     return Product::create([
//         'name' => 'Product One',
//         'slug' => 'product-one',
//         'description' => 'this is a product one',
//         'price' => '99.99'
//     ]);
// });

// Route::post('/products', [ProductController::class,'store']);





// Route::resource('products', ProductController::class);
Route::get('/products/search/{name}', [ProductController::class,'search']);

Route::get('/products', [ProductController::class,'index']);
Route::get('/products/{id}', [ProductController::class,'show']);


Route::middleware('auth:sanctum')->post('/products', [ProductController::class,'store']);
Route::middleware('auth:sanctum')->put('/products/{id}', [ProductController::class,'update']);
Route::middleware('auth:sanctum')->delete('/products/{id}', [ProductController::class,'destroy']);





// 影片建議的方式，不管用
// Route::group(['middleware'=>['auth:sanctum']], function () {
//     Route::get('/products/search/{name}', [ProductController::class,'search']);
// });


// 實測有效
// Route::middleware('auth:sanctum')->get('/products/search/{name}', [ProductController::class,'search']);


// 本來就出現在這
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
