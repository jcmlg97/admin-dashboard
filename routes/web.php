<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\User\EventController as UserEventController;



Route::get('/', function () {
    return view('welcome');
});


// 👤 USER DASHBOARD
Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin,user'])
    ->name('dashboard');


// 🔐 AUTH PROFILE
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// 🛠️ ADMIN AREA
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        // ADMIN DASHBOARD
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // USERS
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // PRODUCTS
        Route::patch(
            '/products/{product}/stock',
            [ProductController::class, 'updateStock']
        )->name('products.stock.update');

        Route::resource('products', ProductController::class);

        // EVENTS
        Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');

        // API calendario
        Route::get('/events/fetch', [AdminEventController::class, 'fetch'])->name('events.fetch');

        Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
        Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');
    });

    Route::prefix('events')
        ->middleware(['auth', 'role:user'])
        ->name('user.events.')
        ->group(function () {

            Route::get('/', [UserEventController::class, 'index'])
                ->name('index');

        });

require __DIR__.'/auth.php';