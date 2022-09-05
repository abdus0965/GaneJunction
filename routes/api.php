<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController; 
use App\Http\Controllers\Api\LabCheckController;
use App\Http\Controllers\Api\AddressController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route for admin
Route::group(['prefix' => 'admin','middleware'=>['auth','admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
});

//route for vendor
Route::group(['prefix' => 'vendor','middleware'=>['auth','vendor']], function () {
    Route::get('dashboard', 'DashboardController@vendor')->name('vendor.dashboard');
});

//route for user
Route::group(['prefix' => 'user','middleware'=>['auth','user']], function () {
    Route::get('dashboard', 'DashboardController@user')->name('user.dashboard');
});


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('/update/{id}', [AuthController::class, 'updatePost']);
Route::post('/edit/{id}', [AuthController::class, 'editUser']);
Route::post('changePassword', [AuthController::class, 'changePasswordPost']);
Route::post('logout', [AuthController::class, 'logout']);

//address controller

Route::group(['prefix' => 'address'], function () {
    Route::get('list', [AddressController::class, 'getCountry']);
});

// roles 

Route::group(['prefix' => 'roles'], function () {
    Route::get('/list', [RolesController::class, 'index']);
    Route::post('/add', [RolesController::class, 'store']);
    Route::post('/update', [RolesController::class, 'update']);
    Route::post('/remove', [RolesController::class, 'delete']);
    Route::post('/addvendor', [RolesController::class, 'storevendor']);
    Route::post('/addvendor-role', [RolesController::class, 'storevendorrole']);
    Route::post('/add-consultants', [RolesController::class, 'storeconsultants']);
});

//member

Route::group(['prefix' => 'membership'], function () {
    Route::post('/addmember', [MembershipController::class, 'addmember']);
    Route::post('/add', [MembershipController::class, 'store']);
    Route::post('/update/{id}', [MembershipController::class, 'update']); 
    Route::post('/edit/{id}', [MembershipController::class, 'editMember']);
    Route::get('/list', [MembershipController::class, 'GetMemberList']);
   
});

//product

Route::group(['prefix' => 'product'], function () {
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('/update/{id}', [ProductController::class, 'update']); 
    Route::post('/edit/{id}', [ProductController::class, 'editProduct']);
    Route::post('/destroy/{id}', [ProductController::class, 'destroy']);

    Route::post('/add', [ProductController::class, 'AddCategory']);
    Route::post('/add-brand', [ProductController::class, 'AddBrand']);
    Route::post('/add-inventory', [ProductController::class, 'AddInventory']);
    Route::post('/add-discount', [ProductController::class, 'AddDiscount']);
    Route::post('/add-accessories', [ProductController::class, 'AddAccessories']);
    Route::post('/add-shipping', [ProductController::class, 'AddShipping']);
    Route::post('/add-seo', [ProductController::class, 'AddSEO']);
    Route::post('/add-gallery', [ProductController::class, 'AddProductGallery']);
   
});

//Labcheck

Route::group(['prefix' => 'labcheck'], function () {
    Route::post('/store', [LabCheckController::class, 'store']);
    Route::post('/add', [LabCheckController::class, 'AddLabcheckCategory']);
    Route::get('/list', [LabCheckController::class, 'getLabcheckCategory']);
    Route::post('/add-shipping', [LabCheckController::class, 'AddShipping']);
    Route::post('/add-accessories', [LabCheckController::class, 'AddAccessories']);
    Route::post('/add-seo', [LabCheckController::class, 'AddSEO']);
    Route::post('/add-gallery', [LabCheckController::class, 'AddLabcheckGallery']);
   
});

//cart

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', [CartController::class, 'AddtoCart']); 
    Route::post('/add-order-item', [CartController::class, 'AddOrderItem']);
    Route::post('/add-order-details', [CartController::class, 'AddOrderDetails']);
    Route::post('/add-payment-details', [CartController::class, 'PaymentDetails']);
   
});

