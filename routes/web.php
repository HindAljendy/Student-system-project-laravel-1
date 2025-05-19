<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ClassroomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/




//! Note :
/* we add middleware   'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' : This middleware checks if the user's locale is stored in the session.
If a session value for the locale exists, it redirects the user to the appropriate localized URL. This ensures that when users visit your site, 
they remain consistent in their preferred language as it is saved in their session.
*/

Auth::routes();

Route::group(['middleware' => ['guest']] , function(){
    Route::get('/', function()
    {
        return view('auth.login');
    });
});


Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'auth', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], 
function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/index', [HomeController::class, 'index'])->name('index'); 

    /* Use this Kind of Route = don't send parameter with URL */
    Route::controller(StageController::class)->group(function(){
        Route::get('/stages','index')->name('stages.index');
        Route::post('/stages','store')->name('stages.store');
        Route::put('/stages','update')->name('stages.update');
        Route::delete('/stages','destroy')->name('stages.destroy');
    });

    Route::controller(ClassroomController::class)->group(function(){
        Route::get('/classrooms','index')->name('classrooms.index');
        Route::post('/classrooms','store')->name('classrooms.store');
        Route::put('/classrooms','update')->name('classrooms.update');
        Route::delete('/classrooms','destroy')->name('classrooms.destroy');

        /* delete  all checked classrooms */
        Route::delete('/delete-all','deleteAll')->name('classrooms.delete-all');
        /* fillter_classrooms */
        Route::post('/filtter-classroom','fillter_classrooms')->name('classrooms.Filter_Classes');

    });

    Route::controller(SectionController::class)->group(function(){
        Route::get('/sections','index')->name('sections.index');

    });



});



//!  trying to match any URL path starting with a / and use the index method of AdminController:
Route::get('/{page}', [AdminController::class , 'index']);
// empty page.blade : الصفحة التي سنستخدمها

// ** first of all :  index الصفحة الرئيسية للقالب هي  

// ** Now : start with Translation between Arabic and english languages :
/* 
in config -> app.php  ->  Application Locale  :  'locale'   =  'default locale'
in  head.blade : customise css Style to combitable with arabic and english Css files.*/

// ** Use Mcamara package for : laravel localization : لدعم لفات الترجمة للتطبيق https://github.com/mcamara/laravel-localization
// ** Now start to translate the Application : php artisan lang:publish   -> lang  : ar  ننشئ مجلد 
//  And create translation file for every section  And we call him by his name .

//! Use Packages :
// 1.  Use Mcamara package for : laravel localization : لدعم لفات الترجمة للتطبيق 
// 2. Use laravel-translatable package   for A trait to make Eloquent models translatable     https://github.com/spatie/laravel-translatable
/* The Laravel Translatable package provides a convenient way to manage multilingual content in your Laravel applications. 
It allows you to easily store and retrieve translated fields for your models.  Instead of having separate columns for each language, 
it uses a single column to store all translations, typically using JSON or a similar format. */

/* 
php artisan route:trans:clear  => is a Laravel command used to clear the cached translation files.

This command is helpful when you've made changes to your translation files (e.g., adding new translations, modifying existing ones) and want to ensure that Laravel uses the latest versions.  Clearing the cache prevents Laravel from using outdated translation strings.

In short: It forces Laravel to re-compile and use the latest translation files, avoiding potential discrepancies or errors in your application.

*/

// 3. Use php Flasher  for : display notifications     => https://php-flasher.github.io/laravel/
