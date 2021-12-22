<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VehicletypeController;
use App\Http\Controllers\Admin\DeliveryZoneController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\DeliveryPersonController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SubMenuController;
use App\Http\Controllers\Admin\VehicleDiscountController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\StateManagementController;
use App\Http\Controllers\Admin\CityManagementController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\SubmenuCustomizationTypeController;
use App\Http\Controllers\Admin\VehicleBankDetailController;
use App\Http\Controllers\Admin\SubmenuCustomizationItemController;
use App\Http\Controllers\Vehicle\VehicleSettingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Vehicle\CustimizationTypeController;
use App\Http\Controllers\Vehicle\VehiclesController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DeliveryZoneAreaController;
use App\Http\Controllers\Admin\NotificationTemplateController;
use App\Http\Controllers\Admin\RefaundController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\multiDeleteController;

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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return "Cache is cleared";
});

Auth::routes();

Route::get('/', [AdminController::class, 'showLogin']);
Route::get('/import', [AdminController::class, 'import'])->name('import');

Route::get('FlutterWavepayment/{id}',[UserApiController::class,'FlutterWavepayment']);
Route::get('transction_verify/{id}',[UserApiController::class,'transction_verify']);

Route::post('confirm_login', [AdminController::class, 'confirm_login']);
Route::get('admin/forgot_password',[AdminController::class, 'forgot_password']);
Route::post('admin/admin_forgot_password',[AdminController::class, 'admin_forgot_password']);

//Admin
Route::middleware(['auth'])->prefix('admin')->group(function ()
{
    Route::get('orderChart',[HomeController::class,'orderChart']);
    Route::post('orderChart',[HomeController::class,'orderChart']);

    Route::get('earningChart',[HomeController::class,'earningChart']);
    Route::post('earningChart',[HomeController::class,'earningChart']);
    Route::get('topItems',[HomeController::class,'topItems']);
    Route::get('avarageItems',[HomeController::class,'avarageItems']);

    // Send Custom Notification
    Route::get('send_notification',[NotificationTemplateController::class,'send_notification']);
    Route::post('send_notification_user',[NotificationTemplateController::class,'send_notification_user']);
    Route::post('send_notification_vehicle',[NotificationTemplateController::class,'send_notification_vehicle']);

    Route::resources([
        'delivery_person' => Admin\DeliveryPersonController::class,
        'delivery_zone' => Admin\DeliveryZoneController::class,
        'promo_code' => Admin\PromoCodeController::class,
        'vehicle' => Admin\VehicleController::class,
        'map' => Admin\MapController::class,

        'vehicletype' => Admin\VehicletypeController::class,
        'banner' => Admin\BannerController::class,
        'roles' => Admin\RoleController::class,
        'user' => Admin\UserController::class,
        'menu' => Admin\MenuController::class,
        'submenu' => Admin\SubMenuController::class,
        'faq' => Admin\FaqController::class,
        'notification_template' => Admin\NotificationTemplateController::class,
        'user_address' => Admin\UserAddressController::class,
        'order' => Admin\OrderController::class,
        'language' => Admin\LanguageController::class,
        'refund' => Admin\RefaundController::class,
        'tax' => Admin\TaxController::class,
        'livelocation' => Admin\LivelocationController::class,

    ]);

    Route::get('user_bank_details/{id}',[RefaundController::class,'user_bank_details']);
    Route::post('refund/refund_status',[RefaundController::class,'status']);
    Route::post('refund/refaundStripePayment',[RefaundController::class,'refaundStripePayment']);
    Route::post('refund/confirm_refund',[RefaundController::class,'confirm_refund']);

    Route::get('delivery_person_finance_details/{id}',[DeliveryPersonController::class,'finance_details']);
    Route::post('driver_make_payment',[DeliveryPersonController::class,'driver_make_payment']);
    Route::post('driver_settle',[DeliveryPersonController::class,'driver_settle']);
    Route::get('show_driver_settle_details/{duration}/{driver_id}',[DeliveryPersonController::class,'show_driver_settle_details']);
    Route::post('/driver_fluterPayment',[DeliveryPersonController::class,'driver_fluterPayment']);
    Route::get('/driver_transction/{duration}/{driver_id}',[DeliveryPersonController::class,'driver_transction']);

    //Delivery zone area
    Route::get('delivery_zone_area/{id}', [DeliveryZoneAreaController::class,'index']);
    Route::resource('delivery_zone_area', Admin\DeliveryZoneAreaController::class)->except([
        'index','show'
    ]);

    Route::get('delivery_zone_area/delivery_zone_area_map/{id}',[DeliveryZoneAreaController::class,'delivery_zone_area_map']);
    Route::get('order/invoice/{id}', [OrderController::class,'invoice']);
    Route::get('order/invoice_print/{id}', [OrderController::class,'invoice_print']);
    Route::get('/vehicle_discount/{id}', [VehicleDiscountController::class,'index']);
    Route::get('/vehicle_discount/create/{id}', [VehicleDiscountController::class,'create']);
    Route::resource('vehicle_discount', Admin\VehicleDiscountController::class)->except([
        'index','create'
    ]);
    Route::get('/vehicle_discounts', [VehicleDiscountController::class,'index']);

    // Customization type
    Route::get('/customization_type/{id}', [SubmenuCustomizationTypeController::class,'index']);
    Route::get('/customization_type/create/{id}', [SubmenuCustomizationTypeController::class,'create']);
    Route::resource('customization_type', Admin\SubmenuCustomizationTypeController::class)->except([
        'index','create'
    ]);
    Route::post('customization_type/updateItem',[SubmenuCustomizationTypeController::class,'updateItem']);

    //Customization item
    Route::get('/customization_item/{id}', [SubmenuCustomizationItemController::class,'index']);
    Route::get('/customization_item/create/{id}', [SubmenuCustomizationItemController::class,'create']);
    Route::resource('customization_item', Admin\SubmenuCustomizationItemController::class)->except([
        'index','create'
    ]);

    Route::get('/edit_delivery_time/{id}' , [VehicleController::class,'edit_delivery_time']);
    Route::get('/edit_pick_up_time/{id}',[VehicleController::class,'edit_pick_up_time']);
    Route::get('/edit_selling_timeslot/{id}',[VehicleController::class,'edit_selling_timeslot']);
    Route::post('/update_delivery_time',[VehicleController::class,'update_delivery_time']);
    Route::post('/update_pick_up_time',[VehicleController::class,'update_pick_up_time']);
    Route::post('/update_selling_timeslot',[VehicleController::class,'update_selling_timeslot']);
    Route::get('/finance_details/{id}',[VehicleController::class,'finance_details']);
    Route::get('/rattings/{id}',[VehicleController::class,'rattings']);
    Route::post('/make_payment',[VehicleController::class,'make_payment']);
    Route::post('/stripePayment',[VehicleController::class,'stripePayment']);
    Route::post('/fluterPayment',[VehicleController::class,'fluterPayment']);
    Route::get('/transction/{duration}/{vehicle_id}',[VehicleController::class,'transction']);
    Route::get('/show_settalement/{duration}',[VehicleController::class,'show_settalement']);

    Route::get('/home', [HomeController::class, 'index']);
    Route::get('admin_profile',[AdminController::class, 'admin_profile']);

    Route::post('update_admin_profile',[AdminController::class, 'update_admin_profile']);
    Route::post('update_password',[AdminController::class, 'change_password']);
    Route::get('feedback',[AdminController::class,'feedback']);

    //Setting
    Route::get('setting',[SettingController::class, 'setting']);
    Route::get('general_setting',[SettingController::class, 'general_setting']);
    Route::get('order_setting',[SettingController::class,'order_setting']);
    Route::get('delivery_person_setting',[SettingController::class,'delivery_person_setting']);

    Route::get('verification_setting',[SettingController::class,'verification_setting']);
    Route::post('update_verification_seting',[SettingController::class,'update_verification_seting']);
    Route::post('update_status',[SettingController::class,'update_status']);

    Route::post('update_general_setting',[SettingController::class, 'update_general_setting']);
    Route::post('update_order_setting',[SettingController::class, 'update_order_setting']);
    Route::post('update_delivery_person_setting',[SettingController::class, 'update_delivery_person_setting']);

    Route::post('update_privacy',[SettingController::class,'update_privacy']);
    Route::post('update_terms',[SettingController::class,'update_terms']);
    Route::post('update_help',[SettingController::class,'update_help']);
    Route::post('update_about',[SettingController::class,'update_about']);
    Route::post('update_company_details',[SettingController::class,'update_company_details']);

    Route::get('notification_setting',[SettingController::class, 'notification_setting']);
    Route::post('update_customer_notification',[SettingController::class, 'update_customer_notification']);
    Route::post('update_driver_notification',[SettingController::class, 'update_driver_notification']);
    Route::post('update_vehicle_notification',[SettingController::class, 'update_vehicle_notification']);
    Route::post('update_mail_setting',[SettingController::class, 'update_mail_setting']);

    Route::post('update_noti',[SettingController::class, 'update_noti']);

    Route::get('version_setting',[SettingController::class,'version_setting']);
    Route::get('static_pages',[SettingController::class,'static_pages']);

    Route::get('payment_setting',[SettingController::class, 'payment_setting']);
    Route::post('update_stripe_setting',[SettingController::class,'update_stripe_setting']);
    Route::post('update_version_setting',[SettingController::class,'update_version_setting']);

    Route::post('update_paypal',[SettingController::class,'update_paypal']);
    Route::post('update_razorpay',[SettingController::class,'update_razorpay']);
    Route::post('update_flutterwave',[SettingController::class,'update_flutterwave']);

    Route::get('vehicle_change_password/{id}',[VehicleController::class,'vehicle_change_password']);
    Route::post('vehicle_update_password/{id}',[VehicleController::class,'vehicle_update_password']);

    Route::get('vehicle_bank_details/{id}',[VehicleBankDetailController::class,'vehicle_bank_details']);
    Route::post('add_bank_details',[VehicleBankDetailController::class,'add_bank_details']);
    Route::post('update_bank_details/{id}',[VehicleBankDetailController::class,'update_bank_details']);
    Route::get('license_setting',[SettingController::class,'license_setting']);
    Route::post('update_license',[SettingController::class,'update_license']);

    //change status
    Route::post('delivery_zone/change_status',[DeliveryZoneController::class, 'change_status']);
    Route::post('promo_code/change_status',[PromoCodeController::class, 'change_status']);
    Route::post('delivery_person/change_status',[DeliveryPersonController::class, 'change_status']);
    Route::post('vehicletype/change_status',[VehicletypeController::class, 'change_status']);
    Route::post('user/change_status',[UserController::class, 'change_status']);
    Route::post('vehicle/change_status',[VehicleController::class, 'change_status']);
    Route::post('menu/change_status',[MenuController::class, 'change_status']);
    Route::post('submenu/change_status',[SubMenuController::class, 'change_status']);
    Route::post('menu_category/change_status',[MenuCategoryController::class, 'change_status']);
    Route::post('banner/change_status',[BannerController::class, 'change_status']);
    Route::post('language/change_status',[LanguageController::class, 'change_status']);
    Route::post('submenu/selling_timeslot',[SubMenuController::class,'selling_timeslot']);
    Route::post('settle',[App\Http\Controllers\Admin\VehicleController::class,'settle']);
    Route::post('tax/change_status', [TaxController::class,'change_status']);

    //Change password
    Route::post('change_password',[AdminController::class, 'change_password']);
    Route::get('user_report',[ReportController::class,'user_report']);
    Route::post('user_report',[ReportController::class,'user_report']);
    Route::get('order_report',[ReportController::class,'order_report']);
    Route::post('order_report',[ReportController::class,'order_report']);
    Route::get('vehicle_report',[ReportController::class,'vehicle_report']);
    Route::post('vehicle_report',[ReportController::class,'vehicle_report']);
    Route::get('wallet_withdraw_report',[ReportController::class,'wallet_withdraw_report']);
    Route::post('wallet_withdraw_report',[ReportController::class,'wallet_withdraw_report']);
    Route::get('wallet_deposit_report',[ReportController::class,'wallet_deposit_report']);
    Route::post('wallet_deposit_report',[ReportController::class,'wallet_deposit_report']);
    Route::get('driver_report',[ReportController::class,'driver_report']);
    Route::post('driver_report',[ReportController::class,'driver_report']);
    Route::get('earning_report',[ReportController::class,'earning_report']);
    Route::get('change_language/{name}',[AdminController::class,'change_language']);

    // Multi Delete
    Route::post('/vehicletype_multi_delete',[multiDeleteController::class,'vehicletype_delete']);
    Route::post('/vehicle_multi_delete',[multiDeleteController::class,'vehicle_delete']);
    Route::post('/submenu_multi_delete',[multiDeleteController::class,'submenu_delete']);
    Route::post('/menu_multi_delete',[multiDeleteController::class,'menu_delete']);
    Route::post('/order_multi_delete',[multiDeleteController::class,'order_delete']);
    Route::post('/delivery_person_multi_delete',[multiDeleteController::class,'delivery_person_delete']);
    Route::post('/delivery_zone_multi_delete',[multiDeleteController::class,'delivery_zone_delete']);
    Route::post('/promo_code_multi_delete',[multiDeleteController::class,'promo_code_delete']);
    Route::post('/user_multi_delete',[multiDeleteController::class,'user_multi_delete']);
    Route::post('/faq_multi_delete',[multiDeleteController::class,'faq_multi_delete']);
    Route::post('/banner_multi_delete',[multiDeleteController::class,'banner_multi_delete']);
    Route::post('/tax_multi_delete',[multiDeleteController::class,'tax_multi_delete']);
    Route::post('/vehicle_discount_multi_delete',[multiDeleteController::class,'vehicle_discount_multi_delete']);

    // Bulk Import
    Route::post('/submenu_import/{id}',[SubMenuController::class,'submenu_import']);

    // download PDF
    Route::get('download_pdf/{excel_file}',[AdminController::class,'download_pdf']);

    // user wallet
    Route::get('user/user_wallet/{user_id}',[UserController::class,'user_wallet']);
    Route::post('user/user_wallet/{user_id}',[UserController::class,'user_wallet']);
    Route::post('user/add_wallet',[UserController::class,'add_wallet']);
});

//Vehicle
Route::get('/vehicle/login',[VehicleSettingController::class,'login']);
Route::post('/vehicle/vehicle_confirm_login',[VehicleSettingController::class,'vehicle_confirm_login']);
Route::get('vehicle/register_vehicle',[VehicleSettingController::class,'register_vehicle']);
Route::post('vehicle/register',[VehicleSettingController::class,'register']);
Route::get('vehicle/vehicle_home',[VehicleSettingController::class,'vehicle_home']);
Route::get('vehicle/notification',[VehicleSettingController::class, 'notification']);
Route::get('vehicle/forgot_password',[VehicleSettingController::class, 'forgot_password']);
Route::post('admin/admin_forgot_password',[AdminController::class, 'admin_forgot_password']);
Route::get('vehicle/send_otp/{id}',[VehicleSettingController::class,'send_otp']);
Route::post('vehicle/check_otp',[VehicleSettingController::class,'check_otp']);

Route::middleware(['auth'])->prefix('vehicle')->group(function ()
{
    Route::get('user_report',[App\Http\Controllers\Vehicle\ReportController::class,'user_report']);
    Route::post('user_report',[App\Http\Controllers\Vehicle\ReportController::class,'user_report']);

    Route::get('order_report',[App\Http\Controllers\Vehicle\ReportController::class,'order_report']);
    Route::post('order_report',[App\Http\Controllers\Vehicle\ReportController::class,'order_report']);

    Route::get('cancel_max_order',[VehicleSettingController::class,'cancel_max_order']);
    Route::get('orderChart',[VehicleSettingController::class,'orderChart']);
    Route::get('revenueChart',[VehicleSettingController::class,'revenueChart']);
    Route::get('vehicleAvarageTime',[VehicleSettingController::class,'vehicleAvarageTime']);
    Route::get('change_password',[VehicleSettingController::class,'change_password']);
    Route::post('update_pwd',[VehicleSettingController::class,'update_pwd']);

    Route::get('vehicle/vehicle_finance_details',[App\Http\Controllers\Vehicle\VehicleDiscountController::class,'vehicle_finance_details']);
    Route::get('vehicle/delivery_timeslot',[App\Http\Controllers\Vehicle\VehicleController::class,'delivery_timeslot']);
    Route::get('vehicle/pickup_timeslot',[App\Http\Controllers\Vehicle\VehicleController::class,'pickup_timeslot']);

    Route::get('vehicle/selling_timeslot',[App\Http\Controllers\Vehicle\VehicleController::class,'selling_timeslot']);
    Route::get('order/transaction/{duration}',[App\Http\Controllers\Vehicle\VehicleController::class,'transaction']);

    // add_user
    // Route::post('add_user',[App\Http\Controllers\Vehicle\VehicleController::class,'add_user']);

    Route::get('rattings',[App\Http\Controllers\Vehicle\VehicleController::class,'rattings']);

    Route::get('bank_details',[App\Http\Controllers\Vehicle\VehicleController::class,'bank_details']);
    Route::post('add_vehicle_bank_details',[App\Http\Controllers\Vehicle\VehicleController::class,'add_vehicle_bank_details']);
    Route::post('edit_vehicle_bank_details/{id}',[App\Http\Controllers\Vehicle\VehicleController::class,'edit_vehicle_bank_details']);

    Route::post('cart',[App\Http\Controllers\Vehicle\OrderController::class,'cart']);
    Route::get('DispCustimization/{submenu_id}',[App\Http\Controllers\Vehicle\OrderController::class,'custimization']);
    Route::post('update_custimization',[App\Http\Controllers\Vehicle\OrderController::class,'update_custimization']);
    Route::post('add_user',[App\Http\Controllers\Vehicle\OrderController::class,'add_user']);
    Route::get('display_bill',[App\Http\Controllers\Vehicle\OrderController::class,'display_bill']);
    Route::post('displayBillWithCoupen',[App\Http\Controllers\Vehicle\OrderController::class,'displayBillWithCoupen']);
    Route::post('change_submenu',[App\Http\Controllers\Vehicle\OrderController::class,'change_submenu']);
    Route::post('order/change_status',[App\Http\Controllers\Vehicle\OrderController::class,'change_status']);
    Route::get('month_finanace',[App\Http\Controllers\Vehicle\VehicleController::class,'month_finanace']);
    Route::post('month',[App\Http\Controllers\Vehicle\VehicleController::class,'month']);

    Route::get('/deliveryPerson/pending_amount/{order_id}',[DeliveryPersonController::class,'pending_amount']);

    Route::resources([
        'vehicle_discount' => Vehicle\VehicleDiscountController::class,
        'vehicle' => Vehicle\VehicleController::class,
        'menu_category' => Vehicle\MenuCategoryController::class,
        'vehicle_menu' => Vehicle\MenuController::class,
        'vehicle_submenu' => Vehicle\SubMenuController::class,
        'deliveryPerson' => Admin\DeliveryPersonController::class,
        'deliveryZone' => Admin\DeliveryZoneController::class,
    ]);
    Route::get('/custimization_type/{id}', [CustimizationTypeController::class,'index']);
    Route::get('/custimization_type/create/{id}', [CustimizationTypeController::class,'create']);

    // order
    Route::get('Orders', [App\Http\Controllers\Vehicle\OrderController::class,'index']);
    Route::post('Orders', [App\Http\Controllers\Vehicle\OrderController::class,'index']);
    Route::resource('order', Vehicle\OrderController::class)->except([
        'index'
    ]);

    Route::post('vehicle_menu/{menu_id}',[App\Http\Controllers\Vehicle\MenuController::class,'show']);

    Route::post('order/driver_assign',[App\Http\Controllers\Vehicle\OrderController::class,'driver_assign']);

    // delivery zone area
    Route::get('deliveryZoneArea/{id}', [DeliveryZoneAreaController::class,'index']);
    Route::resource('deliveryZoneArea', Admin\DeliveryZoneAreaController::class)->except([
        'index','show'
    ]);

    Route::get('update_vehicle',[VehicleSettingController::class,'update_vehicle']);

    Route::get('print_thermal/{order_id}',[App\Http\Controllers\Vehicle\OrderController::class,'print_thermal']);
    Route::get('printer_setting',[VehicleSettingController::class,'print_setting']);
    Route::post('update_printer_setting',[VehicleSettingController::class,'update_printer_setting']);
});

Route::post('saveEnvData',[AdminController::class,'saveEnvData']);
Route::post('saveAdminData',[AdminController::class,'saveAdminData']);