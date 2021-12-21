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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/******  Vehicle ********/
Route::post('vehicle/login', 'VehicleApiController@apiLogin');
Route::post('vehicle/register', 'VehicleApiController@apiRegister');
Route::post('vehicle/check_otp', 'VehicleApiController@apiCheckOtp');
Route::post('vehicle/resend_otp', 'VehicleApiController@apiResendOtp');
Route::post('vehicle/forgot_password', 'VehicleApiController@apiForgotPassword');
Route::post('user_login', 'UserApiController@apiUserLogin');
Route::post('user_register', 'UserApiController@apiUserRegister');
Route::post('check_otp', 'UserApiController@apiCheckOtp');
Route::get('vehicle/vehicle_setting', 'VehicleApiController@apiVehicleSetting');

Route::middleware('auth:api')->prefix('vehicle')->group(function () {
    /* ---- Vehicle ---- */
    //Menu
    Route::get('menu', 'VehicleApiController@apiMenu');
    Route::post('create_menu', 'VehicleApiController@apiCreateMenu');
    Route::get('edit_menu/{menu_id}', 'VehicleApiController@apiEditMenu');
    Route::post('update_menu/{menu_id}', 'VehicleApiController@apiUpdateMenu');
    Route::get('single_menu/{menu_id}', 'VehicleApiController@apiSingleMenu');


    //Submenu
    Route::get('submenu/{menu_id}', 'VehicleApiController@apiSubmenu');
    Route::post('create_submenu', 'VehicleApiController@apiCreateSubmenu');
    Route::get('edit_submenu/{submenu_id}', 'VehicleApiController@apiEditSubmenu');
    Route::post('update_submenu/{submenu_id}', 'VehicleApiController@apiUpdateSubmenu');
    Route::get('single_submenu/{submenu_id}', 'VehicleApiController@apiSingleSubmenu');

    //Custimization
    Route::get('custimization/{submenu_id}', 'VehicleApiController@apiCustimization');
    Route::post('create_custimization', 'VehicleApiController@apiCreateCustimization');
    Route::get('edit_custimization/{custimization_id}', 'VehicleApiController@apiEditCustimization');
    Route::post('update_custimization/{custimization_id}', 'VehicleApiController@apiUpdateCustimization');
    Route::get('delete_custimization/{custimization_id}', 'VehicleApiController@apiDeleteCustimization');

    //Delivery timeslot
    Route::get('edit_deliveryTimeslot', 'VehicleApiController@apiEditDeliveryTimeslot');
    Route::post('update_deliveryTimeslot', 'VehicleApiController@apiUpdateDeliveryTimeslot');

    //Pickup timeslot
    Route::get('edit_PickUpTimeslot', 'VehicleApiController@apiEditPickUpTimeslot');
    Route::post('update_PickUpTimeslot', 'VehicleApiController@apiUpdatePickUpTimeslot');

    //Selling timeslot
    Route::get('edit_SellingTimeslot', 'VehicleApiController@apiEditSellingTimeslot');
    Route::post('update_SellingTimeslot', 'VehicleApiController@apiUpdateSellingTimeslot');

    //Discount
    Route::get('discount', 'VehicleApiController@apiDiscount');
    Route::post('create_discount', 'VehicleApiController@apiCreateDiscount');
    Route::get('edit_discount/{discount_id}', 'VehicleApiController@apiEditDiscount');
    Route::post('update_discount/{discount_id}', 'VehicleApiController@apiUpdateDiscount');

    //Bank Details
    Route::get('show_bank_detail', 'VehicleApiController@apiShowBankDetails');
    Route::post('add_bank_detail', 'VehicleApiController@apiAddBankDetails');
    Route::get('edit_bank_detail', 'VehicleApiController@apiEditBankDetails');
    Route::post('update_bank_detail', 'VehicleApiController@apiUpdateBankDetails');

    //Finance Details
    Route::get('last_7_days', 'VehicleApiController@apiLast7Days');
    Route::get('current_month', 'VehicleApiController@apiCurrentMonth');
    Route::post('specific_month', 'VehicleApiController@apiMonth');
    Route::get('finance_details', 'VehicleApiController@apiFinanceDetails');
    Route::get('cash_balance', 'VehicleApiController@apiCashBalance');
    Route::get('insights', 'VehicleApiController@apiInsights');

    //Order
    Route::get('order', 'VehicleApiController@apiOrder');
    Route::post('create_order', 'VehicleApiController@apiCreateOrder');

    // change status
    Route::post('change_status', 'VehicleApiController@apiChangeStatus');

    //user
    Route::get('user', 'VehicleApiController@apiUser');
    Route::post('create_user', 'VehicleApiController@apiCreateUser');

    //User Address
    Route::get('user_address/{user_id}', 'VehicleApiController@apiUserAddress');
    Route::post('create_user_address', 'VehicleApiController@apiCreateUserAddress');

    /* ---- User Password ---- */
    Route::post('change_password', 'VehicleApiController@apiChangePassword');
    Route::post('forgot_password', 'VehicleApiController@apiChangePassword');

    // Faq
    Route::get('faq', 'VehicleApiController@apiFaq');

    Route::get('vehicle_login', 'VehicleApiController@apiVehicleLogin');
    Route::post('update_profile', 'VehicleApiController@apiUpdateProfile');
});

/******  User ********/
Route::middleware('auth:api')->group(function () {
    Route::post('book_order', 'UserApiController@apiBookOrder');
    Route::get('show_order', 'UserApiController@apiShowOrder');
    Route::post('update_user', 'UserApiController@apiUpdateUser');
    Route::post('update_image', 'UserApiController@apiUpdateImage');
    Route::post('faviroute', 'UserApiController@apiFaviroute');
    Route::post('rest_faviroute', 'UserApiController@apiRestFaviroute');
    Route::get('user_address', 'UserApiController@apiUserAddress');
    Route::post('add_address', 'UserApiController@apiAddAddress');
    Route::get('edit_address/{address_id}', 'UserApiController@apiEditAddress');
    Route::post('update_address/{address_id}', 'UserApiController@apiUpdateAddress');
    Route::get('remove_address/{address_id}', 'UserApiController@apiRemoveAddress');
    Route::post('cancel_order', 'UserApiController@apiCancelOrder');
    Route::get('single_order/{order_id}', 'UserApiController@apiSingleOrder');
    Route::post('apply_promo_code', 'UserApiController@apiApplyPromoCode');
    Route::post('add_review', 'UserApiController@apiAddReview');
    // Route::post('add_feedback','UserApiController@apiAddFeedback');
    Route::get('user_order_status', 'UserApiController@apiUserOrderStatus');
    Route::post('refund', 'UserApiController@apirefund');
    Route::post('bank_details', 'UserApiController@apiBankDetails');
    Route::get('tracking/{order_id}', 'UserApiController@apiTracking');
    Route::get('user_balance', 'UserApiController@apiUserBalance');
    Route::get('wallet_balance', 'UserApiController@apiWalletBalance');
    Route::post('add_balance', 'UserApiController@apiUserAddBalance');
    Route::post('user_change_password', 'UserApiController@apiChangePassword');
});

Route::post('add_feedback', 'UserApiController@apiAddFeedback');

Route::get('tax', 'UserApiController@apiTax');
Route::post('user_forgot_password', 'UserApiController@apiForgotPassword');
Route::post('send_otp', 'UserApiController@apiSendOtp');
Route::post('filter', 'UserApiController@apiFilter');
Route::get('vehicletype_vehicle/{id}', 'UserApiController@apiVehicletypeVehicle');
Route::post('search', 'UserApiController@apiSearch');

Route::post('near_by', 'UserApiController@apiNearBy');
Route::get('menu_category/{vehicle_id}', 'UserApiController@apiMenuCategory');
Route::get('vehicletype', 'UserApiController@apiVehicletype');
Route::post('vehicle', 'UserApiController@apiVehicle');
Route::get('single_vehicle/{vehicle_id}', 'UserApiController@apiSingleVehicle');
Route::get('menu/{vehicle_id}', 'UserApiController@apiMenu');
Route::get('promo_code/{vehicle_id}', 'UserApiController@apiPromoCode');
Route::get('faq', 'UserApiController@apiFaq');
Route::get('banner', 'UserApiController@apiBanner');
Route::get('single_menu/{menu_id}', 'UserApiController@apiSingleMenu');
Route::get('setting', 'UserApiController@apiSetting');
Route::get('order_setting', 'UserApiController@apiOrderSetting');
Route::get('payment_setting', 'UserApiController@apiPaymentSetting');
Route::post('scooter_rest', 'UserApiController@apiScooterRest');
Route::post('bike_rest', 'UserApiController@apiBikeRest');
Route::post('top_rest', 'UserApiController@apiTopRest');
Route::post('explore_rest', 'UserApiController@apiExploreRest');

/******  Driver ********/
Route::post('driver/driver_login', 'DriverApiController@apiDriverLogin');
Route::post('driver/driver_check_otp', 'DriverApiController@apiDriverCheckOtp');
Route::post('driver/driver_register', 'DriverApiController@apiDriverRegister');
Route::post('driver/driver_change_password', 'DriverApiController@apiDriverChangePassword');
Route::post('driver/driver_resendOtp', 'DriverApiController@apiReSendOtp');
Route::get('driver/driver_faq', 'DriverApiController@apiDriverFaq');
Route::get('driver/driver_setting', 'DriverApiController@apiDriverSetting');

Route::post('driver/forgot_password_otp', 'DriverApiController@apiForgotPasswordOtp');
Route::post('driver/forgot_password_check_otp', 'DriverApiController@apiForgotPasswordCheckOtp');
Route::post('driver/forgot_password', 'DriverApiController@apiForgotPassword');

Route::middleware('auth:driverApi')->prefix('driver')->group(function () {
    Route::post('set_location', 'DriverApiController@apiSetLocation');
    Route::get('driver_order', 'DriverApiController@apiDriverOrder');
    Route::post('status_change', 'DriverApiController@apiStatusChange');
    Route::get('driver', 'DriverApiController@apiDriver');

    Route::post('update_driver', 'DriverApiController@apiUpdateDriver');
    Route::post('update_driver_image', 'DriverApiController@apiDriverImage');
    Route::get('order_history', 'DriverApiController@apiOrderHistory');
    Route::get('order_earning', 'DriverApiController@apiOrderEarning');
    Route::get('earning', 'DriverApiController@apiEarningHistory');

    Route::post('update_document', 'DriverApiController@apiUpdateVehical');
    Route::get('notification', 'DriverApiController@apiDriverNotification');
    Route::post('update_lat_lang', 'DriverApiController@apiUpdateLatLang');
    Route::post('delivery_person_change_password', 'DriverApiController@apiDeliveryPersonChangePassword');

    Route::get('delivery_zone', 'DriverApiController@apiDeliveryZone');
});