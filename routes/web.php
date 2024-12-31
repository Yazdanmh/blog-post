<?php

use App\Http\Controllers\backend\AboutController;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('posts/{slug}',[HomeController::class, 'show'])->name('home.show');
Route::get('about-us',[HomeController::class, 'about'])->name('home.about'); 
Route::get('/contact',[ContactController::class,'index'])->name('contact.home'); 
Route::post('/contact',[ContactController::class,'post'])->name('contact.post');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');
    Route::resource('post',PostController::class); 
    Route::get('posts/trash',[PostController::class, 'trash'])->name('post.trash');
    Route::delete('posts/force-delete/{id}',[PostController::class, 'delete'])->name('post.force-delete'); 
    Route::get('posts/restore/{id}', [PostController::class, 'restore'])->name('post.restore');
    Route::resource('about',AboutController::class); 
    Route::get('/setting',[SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/{id}',[SettingController::class,'store'])->name('setting.store');
}); 


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    Lfm::routes();
});

require __DIR__.'/auth.php';
