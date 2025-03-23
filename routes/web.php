<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;

Route::get('/', [WelcomeController::class,'index']);

// USER
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);         // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);     // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);  // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);        // menyimpan data user baru
    // Route ajax
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);  // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);         // Menyimpan data user baru Ajax
    //--Kode lama
    Route::get('/{id}', [UserController::class, 'show']);                // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);           // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);              // menyimpan perubahan data user
     // Route ajax
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);         // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);     // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);    // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);  // Untuk hapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']);                  // menghapus data user
});

// LEVEL
Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);         // Menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']);     // Menampilkan data level dalam bentuk JSON untuk DataTables
    Route::get('/create', [LevelController::class, 'create']);  // Menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);        // Menyimpan data level baru
    
    // Route ajax
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);  // Menampilkan halaman form tambah level Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']);         // Menyimpan data level baru Ajax
    
    Route::get('/{id}', [LevelController::class, 'show']);                // Menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);           // Menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);              // Menyimpan perubahan data level
    
    // Route ajax
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);         // Menampilkan detail level Ajax
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);         // Menampilkan halaman form edit level Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);     // Menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);    // Untuk tampilkan form confirm delete level Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);  // Untuk hapus data level Ajax
    
    Route::delete('/{id}', [LevelController::class, 'destroy']);                  // Menghapus data level
});

// Route Kategori
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);        // Halaman daftar kategori
    Route::post('/list', [KategoriController::class, 'list']);    // DataTables JSON
    Route::get('/create', [KategoriController::class, 'create']); // Form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);       // Simpan kategori baru

    // Route AJAX
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);  // Form tambah kategori Ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);         // Simpan kategori baru Ajax

    Route::get('/{id}', [KategoriController::class, 'show']);      // Detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); // Form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);    // Simpan perubahan kategori

    // Route AJAX
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);         // Detail kategori Ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);         // Form edit kategori Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);     // Simpan perubahan kategori Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);    // Untuk tampilkan form confirm delete level Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);  // Hapus kategori Ajax

    Route::delete('/{id}', [KategoriController::class, 'destroy']);  // Hapus kategori
});


// Route Supplier
Route::prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/{id}', [SupplierController::class, 'show'])->name('supplier.show'); // Perbaikan di sini
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
});

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show');
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
});

// Praktikum Jobsheet 4
// Route::get('/level',[LevelController::class,'index']);
// Route::get('/kategori',[KategoriController::class,'index']);
// Route::get('/user', [UserController::class, 'index']); 
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
// // Halaman Home
// Route::get('/', [HomeController::class, 'index']);

// // Halaman Products dengan prefix
// Route::prefix('category')->group(function () {
//     Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
//     Route::get('/home-care', [ProductController::class, 'homeCare']);
//     Route::get('/baby-kid', [ProductController::class, 'babyKid']);
//     Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
// });

// // Halaman User dengan parameter
// Route::get('/user/{id}/name/{name}', [UserController::class, 'show']);

// // Halaman Penjualan
// Route::get('/sales', [SalesController::class, 'index']);
