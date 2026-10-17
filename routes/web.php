<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/view/{products}/product' , [MainController::class , 'viewProduct'])->name('home.viewProduct');
Route::get('/search', [MainController::class, 'search']);
Route::get('/cart' , [CartController::class , 'viewCart'])->name('cart');
Route::post('/cart/add/{products}' , [CartController::class , 'addToCart'])->name('cart.add');
Route::post('/cart/decrement/{products}' , [CartController::class , 'cartDecrement'])->name('cart.decrement');
Route::post('/cart/increment/{products}' , [CartController::class , 'cartIncrement'])->name('cart.increment');
Route::post('/cart/remove/{products}', [CartController::class, 'cartRemove'])->name('cart.remove');
Route::get('/checkout' , [CartController::class , 'checkoutPage'])->name('checkoutPage');
Route::post('/checkout/place-order' , [CartController::class , 'placeOrder'])->name('orders.place');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/become-vendor', [MainController::class, 'becomeVendor'])->name('vendor.register');
    Route::post('/become-vendor', [MainController::class, 'storeVendor'])->name('vendor.store');
});

//TODO : Vendors routes
Route::middleware(['vendor', 'auth'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/products', [VendorController::class, 'vendorProducts'])->name('vendor.products');
    Route::post('/vendor/products/add', [VendorController::class, 'addProduct'])->name('vendor.addProductCat');
    Route::get('/vendor/store' , [VendorController::class, 'viewStoreProd'])->name('vendor.mystore');
    Route::get('/vendor/product/{products}/edit' , [VendorController::class , 'editProductPage'])->name('vendor.editproduct');
    Route::post('/vendor/product/{products}/add/categories' , [VendorController::class , 'addProductCat'])->name('vendor.addCatProd');
    Route::post('/vendor/products/{products}/edit' , [VendorController::class , 'editProductAction'])->name('vendor.editProductAction');
    Route::post('/vendor/products/{products}/delete' , [VendorController::class , 'deleteProductAction'])->name('vendor.deleteProductAction');
    Route::get('/vendors/orders' , [VendorController::class , 'viewOrdersVendors'])->name('vendor.orders');
});

//? Guest routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login.page');
    Route::get('/register', [AuthController::class, 'register'])->name('register.page');
    Route::post('/register-action', [AuthController::class, 'registerAction'])->name('register.action');
    Route::post('/login-action', [AuthController::class, 'loginAction'])->name('login.action');
});

//! Admin routes
Route::middleware(['admin', 'auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'usersAdminPage'])->name('admin.users');
    Route::post('/admin/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::post('/admin/users/{user}/update-role', [AdminController::class, 'updateUserRole'])->name('admin.updateUserRole');
    Route::get('/admin/users/deleted-users', [AdminController::class, 'deletedUsers'])->name('admin.deletedUsers');
    Route::post('/admin/users/{user}/restore', [AdminController::class, 'restoreUser'])->name('admin.restoreUser');
    Route::get('/admin/users/{role}/role', [AdminController::class, 'filterUsersByRole'])->name('admin.filterUsersByRole');
    Route::get('/admin/stores', [AdminController::class, 'storesAdminPage'])->name('admin.stores.requests');
    Route::post('/admin/stores/{store}/approve', [AdminController::class, 'storesApprove'])->name('admin.stores.approve');
    Route::post('/admin/stores/{store}/decline', [AdminController::class, 'storesDecline'])->name('admin.stores.decline');
    Route::get('/admin/vendors', [AdminController::class, 'vendorsAdminPage'])->name('admin.vendors');
    Route::get('/admin/carousels', [AdminController::class, 'carouselsAdminPage'])->name('admin.carousels');
    Route::post('/admin/carousels', [AdminController::class, 'storeCarousel'])->name('carousel.store');
    Route::post('/admin/carousels/{carousel}/delete', [AdminController::class, 'deleteCarousel'])->name('carousel.delete');
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/admin/categories/add', [AdminController::class, 'addCategory'])->name('category.add');
    Route::post('/admin/categories/{category}/delete', [AdminController::class, 'deleteCategory'])->name('category.delete');
    Route::get('/admin/viewProductsVendor/{store}/view' , [AdminController::class , 'viewProductsVendor'])->name('admin.viewProductsVendor');
    Route::post('/admin/viewProductsVendor/{products}/delete/product' , [AdminController::class , 'deleteProductsVendor'])->name('admin.deleteProductsVendor');
    Route::get('/admin/payment-method' , [AdminController::class , 'paymentMethod'])->name('admin.paymentMethod');
    Route::post('/admin/payment-method/add' , [AdminController::class , 'addPaymentMethod'])->name('admin.paymentMethods.add');
    
});