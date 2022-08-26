<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController; 
use App\Http\Controllers\Api\LabCheckController;

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


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('updateuser', [UserController::class, 'update']);
Route::post('changePassword', [UserController::class, 'changePasswordPost']);
Route::post('logout', [UserController::class, 'logout']);
 
Route::group(['middleware' => 'auth:api'], function(){
Route::post('user-details', [UserController::class, 'userDetails']);
});

Route::group(['prefix' => 'roles'], function () {
    Route::get('/list', [RolesController::class, 'index']);
    Route::post('/add', [RolesController::class, 'store']);
    Route::post('/update', [RolesController::class, 'update']);
    Route::post('/remove', [RolesController::class, 'delete']);
    Route::post('/addvendor', [RolesController::class, 'storevendor']);
    Route::post('/addvendor-role', [RolesController::class, 'storevendorrole']);
    Route::post('/add-consultants', [RolesController::class, 'storeconsultants']);
});

Route::group(['prefix' => 'membership'], function () {
    Route::post('/addmember', [MembershipController::class, 'addmember']);
    Route::post('/add', [MembershipController::class, 'store']);
    Route::get('/list', [MembershipController::class, 'GetMemberList']);
   
});

Route::group(['prefix' => 'product'], function () {
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('/add', [ProductController::class, 'AddCategory']);
    Route::post('/add-brand', [ProductController::class, 'AddBrand']);
    Route::post('/add-inventory', [ProductController::class, 'AddInventory']);
    Route::post('/add-discount', [ProductController::class, 'AddDiscount']);
    Route::post('/add-accessories', [ProductController::class, 'AddAccessories']);
    Route::post('/add-shipping', [ProductController::class, 'AddShipping']);
    Route::post('/add-seo', [ProductController::class, 'AddSEO']);
    Route::post('/add-gallery', [ProductController::class, 'AddProductGallery']);
   
});

Route::group(['prefix' => 'labcheck'], function () {
    Route::post('/store', [LabCheckController::class, 'store']);
    Route::post('/add', [LabCheckController::class, 'AddLabcheckCategory']);
    Route::get('/list', [LabCheckController::class, 'getLabcheckCategory']);
    Route::post('/add-shipping', [LabCheckController::class, 'AddShipping']);
    Route::post('/add-accessories', [LabCheckController::class, 'AddAccessories']);
    Route::post('/add-seo', [LabCheckController::class, 'AddSEO']);
    Route::post('/add-gallery', [LabCheckController::class, 'AddLabcheckGallery']);
   
});

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', [CartController::class, 'AddtoCart']); 
    Route::post('/add-order-item', [CartController::class, 'AddOrderItem']);
    Route::post('/add-order-details', [CartController::class, 'AddOrderDetails']);
    Route::post('/add-payment-details', [CartController::class, 'PaymentDetails']);
   
});