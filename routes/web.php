<?php


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

//Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/','FrontendController@home')->name('home');
Route::get('/services','FrontendController@services')->name('about');
Route::get('/about','FrontendController@about')->name('about');
Route::get('/contactus','FrontendController@contactus')->name('contactus');




Route::group(['middleware' => ['auth', 'verified']], function() {

    //Route::any('/search', 'BeeritemController@search')->name('beeritems.search');

    //Routes for permissions and roles
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');
    Route::resource('permissions','PermissionController');

    //Routes for Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Routes for Beeritems
    Route::any('beeritems/search','BeerItemController@search')->name('beeritems.search');
    Route::get('beeritems/importexport','BeerItemController@importexport')->name('beeritems.importexport');
    //
    Route::get('beeritems/grid','BeerItemController@displayGrid')->name('beeritems.grid');
    Route::get('beeritems/gallery','BeerItemController@displayGallery')->name('beeritems.gallery');

    Route::get('beeritems/spares','BeerItemController@spares')->name('beeritems.spares');
    Route::get('beeritems/wishlist','BeerItemController@wishlist')->name('beeritems.wishlist');

    Route::get('beeritems/test','BeerItemController@test')->name('beeritems.test');


     Route::get('beeritems/{beeritem}/qr','BeerItemController@generateQR')->name('beeritems.qr');
    //Route::get('beeritems/{collection}', 'BeerItemController@index')->name('beeritems.index');
    //Route::get('beeritems/create', 'BeerItemController@create')->name('beeritems.create');

    Route::resource('beeritems', 'BeerItemController');
    //Route::post('beeritems/store','BeerItemController@storeBeeritem')->name('beeritems.store');


    // Routes for Tag
    Route::resource('tags', 'TagController');

    // Routes for Category
    Route::resource('categories', 'CategoryController');

     // Routes for Category
    Route::any('breweries/search','BreweryController@search')->name('breweries.search');
    Route::resource('breweries', 'BreweryController');

    // Routes for Collection
    Route::resource('collections', 'CollectionController');


    //Routes for Image
    Route::post('image/store','BeeritemController@storeImage')->name('image.store');


    Route::view('profile', 'backend.profile.index')->name('profile.index');

    Route::view('manual', 'backend.manual.index')->name('manual.index');

    // Routes for Support
    Route::resource('tickets', 'TicketController');

    //Route::get('new_ticket', 'TicketController@create')->name('tickets.create');
    //Route::post('new_ticket', 'TicketController@store')->name('tickets.store');
    //Route::get('my_tickets', 'TicketController@index')->name('tickets.index');
    //Route::get('tickets/{ticket}', 'TicketController@show')->name('tickets.show');


    Route::get('dropdownlist','BreweryController@getCountryList');
    Route::get('get-region-list','BreweryController@getRegionList');
    Route::get('get-city-list','BreweryController@getCityList');


});




//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
