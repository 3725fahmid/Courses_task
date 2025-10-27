<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('backend.index');
})->middleware(['auth'])->name('dashboard');

// Courses 
Route::resource('courses', CourseController::class);

 // Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');

});


require __DIR__.'/auth.php';


// Route::get('/contact', function () {
//     return view('contact');
// });
