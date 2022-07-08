<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
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

Route::get('/clear', function () {
    \Artisan::call('optimize:clear');

});

Route::get('/', 'HomeController@index');
Route::get('/contact', 'HomeController@contactus');
Route::get('/packages', 'HomeController@package');
Route::get('/sound-effects', 'HomeController@sound_effect');
Route::get('/sound-tracks', 'HomeController@sound_track');
Route::get('/search', 'HomeController@search');
Route::get('/terms', 'HomeController@terms');
Route::get('/privacy', 'HomeController@privacy');
Route::get('/about', 'HomeController@about');
Route::get('/album/{id}', 'HomeController@album');
Route::get('/change-language/{lang}',"\App\Http\Controllers\HomeController@changeLang");
Route::post('contact-us','MailController@sendmail')->name('contact');
Auth::routes();
Route::group(['prefix' => '/', 'middleware' => ['role:0', 'auth']], function () {
    Route::get('/home', 'HomeController@profile')->name('home');
    Route::get('/payment-msg', 'HomeController@paymentMsg')->name('payment-msg');
    Route::post('/update-profile', 'UserController@updateProfile')->name('update-profile');
    Route::get('/cart', 'HomeController@cart')->name('cart');
    Route::post('/save-package', 'UserController@updatePackage');
    Route::post('add-to-cart', 'UserController@addToCart')->name('add.to.cart');
    Route::post('download/{id}', 'UserController@createDownloadZipFiles')->name('download');
    // Route::post('download-demo', 'UserController@downloadDemo')->name('download-demo');
    Route::patch('update-cart', 'UserController@addToCartupdate')->name('update.cart');
    Route::delete('remove-from-cart', 'UserController@remove')->name('remove.from.cart');
    Route::post('add-to-Favourite', 'UserController@addToFavourite')->name('add-to-Favourite');
    Route::post('/checkout', 'UserController@checkout');
    Route::post('createorder', 'PaypalController@payWithPaypal')->name('createorder');

    Route::get('payment', array('as' => 'payment','uses' => 'PaypalController@payWithPaypal',));
    Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
    Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));

    Route::post('chechout-payment', array('as' => 'chechout-payment','uses' => 'PaypalController@songPaymentWithpaypal',));
    Route::get('payment-status', array('as' => 'payment-status','uses' => 'PaypalController@getSongPaymentStatus',));



});

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['role:1', 'auth']], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    //  Artist Route
    Route::get('/artist', 'ArtistController@index');
    Route::get('/artist/add', 'ArtistController@add');
    Route::get('/artist/edit/{id}', 'ArtistController@edit');
    Route::post('/artist/store', 'ArtistController@store');
    Route::post('/artist/update/{id}', 'ArtistController@update');
    Route::post('/artist/delete/{id}', 'ArtistController@destroy');
    // Music Type Route
    Route::get('/music-type', 'MusicTypeController@index');
    Route::get('/music-type/add', 'MusicTypeController@add');
    Route::get('/music-type/edit/{id}', 'MusicTypeController@edit');
    Route::post('/music-type/store', 'MusicTypeController@store');
    Route::post('/music-type/update/{id}', 'MusicTypeController@update');
    Route::post('/music-type/delete/{id}', 'MusicTypeController@destroy');

    // Genre OR Category Route
    Route::get('genre', 'GenreController@index');
    Route::get('/genre/add', 'GenreController@add');
    Route::get('/genre/edit/{id}', 'GenreController@edit');
    Route::post('/genre/store', 'GenreController@store');
    Route::post('/genre/update/{id}', 'GenreController@update');
    Route::post('/genre/delete/{id}', 'GenreController@destroy');

    // Instrument Route
    Route::get('instrument', 'InstrumentController@index');
    Route::get('/instrument/add', 'InstrumentController@add');
    Route::get('/instrument/edit/{id}', 'InstrumentController@edit');
    Route::post('/instrument/store', 'InstrumentController@store');
    Route::post('/instrument/update/{id}', 'InstrumentController@update');
    Route::post('/instrument/delete/{id}', 'InstrumentController@destroy');

    // Package Route
    Route::get('package', 'PackageController@index');
    Route::get('/package/add', 'PackageController@add');
    Route::get('/package/edit/{id}', 'PackageController@edit');
    Route::post('/package/store', 'PackageController@store');
    Route::post('/package/update/{id}', 'PackageController@update');
    Route::post('/package/delete/{id}', 'PackageController@destroy');


    // Subscriber Route
    Route::get('subscriber', 'SubscriberController@index');
    Route::get('/subscriber/add', 'SubscriberController@add');
    Route::get('/subscriber/edit/{id}', 'SubscriberController@edit');
    Route::post('/subscriber/store', 'SubscriberController@store');
    Route::post('/subscriber/update/{id}', 'SubscriberController@update');
    Route::post('/subscriber/delete/{id}', 'SubscriberController@destroy');

    // Subscriber Route
    Route::get('songs', 'SongsController@index');
    Route::get('/songs/add', 'SongsController@add');
    Route::get('/songs/edit/{id}', 'SongsController@edit');
    Route::post('/songs/store', 'SongsController@store');
    Route::post('/songs/update/{id}', 'SongsController@update');
    Route::post('/songs/delete/{id}', 'SongsController@destroy');

    // Category Route
    Route::get('category', 'CategoryController@index');
    Route::get('/category/add', 'CategoryController@add');
    Route::get('/category/edit/{id}', 'CategoryController@edit');
    Route::post('/category/store', 'CategoryController@store');
    Route::post('/category/update/{id}', 'CategoryController@update');
    Route::post('/category/delete/{id}', 'CategoryController@destroy');

    // Sub Category Route
    Route::get('sub-category', 'SubCategoryController@index');
    Route::get('/sub-category/add', 'SubCategoryController@add');
    Route::get('/sub-category/edit/{id}', 'SubCategoryController@edit');
    Route::post('/sub-category/store', 'SubCategoryController@store');
    Route::post('/sub-category/update/{id}', 'SubCategoryController@update');
    Route::post('/sub-category/delete/{id}', 'SubCategoryController@destroy');

    // Album Route
    Route::get('album', 'AlbumController@index');
    Route::get('/album/add', 'AlbumController@add');
    Route::get('/album/edit/{id}', 'AlbumController@edit');
    Route::post('/album/store', 'AlbumController@store');
    Route::post('/album/update/{id}', 'AlbumController@update');
    Route::post('/album/delete/{id}', 'AlbumController@destroy');
});
