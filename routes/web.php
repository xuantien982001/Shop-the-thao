<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\ChiTietDonHangController;
use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TrangChuController;
use App\Models\ChuyenMuc;
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



Route::get('/', [TrangChuController::class, 'index']);
Route::get('/product/{slug}', [TrangChuController::class, 'detailProduct']);
Route::get('/category/{id}', [TrangChuController::class, 'listProduct']);
Route::get('/search',[TrangChuController::class,'search']);


Route::get('/login', [KhachHangController::class, 'viewAuth']);
Route::post('/login', [KhachHangController::class, 'login']);
Route::get('/register', [KhachHangController::class, 'viewRegister']);
Route::post('/register', [KhachHangController::class, 'register']);
Route::get('/kich-hoat/{hash}', [KhachHangController::class, 'active']);

Route::get('/reset', [KhachHangController::class, 'viewReset']);
Route::post('/reset', [KhachHangController::class, 'actionReset']);
Route::get('/change-pass/{hash}', [KhachHangController::class, 'viewChangePass']);
Route::post('/change-pass', [KhachHangController::class, 'actionChangePass']);
Route::get('/blog/{id}', [TrangChuController::class, 'listBlog']);
Route::get('/logout', [KhachHangController::class, 'logout']);


Route::group(['prefix' => '/client','middleware' => 'ClientMiddelware'], function() {
    Route::get('/add-to-cart/{id_san_pham}', [ChiTietDonHangController::class, 'store']);
    Route::get('/cart', [ChiTietDonHangController::class, 'index']);
    Route::get('/cart/data', [ChiTietDonHangController::class, 'dataCart']);
    Route::get('/cart/remove/{id}', [ChiTietDonHangController::class, 'removeCart']);
    Route::post('/cart/update', [ChiTietDonHangController::class, 'update']);

    Route::post('/bill/create', [HoaDonController::class, 'store']);
    Route::get('/bill-order', [HoaDonController::class, 'index']);
    Route::get('/bill/order', [HoaDonController::class, 'listOrder']);
    Route::get('/all-bill', [HoaDonController::class, 'listBill']);
   // Route::get('/checkout', [HoaDonController::class, 'index']);

});

Route::group(['prefix' => '/admin-shop' , 'middleware' => 'AdminMiddleware'], function () {
    Route::group(['prefix' => 'danh-muc'], function () {
        Route::get('/index', [DanhMucController::class, 'index']);
        Route::post('/create', [DanhMucController::class, 'store']);
        Route::get('/data', [DanhMucController::class, 'getData']);
        Route::get('/edit/{id}', [DanhMucController::class, 'edit']);
        Route::post('/update', [DanhMucController::class, 'update']);
        Route::get('/destroy/{id}', [DanhMucController::class, 'destroy']);
        Route::get('/update-status/{id}', [DanhMucController::class, 'updateStatus']);
    });

    Route::group(['prefix' => 'san-pham'], function () {
        Route::get('/index', [SanPhamController::class, 'index']);
        Route::post('/create', [SanPhamController::class, 'store']);
        Route::get('/data', [SanPhamController::class, 'getData']);
        Route::get('/edit/{id}', [SanPhamController::class, 'edit']);
        Route::post('/update', [SanPhamController::class, 'update']);
        Route::get('/destroy/{id}', [SanPhamController::class, 'destroy']);
        Route::get('/update-status/{id}', [SanPhamController::class, 'updateStatus']);
    });
    Route::group(['prefix' => 'chuyen-muc'], function () {
        Route::get('/index', [ChuyenMucController::class, 'index']);
        Route::post('/create', [ChuyenMucController::class, 'store']);
        Route::get('/data', [ChuyenMucController::class, 'getData']);
        Route::get('/update-status/{id}', [ChuyenMucController::class, 'updateStatus']);
        Route::post('/update', [ChuyenMucController::class, 'update']);
        Route::get('/edit/{id}', [ChuyenMucController::class, 'edit']);
        Route::get('/destroy/{id}', [ChuyenMucController::class, 'destroy']);

    });

    Route::group(['prefix' => 'bai-viet'], function(){
        Route::get('/index', [BaiVietController::class, 'index']);
        Route::post('/create', [BaiVietController::class, 'store']);
        Route::get('/data', [BaiVietController::class, 'getData']);
        Route::post('/update', [BaiVietController::class, 'update']);
        Route::get('/edit/{id}', [BaiVietController::class, 'edit']);
        Route::get('/destroy/{id}', [BaiVietController::class, 'destroy']);



    });

    Route::group(['prefix' => '/admin'], function () {
        Route::get('/index', [AdminController::class, 'index']);
        Route::get('/data', [AdminController::class, 'getData']);
        Route::post('/check-email',[AdminController::class,'checkEmail']);
        Route::post('/create',[AdminController::class,'store']);
        Route::get('/update-status/{id}', [AdminController::class, 'updateStatus']);
        Route::get('/logout', [AdminController::class, 'logout']);
        Route::post('/update', [AdminController::class, 'update']);
        Route::get('/edit/{id}', [AdminController::class, 'edit']);
        Route::get('/destroy/{id}', [AdminController::class, 'destroy']);




    });
    Route::group(['prefix' => '/hoa-don-ban-hang'], function() {
        Route::get('/index', [HoaDonController::class, 'admin_index']);

        Route::get('/data', [HoaDonController::class, 'getData']);

        Route::get('/thong-ke', [HoaDonController::class, 'analytic']);
        Route::post('/thong-ke', [HoaDonController::class, 'analyticPost'])->name('postThongKe');

        Route::post('/change-status', [HoaDonController::class, 'changeStatus']);
        Route::post('/change-type', [HoaDonController::class, 'changeType']);
        Route::post('/search', [HoaDonController::class, 'search']);
        Route::get('/detail/{id}', [ChiTietDonHangController::class, 'getDetail']);

    });
    Route::group(['prefix' => '/slide'], function() {
        Route::get('/index', [SlideController::class, 'index']);
        Route::post('/create', [SlideController::class, 'store']);
        Route::get('/data', [SlideController::class, 'getData']);
        Route::get('/edit/{id}', [SlideController::class, 'edit']);
        Route::post('/update', [SlideController::class, 'update']);
        Route::get('/destroy/{id}', [SlideController::class, 'destroy']);
        Route::get('/update-status/{id}', [SlideController::class, 'updateStatus']);

    });
    Route::get('/logout', [\App\Http\Controllers\AdminController::class, 'logout']);
});

Route::get('/admin-shop/login', [\App\Http\Controllers\AdminController::class, 'viewLogin']);
Route::post('/admin-shop/login', [\App\Http\Controllers\AdminController::class, 'actionLogin']);

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

