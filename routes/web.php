<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarterKitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\FrontController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\WizardController;
use App\Http\Controllers\Admin\InfluencesController;
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

// dashboard Routes

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('language');
Route::get('/', function(){
  return redirect('admin');
});



Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::group(['middleware' => 'auth'], function () {
      Route::get('/', [FrontController::class, 'index'])->name('dashboard');

      //users//
      Route::resource('users', UserController::class);
      Route::get('admins', [\App\Http\Controllers\Admin\UserController::class , 'showAdmins'])->name('showAdmin');
      /////  end users //////////

      ///////////////  helper works //////////////////
      Route::get('helpers', [\App\Http\Controllers\Admin\HelperController::class , 'showHelpers'])->name('index_helpers');
      Route::get('helpers-create', [\App\Http\Controllers\Admin\HelperController::class , 'create_helpers'])->name('create_helpers');
      Route::post('helpers-store', [\App\Http\Controllers\Admin\HelperController::class , 'store_helpers'])->name('store_helpers');
      Route::get('helpers-edit/{id}', [\App\Http\Controllers\Admin\HelperController::class , 'edit_helpers'])->name('edit_helpers');
      Route::patch('helpers-update/{id}', [\App\Http\Controllers\Admin\HelperController::class , 'update_helpers'])->name('update_helpers');
      Route::delete('helpers-delete/{id}', [\App\Http\Controllers\Admin\HelperController::class , 'delete_helpers'])->name('delete_helpers');
      /////////////////////// end helpers /////////////////////

      ///////////////////////  drivers /////////////////////
      Route::get('drivers', [\App\Http\Controllers\Admin\DriverController::class , 'showDrivers'])->name('index_drivers');
      Route::get('drivers-create', [\App\Http\Controllers\Admin\DriverController::class , 'create_drivers'])->name('create_drivers');
      Route::post('drivers-store', [\App\Http\Controllers\Admin\DriverController::class , 'store_drivers'])->name('store_drivers');
      Route::get('drivers-edit/{id}', [\App\Http\Controllers\Admin\DriverController::class , 'edit_drivers'])->name('edit_drivers');
      Route::patch('drivers-update/{id}', [\App\Http\Controllers\Admin\DriverController::class , 'update_drivers'])->name('update_drivers');
      Route::delete('drivers-delete/{id}', [\App\Http\Controllers\Admin\DriverController::class , 'delete_drivers'])->name('delete_drivers');
      /////////////////////// end helpers /////////////////////
      ///////////////////////  end drivers /////////////////////

      //roles//
      Route::resource('roles', RoleController::class);
      //end roles//


      //areas //
      Route::get('cities', [\App\Http\Controllers\Admin\CityController::class , 'index'])->name('city_index');
      Route::get('cities-form', [\App\Http\Controllers\Admin\CityController::class , 'create']);
      Route::post('cities-store', [\App\Http\Controllers\Admin\CityController::class , 'store'])->name('store_city');
      Route::get('cities-edit/{id}', [\App\Http\Controllers\Admin\CityController::class , 'edit'])->name('edit_city');
      Route::patch('cities-update/{id}', [\App\Http\Controllers\Admin\CityController::class , 'update'])->name('update_city');
      Route::delete('cities-delete/{id}', [\App\Http\Controllers\Admin\CityController::class , 'destroy'])->name('delete_city');
      //end areas//

      //countries //
      Route::get('areas', [\App\Http\Controllers\Admin\AreaController::class , 'index'])->name('areas_index');
      Route::get('areas-form', [\App\Http\Controllers\Admin\AreaController::class , 'create']);
      Route::post('areas-store', [\App\Http\Controllers\Admin\AreaController::class , 'store'])->name('store_area');
      Route::get('areas-edit/{id}', [\App\Http\Controllers\Admin\AreaController::class , 'edit']);
      Route::Patch('areas-update/{id}', [\App\Http\Controllers\Admin\AreaController::class , 'update'])->name('update_area');
      Route::delete('areas-delete/{id}', [\App\Http\Controllers\Admin\AreaController::class , 'destroy'])->name('destroy_area');
      //end countries//

      //messages //
      Route::get('messages', [\App\Http\Controllers\Admin\MessageController::class , 'index'])->name('messages_index');
      Route::delete('messages-delete/{id}', [\App\Http\Controllers\Admin\MessageController::class , 'delete'])->name('delete_message');
      //end messages//

      //notification //
      Route::get('notification', [\App\Http\Controllers\Admin\NotificationController::class , 'index']);
      //end notification//


      //onboarding //
      Route::get('onboarding', [\App\Http\Controllers\Admin\OnboardingController::class , 'index'])->name('index_onboarrd');
      Route::get('onboarding-form', [\App\Http\Controllers\Admin\OnboardingController::class , 'create']);
      Route::post('onboarding-store', [\App\Http\Controllers\Admin\OnboardingController::class , 'store'])->name('store_onboard');
      Route::get('onboarding-edit/{id}', [\App\Http\Controllers\Admin\OnboardingController::class , 'edit'])->name('edit_onboard');
      Route::post('onboarding-update/{id}', [\App\Http\Controllers\Admin\OnboardingController::class , 'update'])->name('update_onboard');
      Route::delete('onboarding-delete/{id}', [\App\Http\Controllers\Admin\OnboardingController::class , 'destroy'])->name('delete_onboard');
      //end onboarding//

      //order  //
      Route::get('end-order', [\App\Http\Controllers\Admin\OrderController::class , 'end_order']);
      Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class , 'index'])->name('orders_index');
      Route::get('order-edit/{id}', [\App\Http\Controllers\Admin\OrderController::class , 'order_edit'])->name('order-edit');
      Route::post('order-Update/{id}', [\App\Http\Controllers\Admin\OrderController::class , 'order_update'])->name('order-update');
      Route::get('order-view/{id}', [\App\Http\Controllers\Admin\OrderController::class , 'order_view'])->name('order-view');;
      Route::get('order-delete/{id}', [\App\Http\Controllers\Admin\OrderController::class , 'order_delete']);
      Route::get('SearchInEndOrders', [\App\Http\Controllers\Admin\SearchSortController::class , 'SearchSort'])->name('SearchSort');
      Route::get('SearchInOrders', [\App\Http\Controllers\Admin\SearchSortController::class , 'SearchSortOrders'])->name('SearchSortOrders');
      Route::post('addItemToOrder/{id}', [\App\Http\Controllers\Admin\OrderController::class , 'addItem'])->name('addItem');
      Route::post('updateItemOrder/{id}', [\App\Http\Controllers\Admin\OrderController::class , 'updateCart'])->name('updateCartOrder');
      Route::get('deleteCartOrder/{id}', [\App\Http\Controllers\Admin\OrderController::class , 'deleteCart'])->name('deleteCartOrder');

      //end order//

      /////// order Places
      Route::get('order-places', [\App\Http\Controllers\Admin\OrderPlaceController::class , 'order_places'])->name('order_places_index');
      Route::get('order-places-form', [\App\Http\Controllers\Admin\OrderPlaceController::class , 'order_places_create']);
      Route::post('order-places-store', [\App\Http\Controllers\Admin\OrderPlaceController::class , 'order_places_store'])->name('order_places_store');
      Route::get('order-places-edit/{id}', [\App\Http\Controllers\Admin\OrderPlaceController::class , 'order_places_edit']);
      Route::patch('order-places-update/{id}', [\App\Http\Controllers\Admin\OrderPlaceController::class , 'order_places_update'])->name('order_places_update');
      Route::delete('order-places-delete/{id}', [\App\Http\Controllers\Admin\OrderPlaceController::class , 'order_places_destroy'])->name('order_places_delete');
      /// end order places



      // profile///
      Route::get('profile/{id}', [\App\Http\Controllers\Admin\ProfileController::class , 'profile'])->name('profile_route');
      Route::post('payAll/{id}', [\App\Http\Controllers\Admin\ProfileController::class , 'payAll'])->name('payAll_route');
      Route::post('payPart/{id}', [\App\Http\Controllers\Admin\ProfileController::class , 'payPart'])->name('payPart_route');
      //end profile//

      // question///
      Route::get('question', [\App\Http\Controllers\Admin\QuestionController::class , 'index'])->name('ques_index');
      Route::get('question-form', [\App\Http\Controllers\Admin\QuestionController::class , 'create'])->name('ques_create');
      Route::post('question-store', [\App\Http\Controllers\Admin\QuestionController::class , 'storeQues'])->name('question_store');
      Route::get('question-edit/{id}', [\App\Http\Controllers\Admin\QuestionController::class , 'editQues'])->name('question_edit');
      Route::patch('question-update/{id}', [\App\Http\Controllers\Admin\QuestionController::class , 'updateQues'])->name('question_update');
      Route::delete('question-delete/{id}', [\App\Http\Controllers\Admin\QuestionController::class , 'deleteQues'])->name('question_delete');
      //end question//


      //activity log//
      Route::get('activity', [ActivityLogController::class, 'logs'])->name('logs_index');
      Route::delete('delete_activity/{id}', [ActivityLogController::class, 'logs_delete'])->name('delete_logs');
      //end activity log//

      //categories//
      Route::resource('categories', CategoryController::class);
      //end categories//



      //Items//
      Route::resource('items', ItemController::class);
      Route::post('import', [ItemController::class, 'import'])->name('importExcel');
      Route::get('providers', [\App\Http\Controllers\Admin\ProvidersController::class, 'getProviders'])->name('getProviders');
      Route::post('storeProviders', [\App\Http\Controllers\Admin\ProvidersController::class, 'storeProviders'])->name('providerSave');
      //end Items//

      /// Banner //
      Route::get('banners', [\App\Http\Controllers\Admin\BannerController::class, 'getBanners'])->name('getBanners');
      Route::get('getBanners', [\App\Http\Controllers\Admin\BannerController::class, 'addBanners'])->name('addBanners');
      Route::post('storeBanners', [\App\Http\Controllers\Admin\BannerController::class, 'StoreBanner'])->name('storeBanners');
      Route::delete('deleteBanners/{id}', [\App\Http\Controllers\Admin\BannerController::class, 'destroyBanner'])->name('deleteBanners');
     /////end   banners ///

      ///////  points ///
      Route::get('points', [\App\Http\Controllers\Admin\PointsController::class, 'getPoints'])->name('getPoints');
      Route::post('storePoints', [\App\Http\Controllers\Admin\PointsController::class, 'storePoints'])->name('storePoints');

      //// end points ////




    });
});
