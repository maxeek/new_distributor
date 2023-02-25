<?php

use App\Http\Controllers\Client\AuthenticatedSessionController;
use App\Http\Controllers\Client\RegisteredClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });



Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::post('/client-register', [RegisteredClientController::class, 'register'])->name('client-register.submit');
// Route::get('/client-register', [RegisteredClientController::class, 'showRegistrationForm'])->name('client-register');
Route::get('/client-login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('client-login');
Route::post('/client-login', [AuthenticatedSessionController::class, 'login'])->name('client-login.submit');

Route::post('pos/filterProduct', [PosController::class, 'filterProduct'])->name('pos.filterProduct');
Route::post('products/getProduct', [ProductController::class, 'getProduct'])->name('products.getProduct');
Route::post('orders/getOrders', [OrderController::class, 'getOrders'])->name('orders.getOrders');

Route::middleware('auth:client')->prefix('client')->as('client.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('orders', [ClientOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [ClientOrderController::class, 'show'])->name('orders.show');
    Route::post('orders', [ClientOrderController::class, 'store'])->name('orders.store');
});


Route::middleware(['auth:web', 'verified'])->group(function () {

    Route::get('/_', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    // Route::get('/13', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('conditions', ConditionController::class);
    Route::resource('status', StatusController::class);
    Route::resource('pos', PosController::class)->only('index');
    Route::resource('users', UserController::class);
    Route::resource('cities', CityController::class);

    Route::post('clients/getClients', [ClientController::class, 'getClients'])->name('clients.getClients');
    Route::resource('clients', ClientController::class);

    Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
    Route::get('products/supporting-data', [ProductController::class, 'getSupportingData'])->name('products.supporting-data');
    Route::put('products/{product}/update-stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
    Route::get('products/{product}/editstock', [ProductController::class, 'editstock'])->name('products.editstock');
    Route::post('products/update-price', [ProductController::class, 'updatePrice'])->name('products.updatePrice');
    Route::resource('products', ProductController::class);

    Route::get('orders/{order}/print', [OrderController::class, 'print'])->name('orders.print');
    Route::get('orders/supporting-data', [OrderController::class, 'getSupportingData'])->name('orders.supporting-data');
    Route::resource('orders', OrderController::class);
});
Route::get('clear-cache', function () {
    $target = '/home/dflorentino/app/storage/app/public';
    $shortcut = '/home/dflorentino/public_html/storage';
    symlink($target, $shortcut);
});
