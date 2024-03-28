<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Data\CategoryController;
use App\Http\Controllers\Data\FoodController;
use App\Http\Controllers\Data\MaterialController;
use App\Http\Controllers\Data\SellingController;
use App\Http\Controllers\Data\SupplierController;
use App\Http\Controllers\Data\TableController;
use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfflineOrderController;
use App\Http\Controllers\OnlineOrderController;
use App\Http\Controllers\OrderCheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOfRawMaterialController;
use App\Http\Controllers\report\ExpenseReportController;
use App\Http\Controllers\report\OfflineOrderReportController;
use App\Http\Controllers\report\OfflineReservationReportController;
use App\Http\Controllers\report\OnlineOrderReportController;
use App\Http\Controllers\report\OnlineReservationReportController;
use App\Http\Controllers\report\PaymentReportController;
use App\Http\Controllers\report\ProfitAndLossReportController;
use App\Http\Controllers\report\PurchaseReportController;
use App\Http\Controllers\report\SaleReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

// group route with middleware "auth"
Route::group(['middleware' => ['auth', 'admin']], function () {
  // route dashboard
  Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // prefix admin/dashboard
  Route::prefix('admin/dashboard')->group(function () {

    // prefix data for data master
    Route::prefix('data')->group(function () {

      // user
      Route::resource('user', UserController::class)->except(['create', 'store'])->name('index', 'user.index');

      // category
      Route::resource('category', CategoryController::class)->except(['show, create'])->name('index', 'category.index');

      // food or menu
      Route::resource('menu', FoodController::class)->except(['create'])->name('index', 'food.index');
      Route::put('menu/update-ready/{id}', [FoodController::class, 'updateReady'])->name('menu.update-ready');

      // selling or jualan
      Route::resource('selling', SellingController::class)->except(['create'])->name('index', 'selling.index');
      Route::put('selling/update-ready/{id}', [SellingController::class, 'updateReady'])->name('selling.update-ready');

      // table
      Route::resource('table', TableController::class)->except(['show, create'])->name('index', 'table.index');
      Route::put('table/update-ready/{table}', [TableController::class, 'updateReady'])->name('table.update-ready');

      // material
      Route::resource('material', MaterialController::class)->except(['show, create'])->name('index', 'material.index');

      // supplier
      Route::resource('supplier', SupplierController::class)->except(['create'])->name('index', 'supplier.index');

      // cash
      Route::resource('cash', CashController::class)->except(['create'])->name('index', 'cash.index');
    });

    // prefix transaction
    Route::prefix('transaction')->group(function () {

      // online order start - admin
      Route::controller(OnlineOrderController::class)->group(function () {
        Route::get('online-order', [OnlineOrderController::class, 'indexOnlineOrder'])->name('admin.online-order');
        Route::get('online-order/detail/{id}', [OnlineOrderController::class, 'detailOnlineOrder'])->name('admin.online-order.detail');
        Route::get('online-order/accept/{order}', [OnlineOrderController::class, 'acceptOnlineOrder'])->name('admin.online-order.accept');
        Route::get('online-order/rejected/{order}', [OnlineOrderController::class, 'rejectedOnlineOrder'])->name('admin.online-order.rejected');
        Route::get('online-order/done-order-cash/{order}', [OnlineOrderController::class, 'doneOrderWithPaymentCash']);
        Route::get('online-order/done-payment/{order}', [OnlineOrderController::class, 'donePayment']);
      });
      // online order end - admin


      // offline order start - admin
      Route::controller(OfflineOrderController::class)->group(function () {
        Route::get('offline-order', [OfflineOrderController::class, 'indexOfflineOrder'])->name('admin.offline-order');
        Route::get('offline-order/detail/{id}', [OfflineOrderController::class, 'detailOfflineOrder'])->name('admin.offline-order.detail');
        Route::get('offline-order/rejected/{order}', [OfflineOrderController::class, 'rejectedOfflineOrder'])->name('admin.offline-order.rejected');
        Route::get('offline-order/close-order-in-dashboard-admin/{order}', [OfflineOrderController::class, 'closeOrderInDashboard'])->name('admin.offline-order.accept');
        Route::get('offline-order/accept-payment/{order}', [OfflineOrderController::class, 'paymentAccept'])->name('admin.offline-order.accept');
      });
      // offline order end - admin


      // online reservation start - admin
      Route::controller(ReservationController::class)->group(function () {
        Route::get('online-reservation', [ReservationController::class, 'indexOnlineReservation'])->name('admin.online-reservation');
        Route::get('online-reservation/detail/{id}', [ReservationController::class, 'detailOnlineReservation'])->name('admin.online-reservation.detail');
        Route::get('online-reservation/accept/{reservation}', [ReservationController::class, 'acceptOnlineReservation'])->name('admin.online-reservation.accept');
        Route::get('online-reservation/rejected/{reservation}', [ReservationController::class, 'rejectedOnlineReservation'])->name('admin.online-reservation.rejected');
        Route::get('online-reservation/finish-online-reservation/{reservation}', [ReservationController::class, 'finishOnlineReservation']);
        Route::get('online-reservation/done-payment/{reservation}', [ReservationController::class, 'donePayment']);
      });
      // online reservation end - admin


      // offline reservation start - admin
      Route::controller(ReservationController::class)->group(function () {
        Route::get('offline-reservation', [ReservationController::class, 'indexOfflineReservation'])->name('admin.offline-reservation');
        Route::get('offline-reservation/detail/{id}', [ReservationController::class, 'detailOfflineReservation'])->name('admin.offline-reservation.detail');
        Route::get('offline-reservation/checkout', [ReservationController::class, 'modalCheckoutOffline'])->name('admin.offline-reservation.checkout');
        Route::put('offline-reservation/accept/{reservation}', [ReservationController::class, 'acceptOfflineReservation'])->name('admin.offline-reservation.accept');
        Route::get('offline-reservation/rejected/{reservation}', [ReservationController::class, 'rejectedOfflineReservation'])->name('admin.offline-reservation.rejected');
        Route::get('offline-reservation/finish/{reservation}', [ReservationController::class, 'finishReservation'])->name('admin.offline-reservation.finish');
      });
      // offline reservation end - admin

      // payment start - admin
      Route::controller(PaymentController::class)->group(function () {
        Route::get('payment', [PaymentController::class, 'index'])->name('admin.payment');
        Route::get('payment/detail/{id}', [PaymentController::class, 'detail'])->name('admin.payment.detail');
      });
      // payment end - admin

      // sale start - admin
      Route::controller(SaleController::class)->group(function () {
        Route::resource('sale', SaleController::class)->name('index', 'admin.sale');
        Route::post('sale/add-item', [SaleController::class, 'addItem']);
      });
      // sale end - admin

      // expense start - admin
      Route::controller(ExpenseController::class)->group(function () {
        Route::resource('expense', ExpenseController::class)->name('index', 'admin.expense');
      });
      // expense end - admin

      // purchase start - admin
      Route::controller(PurchaseOfRawMaterialController::class)->group(function () {
        Route::resource('purchase', PurchaseOfRawMaterialController::class)->name('index', 'admin.purchase');
      });
      // purchase end - admin
    });

    // prefix report
    Route::prefix('report')->group(function () {

      // online order start - admin
      Route::controller(OnlineOrderReportController::class)->group(function () {
        Route::get('online-order', 'index')->name('admin.online-order.report');
        Route::get('online-order/export', 'export')->name('admin.online-order.report.export');
      });
      // online order end - admin

      // offline order start - admin
      Route::controller(OfflineOrderReportController::class)->group(function () {
        Route::get('offline-order', 'index')->name('admin.offline-order.report');
        Route::get('offline-order/export', 'export')->name('admin.offline-order.report.export');
      });
      // offline order end - admin

      // online reservation start - admin
      Route::controller(OnlineReservationReportController::class)->group(function () {
        Route::get('online-reservation', 'index')->name('admin.online-reservation.report');
        Route::get('online-reservation/export', 'export')->name('admin.online-reservation.report.export');
      });
      // online reservation end - admin

      // offline reservation start - admin
      Route::controller(OfflineReservationReportController::class)->group(function () {
        Route::get('offline-reservation', 'index')->name('admin.offline-reservation.report');
        Route::get('offline-reservation/export', 'export')->name('admin.offline-reservation.report.export');
      });
      // offline reservation end - admin

      // payment start - admin
      Route::controller(PaymentReportController::class)->group(function () {
        Route::get('payment', 'index')->name('admin.payment.report');
        Route::get('payment/export', 'export')->name('admin.payment.report.export');
      });
      // payment end - admin

      // sale start - admin
      Route::controller(SaleReportController::class)->group(function () {
        Route::get('sale', 'index')->name('admin.sale.report');
        Route::get('sale/export', 'export')->name('admin.sale.report.export');
      });
      // sale end - admin

      // expense start - admin
      Route::controller(ExpenseReportController::class)->group(function () {
        Route::get('expense', 'index')->name('admin.expense.report');
        Route::get('expense/export', 'export')->name('admin.expense.report.export');
      });
      // expense end - admin

      // purchase start - admin
      Route::controller(PurchaseReportController::class)->group(function () {
        Route::get('purchase', 'index')->name('admin.purchase.report');
        Route::get('purchase/export', 'export')->name('admin.purchase.report.export');
      });
      // purchase end - admin

      // profit and loss start
      Route::controller(ProfitAndLossReportController::class)->group(function () {
        Route::get('profit-and-loss', 'index')->name('admin.profit-and-loss.report');
        Route::get('profit-and-loss/export', 'export')->name('admin.profit-and-loss.report.export');
      });
      // profit and loss end
    });
  });
});

// Customer //
Route::group(['middleware' => ['auth']], function () {
  // Profile Start //
  Route::controller(ProfileController::class)->group(function () {
    Route::get('profile', 'index'); // halaman
    Route::put('profile', 'updateProfile');
    Route::put('update-password', 'updatePassword');
  });
  // Profile End //


  // Online Order Checkout Start //
  Route::controller(OrderCheckoutController::class)->group(function () {
    Route::get('checkout', [OrderCheckoutController::class, 'index']); // halaman
    Route::get('order/checkout', [OrderCheckoutController::class, 'getCheckout']);
    Route::post('checkout', [OrderCheckoutController::class, 'checkout']);
    Route::post('rollback/checkout', [OrderCheckoutController::class, 'rollbackCheckout']);
  });
  // Online Order Checkout End //


  // Online Order Start //
  Route::controller(OnlineOrderController::class)->group(function () {
    Route::get('orders', [OnlineOrderController::class, 'index'])->name('orders');
    Route::post('order/online', [OnlineOrderController::class, 'order']);
    Route::put('order/online/cancel/{id}', [OnlineOrderController::class, 'cancelOrder']);
    Route::put('order/online/accept/{id}', [OnlineOrderController::class, 'acceptOrder']);

    // cetak bukti pembayaran
    Route::get('order/payment/{order}', [OnlineOrderController::class, 'payment']);

    // Render modal reservation 
    Route::get('order/online/reservation', [OnlineOrderController::class, 'modalReservation']);
  });
  // Online Order End //


  // Reservation start //
  Route::controller(ReservationController::class)->group(function () {
    Route::get('reservation', [ReservationController::class, 'index'])->name('reservation');
    Route::post('reservation/online/reservation', [ReservationController::class, 'reservation']);
    Route::put('reservation/online/cancel/{id}', [ReservationController::class, 'cancel']);
    Route::put('reservation/online/accept/{id}', [ReservationController::class, 'accept']);
    Route::get('reservation/online/order/{reservation}', [ReservationController::class, 'orderIndex']);
    Route::post('reservation/online/order', [ReservationController::class, 'order']);

    // Render modal checkout reservation
    Route::post('reservation/online/modal/checkout', [ReservationController::class, 'modalCheckout']);
  });
  // Reservation end //
});

// Cart start //
Route::post('cart/add', [CartController::class, 'addToCart']);
Route::post('cart/reduce', [CartController::class, 'reduceToCart']);
// Cart end //


// Offline order start //
Route::get('order/offline/{id}', [OfflineOrderController::class, 'index']);
Route::post('order/offline/order', [OfflineOrderController::class, 'order']);

// Payment order offline
Route::get('offline/order/payment/{order}', [OfflineOrderController::class, 'payment']);

// Render modal checkout
Route::post('order/offline/checkout', [OfflineOrderController::class, 'modalCheckout']);
// Render modal order recently
Route::get('order/offline/order/{table}', [OfflineOrderController::class, 'getOrderRecently']);
// Render ulang modal order recently
Route::get('order/offline/order/close/{id}', [OfflineOrderController::class, 'closeOrder']);
// Offline order end //


// Offline reservation start //
Route::get('reservation/offline', [ReservationController::class, 'indexOffline']);
Route::post('reservation/offline', [ReservationController::class, 'reservationOffline']);
// Offline reservation end //
