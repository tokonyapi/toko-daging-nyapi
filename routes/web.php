<?php

use App\Http\Controllers\OrderController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BeritaController;
use App\Models\Berita;
use App\Models\Product;
use App\Models\Category;
use App\Models\Orders;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});



//admin
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    $products = Product::all();
    $beritas = Berita::all();
    $categories = ['cube', 'slice', 'premium'];
    return view('admin.index', compact('products','categories','beritas'));
})->name('admin.dashboard');

Route::get('/admin/alltransactions', [AdminController::class, 'allTransactions'])->name('admin.alltransactions');
Route::get('/admin/edit_product/{product}', [ProductController::class, 'edit'])->name('admin.edit_product');
Route::put('/admin/update_product/{product}', [ProductController::class, 'update'])->name('admin.update_product');
Route::get('/admin/add_product', [ProductController::class, 'create'])->name('admin.add_product');
Route::post('/admin/store_product', [ProductController::class, 'store'])->name('admin.store_product');
Route::delete('/admin/delete_product/{product}', [ProductController::class, 'destroy'])->name('admin.delete_product');
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
Route::post('/admin/password/update', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.password.update');
Route::resource('beritas', BeritaController::class);

// Route::get('/admin/edit_berita/{berita}', [BeritaController::class, 'edit'])->name('admin.edit_berita');
// Route::put('/admin/update_berita/{berita}', [BeritaController::class, 'update'])->name('admin.update_berita');
// Route::get('/admin/add_berita', [BeritaController::class, 'create'])->name('admin.add_berita');
// Route::post('/admin/store_berita', [BeritaController::class, 'store'])->name('admin.store_berita');
// Route::delete('/admin/delete_berita/{berita}', [BeritaController::class, 'destroy'])->name('admin.delete_berita');


    // Route::get('admin/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    // Route::post('admin/berita', [BeritaController::class, 'store'])->name('berita.store');



//user
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $userId = Auth::id();
    $user = Auth::user();

    $transactions = Orders::where('user_id', $userId)
                          ->where('status', 'paid')
                          ->with('product')
                          ->orderBy('invoice_number')
                          ->get()
                          ->groupBy('invoice_number');
    return view('dashboard', compact('user','transactions'));
})->name('dashboard');


Route::get('/', [IndexController::class, 'index'])->name('user.dashboard');
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile/edit', [IndexController::class, 'userProfileEdit'])->name('user.profile.edit');
Route::post('/user/profile/update', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');
Route::get('/user/change/password', [IndexController::class, 'changePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'userUpdatePassword'])->name('user.update.password');
Route::get('/about', [IndexController::class, 'about'])->name('user.about');

Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', [OrderController::class, 'index'])->name('user.cart');
// Route::put('/paid', [OrderController::class, 'paid'])->name('user.paid');
Route::middleware('auth')->post('/addtocart/{id}', [OrderController::class, 'store'])->name('user.addtocart');
Route::put('/updatequantity/{id}', [OrderController::class, 'update'])->name('user.updatequantity');
Route::delete('/remove/{id}', [OrderController::class, 'destroy'])->name('user.remove');

// Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
// Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Berita
Route::get('beritas', [BeritaController::class, 'index'])->name('user.beritas.index');
Route::get('beritas/create', [BeritaController::class, 'create'])->name('admin.beritas.create');
Route::post('beritas', [BeritaController::class, 'store'])->name('admin.beritas.store');
Route::get('beritas/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.beritas.edit');
Route::put('beritas/{berita}', [BeritaController::class, 'update'])->name('admin.beritas.update');
Route::delete('beritas/{berita}', [BeritaController::class, 'destroy'])->name('admin.beritas.destroy');
Route::get('beritas/{slug}', [BeritaController::class, 'show'])->name('user.beritas.show');

//midtrans
Route::post('/payment/notification', [OrderController::class, 'handlePaymentNotification'])->name('user.paid');
Route::post('/midtrans-notification', [OrderController::class, 'handleMidtransNotification'])->name('midtrans.notification');


