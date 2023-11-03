<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/personal', [\App\Http\Controllers\PersonalController::class, 'edit'])->name('personal.edit');
    Route::patch('users/personal', [\App\Http\Controllers\PersonalController::class, 'update'])->name('personal.update');
    Route::get('/users', [\App\Http\Controllers\PersonalController::class, 'listUsers'])->name('users.list');
    Route::post('/users/search', [\App\Http\Controllers\PersonalController::class, 'usersSearch'])->name('users.search');
    Route::get('/users/{user}', [\App\Http\Controllers\PersonalController::class, 'show'])->name('users.show');

    Route::get('/holiday/create', [\App\Http\Controllers\Holiday\HolidayController::class, 'create'])->name('holiday.create');
    Route::post('/holiday', [\App\Http\Controllers\Holiday\HolidayController::class, 'store'])->name('holiday.store');
    Route::get('/holiday/{holiday}', [\App\Http\Controllers\Holiday\HolidayController::class, 'show'])->name('holiday.show');
    Route::get('/holiday/edit/{holiday}', [\App\Http\Controllers\Holiday\HolidayController::class, 'edit'])->name('holiday.edit');
    Route::patch('/holiday/{holiday}', [\App\Http\Controllers\Holiday\HolidayController::class, 'update'])->name('holiday.update');
    Route::delete('/holiday/{holiday}', [\App\Http\Controllers\Holiday\HolidayController::class, 'destroy'])->name('holiday.destroy');


    Route::post('/present/create_link', [\App\Http\Controllers\Present\PresentController::class, 'createLink']);
    Route::post('/present', [\App\Http\Controllers\Present\PresentController::class, 'store'])->name('present.store');
    Route::patch('/present/{present}', [\App\Http\Controllers\Present\PresentController::class, 'update'])->name('present.update');
    Route::delete('/present/{present}', [\App\Http\Controllers\Present\PresentController::class, 'destroy'])->name('present.destroy');
    Route::post('/present/add_present/{present}', [\App\Http\Controllers\Present\PresentController::class, 'addPresent'])->name('present.add_present');
    Route::get('/presents', [\App\Http\Controllers\Present\PresentController::class, 'show'])->name('present.show');


    Route::get('/tags', [\App\Http\Controllers\Tag\TagController::class, 'index'])->name('tag.index');

    Route::post('/post_images', [\App\Http\Controllers\PresentImageController::class, 'store']);

});

require __DIR__.'/auth.php';
