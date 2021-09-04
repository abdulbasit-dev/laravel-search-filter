<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProductController;

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

Route::redirect('/', 'products', 301);

//Route::match(['get', 'post'], '/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/list', [ProductController::class,'list'])->name('products.list');
Route::resource('/products', ProductController::class);



Route::group(['prefix'=>'admin','as'=>'admin.'],function (){
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('products',AdminProductController::class);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
