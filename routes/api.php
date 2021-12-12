<?php

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


Route::post('/register', [\App\Http\Controllers\Api\Customer\AuthCustomerController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\Customer\AuthCustomerController::class, 'login']);
Route::post('/loginWith', [\App\Http\Controllers\Api\Customer\AuthCustomerController::class, 'registerWith']);


////////////////////////////////// Onboarding /////////////////////////////////////////////////////////////////////
Route::get('/allOnboarding' , [\App\Http\Controllers\Api\Onboarding\OnboardController::class  , 'viewAll']);
////////////////////////////////// Onboarding /////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('mainPage' , [\App\Http\Controllers\Api\MainPage\MainPageController::class  , 'Main']);

Route::get('categories' , [\App\Http\Controllers\Api\Categories\CategoriesController::class  , 'index']);
Route::get('showCategory/{id}' , [\App\Http\Controllers\Api\Categories\CategoriesController::class  , 'show']);
Route::get('showCategory/{id}/items' , [\App\Http\Controllers\Api\Categories\CategoriesController::class  , 'CategoryItems']);
////////////////////////////////////// end Category //////////////////////////////////////////////////////////////////////////////

Route::middleware('auth:sanctum')->group( function () {


      /////////////////////////////////////// Customer /////////////////////////////////////////////
      Route::post('updateInfo' , [\App\Http\Controllers\Api\Customer\UpdateInformationController::class , 'updateCustomer']);
      Route::post('updateImage' , [\App\Http\Controllers\Api\Customer\UpdateInformationController::class , 'updateImage']);
      Route::post('deleteImage' , [\App\Http\Controllers\Api\Customer\UpdateInformationController::class , 'deleteImage']);
      Route::post('updatePassword' , [\App\Http\Controllers\Api\Customer\UpdateInformationController::class , 'updatePassword']);
      ///////////////////// main page /////////////////////////////////////////////////////////////////////////////////
      Route::get('points' , [\App\Http\Controllers\Api\MainPage\MainPageController::class  , 'points']);
      Route::post('replacePoints' , [\App\Http\Controllers\Api\MainPage\MainPageController::class  , 'replacePoints']);
      ///////////////////// main page /////////////////////////////////////////////////////////////////////////////////

      ///////////////////// do review  /////////////////////////////////////////////////////////////////////////////////
      Route::post('DoReview' , [\App\Http\Controllers\Api\Customer\DoReviewController::class  , 'doReview']);
      Route::post('sendMessage' , [\App\Http\Controllers\Api\Customer\DoReviewController::class  , 'sendMessage']);
      ///////////////////// do review  /////////////////////////////////////////////////////////////////////////////////


  ///////////////////////// orders /////////////////////////////////////////////////////////////////////////////////////////////////
      Route::get('myOrders' , [\App\Http\Controllers\Api\Orders\OrdersController::class  , 'myOrder']);
      Route::get('showMyOrder/{id}' , [\App\Http\Controllers\Api\Orders\OrdersController::class  , 'showOrder']);
      Route::get('PreparingOrders' , [\App\Http\Controllers\Api\Orders\OrdersController::class  , 'Preparing']);
      Route::get('CancelledOrders' , [\App\Http\Controllers\Api\Orders\OrdersController::class  , 'Cancelled']);
      Route::get('DeliveredOrders' , [\App\Http\Controllers\Api\Orders\OrdersController::class  , 'Delivered']);
      ///////////////////////// end orders /////////////////////////////////////////////////////////////////////////////////////////////////


    //////////////////////////////////// orderPlace  ///////////////////////////////////////////////////////////////////
      Route::get('OrderPalaces' , [\App\Http\Controllers\Api\OrderPlace\OrderPlaceController::class , 'OrderPlace']);
    ////////////////////////////////////end orderPlace  ///////////////////////////////////////////////////////////////////


  //////////////////////////////////// orderPlace  ///////////////////////////////////////////////////////////////////
  Route::get('Banners' , [\App\Http\Controllers\Api\Banner\BannerController::class , 'getBanners']);
  ////////////////////////////////////end orderPlace  ///////////////////////////////////////////////////////////////////


  //////////////////////////////////// shoppingCart ///////////////////////////////////////////////////////////////////
      Route::get('myCart' , [\App\Http\Controllers\Api\ShoppingCart\ShoppingCartController::class , 'myCart']);
      Route::post('addToCart' , [\App\Http\Controllers\Api\ShoppingCart\ShoppingCartController::class , 'addToCart']);
      Route::post('deleteFromCart/{id}' , [\App\Http\Controllers\Api\ShoppingCart\ShoppingCartController::class , 'deleteFromCart']);
    ////////////////////////////////////end shoppingCart ///////////////////////////////////////////////////////////////////


      //////////////////////////////////// order operations  ///////////////////////////////////////////////////////////////////
      Route::post('FollowOperationShopping' , [\App\Http\Controllers\Api\OrderOperation\OrderOperationController::class, 'FollowOperationShopping']);
      Route::post('ensureOrder/{id}' , [\App\Http\Controllers\Api\OrderOperation\OrderOperationController::class , 'ensureOrder']);
      //////////////////////////////////// order operations  ///////////////////////////////////////////////////////////////////

     //////////////////////////////////// Favorite operations  ///////////////////////////////////////////////////////////////////
      Route::get('getMyFavorite' , [\App\Http\Controllers\Api\Favorite\FavoriteController::class, 'getMyFavorite']);
      Route::post('addFavorite' ,  [\App\Http\Controllers\Api\Favorite\FavoriteController::class,  'addFavorite']);
      Route::post('deleteFavorite/{id}' , [\App\Http\Controllers\Api\Favorite\FavoriteController::class,  'deleteFavorite']);
   //////////////////////////////////// end Favorite operations  ///////////////////////////////////////////////////////////////////


});




////////////////////////////////////// driver /////////////////////////////
