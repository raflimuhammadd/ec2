<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesananItemsController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\PesananItems;
use App\Models\Produk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BerandaController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/about', [AboutController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::post('/transaksi', [ShopController::class, 'transaksi'])->name('transaksi');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
Route::get('/detail', [ShopController::class, 'detail']);
Route::get('/success/{id}', [ShopController::class, 'success'])->name('success');
Route::get('add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ShopController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ShopController::class, 'remove'])->name('remove.from.cart');

Route::get('/profile', [UserController::class, 'show']);
Route::patch('/profile/{id}', [UserController::class, 'update']);


Route::fallback(function () {
    return view('404');
});

Route::middleware('auth','auth.user')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/users', [UsersController::class, 'index']);
        Route::get('/users/create', [UsersController::class, 'create']);
        Route::post('/users/store', [UsersController::class, 'store']);
        Route::get('/users/show/{id}', [UsersController::class, 'show']);
        Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
        Route::post('/users/update/{id}', [UsersController::class, 'update']);
        Route::get('/users/delete/{id}', [UsersController::class, 'destroy']);
        Route::get('/users/usersPDF', [UsersController::class, 'usersPDF']);
        Route::get('/users/pdfshow/{id}', [UsersController::class, 'showPDF']);
        Route::get('/users/generatePDF', [UsersController::class, 'generatePDF']);

        Route::get('/pembayaran', [PembayaranController::class, 'index']);
        Route::get('/pembayaran/create', [PembayaranController::class, 'create']);
        Route::post('/pembayaran/store', [PembayaranController::class, 'store']);
        Route::get('/pembayaran/show/{id}', [PembayaranController::class, 'show']);
        Route::get('/pembayaran/edit/{id}', [PembayaranController::class, 'edit']);
        Route::post('/pembayaran/update/{id}', [PembayaranController::class, 'update']);
        Route::get('/pembayaran/delete/{id}', [PembayaranController::class, 'destroy']);
        Route::get('/pembayaran/pembayaranPDF', [PembayaranController::class, 'pembayaranPDF']);
        Route::get('/pembayaran/pdfshow/{id}', [PembayaranController::class, 'pembayaranPDF_show']);
        Route::get('/pembayaran/generatePDF', [PembayaranController::class, 'generatePDF']);
        Route::get('/pembayaran/export', [PembayaranController::class, 'exportPembayaran']);

        Route::get('/produk', [ProdukController::class, 'index']);
        Route::get('/produk/create', [ProdukController::class, 'create']);
        Route::post('/produk/store', [ProdukController::class, 'store']);
        Route::get('/produk/show/{id}', [ProdukController::class, 'show']);
        Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
        Route::post('/produk/update/{id}', [ProdukController::class, 'update']);
        Route::get('/produk/delete/{id}', [ProdukController::class, 'destroy']);
        Route::get('/produk/export', [ProdukController::class, 'exportProduk']);
        Route::post('/produk/import', [ProdukController::class, 'importProduk']);
        Route::get('/kategori/kategoriPDF', [KategoriController::class, 'kategoriPDF']);
        Route::get('/kategori/pdfshow/{id}', [KategoriController::class, 'kategoriPDF_show']);
        Route::get('/kategori/generatePDF', [KategoriController::class, 'generatePDF']);

        Route::get('/pesanan', [PesananController::class, 'index']);
        Route::get('/pesanan/create', [PesananController::class, 'create']);
        Route::post('/pesanan/store', [PesananController::class, 'store']);
        Route::get('/pesanan/edit/{id}', [PesananController::class, 'edit']);
        Route::get('/pesanan/show/{id}', [PesananController::class, 'show']);
        Route::post('/pesanan/update/{id}', [PesananController::class, 'update']);
        Route::get('/pesanan/delete/{id}', [PesananController::class, 'destroy']);
        Route::get('/pesanan/pesananPDF', [PesananController::class, 'pesananPDF']);
        Route::get('/pesanan/pdfshow/{id}', [PesananController::class, 'pesananPDF_show']);
        Route::get('/pesanan/generatePDF', [PesananController::class, 'generatePDF']);
        Route::get('/pesanan/export', [PesananController::class, 'exportPesanan']);

        Route::get('/pesananItems', [PesananItemsController::class, 'index']);
        Route::get('/pesananItems/create', [PesananItemsController::class, 'create']);
        Route::post('/pesananItems/store', [PesananItemsController::class, 'store']);
        Route::get('/pesananItems/edit/{id}', [PesananItemsController::class, 'edit']);
        Route::get('/pesananItems/show/{id}', [PesananItemsController::class, 'show']);
        Route::post('/pesananItems/update/{id}', [PesananItemsController::class, 'update']);
        Route::get('/pesananItems/delete/{id}', [PesananItemsController::class, 'destroy']);
        Route::get('/pesananItems/pesananItemsPDF', [PesananItemsController::class, 'pesananItemsPDF']);
        Route::get('/pesananItems/pdfshow/{id}', [PesananItemsController::class, 'PesananItemsPDF_show']);
        Route::get('/pesananItems/generatePDF', [PesananItemsController::class, 'generatePDF']);
        Route::get('/pesananItems/export', [PesananItemsController::class, 'exportPesananItems']);

        Route::get('/kategori', [KategoriController::class, 'index']);
        Route::get('/kategori/create', [KategoriController::class, 'create']);
        Route::post('/kategori/store', [KategoriController::class, 'store']);
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
        Route::get('/kategori/show/{id}', [KategoriController::class, 'show']);
        Route::post('/kategori/update/{id}', [KategoriController::class, 'update']);
        Route::get('/kategori/delete/{id}', [KategoriController::class, 'destroy']);
        Route::get('/produk/produkPDF', [ProdukController::class, 'produkPDF']);
        Route::get('/produk/pdfshow/{id}', [ProdukController::class, 'produkPDF_show']);
        Route::get('/produk/generatePDF', [ProdukController::class, 'generatePDF']);

        Route::get('/pelanggan', [PelangganController::class, 'index']);
        Route::get('/pelanggan/create', [PelangganController::class, 'create']);
        Route::post('/pelanggan/store', [PelangganController::class, 'store']);
        Route::get('/pelanggan/edit/{id}', [PelangganController::class, 'edit']);
        Route::get('/pelanggan/show/{id}', [PelangganController::class, 'show']);
        Route::post('/pelanggan/update/{id}', [PelangganController::class, 'update']);
        Route::get('/pelanggan/delete/{id}', [PelangganController::class, 'destroy']);
        Route::get('/pelanggan/pelangganPDF', [PelangganController::class, 'pelangganPDF']);
        Route::get('/pelanggan/pdfshow/{id}', [PelangganController::class, 'pelangganPDF_show']);
        Route::get('/pelanggan/generatePDF', [PelangganController::class, 'generatePDF']);
        Route::get('pelanggan/export/', [PelangganController::class, 'exportPelanggan']);

        Route::get('/transaksi', [TransaksiController::class,'index']);
        Route::get('/transaksi/show/{id}', [TransaksiController::class,'show']);
        Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit']);
        Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update']);

        Route::get('/user', [UserController::class, 'index']);
    });
});

Auth::routes();

Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'redirectToGoogleCallback']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
