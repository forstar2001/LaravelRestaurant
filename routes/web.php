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
/*============================*/
/*  faisal.aqurz@gmail.com */
/*============================*/
//Artisan::call('view:clear');
//Artisan::call('cache:clear');
//Artisan::call('config:cache');

// Route::get('/hello', function () {
//   echo "hello world";
// });

Route::get('/', 'frontEndController@welcome');

Route::get('/cache', function(){
  Artisan::call('cache:clear');
  Artisan::call('view:clear');
  Artisan::call('config:cache');
  //  Artisan::call('optimize');
});

// Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Auth::routes();

// Route::get('/home', function(){ return redirect(action('admin\DashboardController@index')); });

// Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function(){

//   /*Artisan::call('cache:clear');
//   Artisan::call('config:cache');
//   */
//   Route::get('/dashboard', function(){ return view('admin/dashboard'); });

//   Route::get('/hotels', 'admin\UserController@hotels');

//   //  Route::get('dashboard', 'admin\DashboardController@index');
//   Route::resource('dashboard', 'admin\DashboardController');

//   Route::resource('user', 'admin\UserController');

//   Route::get('update-profile', 'admin\UserController@profileEdit');

//   Route::resource('expense', 'admin\ExpenseController');

//   Route::resource('dishes', 'admin\DishesController');

//   Route::resource('drinks', 'admin\DrinksController');

//   Route::resource('special-menu', 'admin\SpecialmenuController');

//   Route::resource('mail', 'admin\MailController');

//   Route::resource('pos', 'admin\PosController');

//   Route::resource('setting', 'admin\SettingController');

//   Route::resource('categories', 'admin\CategoriesController');

//   Route::resource('pages', 'admin\PagesController');

//   Route::resource('staff', 'admin\StaffController');

//   Route::any('staff/report/{id}', 'admin\StaffController@report');

//   Route::any('staff/delLog/{id}', 'admin\StaffController@destroyLog');

//   Route::post('staff/saveLog/', 'admin\StaffController@saveLog');

//   Route::get('pages/content_builder/{id}/{lang}', 'admin\PagesController@contentBuilder');

//   Route::post('pages/content_builder/save_data', 'admin\PagesController@contentBuilderPoster');

//   Route::post('pages/dishes/save_data', 'admin\DishesController@dishesPoster');

//   Route::post('pages/drinks/save_data', 'admin\DrinksController@drinksPoster');

//   Route::post('pages/specialmenu/save_data', 'admin\SpecialmenuController@sMenuPoster');

//   Route::get('pages/save/home', 'admin\PagesController@homePage');
//   Route::get('qrImageDownload', 'admin\DashboardController@imagedownload');

//   Route::post('pages/home/post', 'admin\PagesController@saveHomePage');
// });

/*front routes*/

Route::get('/find-on-map/', 'frontEndController@gmap');

Route::get('/reg', 'frontEndController@regenerate');

Route::group(['prefix' => ''], function(){

  Route::get('/{id}', 'frontEndController@index');

  Route::get('/menu/{id}/{cat?}', 'frontEndController@menu');

  Route::post('/sendmail', 'frontEndController@sendMail');

  // /*unused*/
  Route::get('/menu/{id}/cat/{cat}/', 'frontEndController@catmenu');

  Route::get('/contact/{id}', 'frontEndController@contact');

  Route::get('/languagec-change/{lan}', 'frontEndController@language');

  Route::get('/qr-image/{id}', 'frontEndController@qrimage');

  Route::get('qr/{id}', 'frontEndController@qr');
  Route::post('/survey_store', 'SurveyController@survey_store');


  /**
   * json endpoint for rating
   */
  Route::post('/save-rating', 'RatingController@save_rating');
  Route::get('/save-rating2', 'RatingController@save_rating'); // testing purpose

  Route::get('/has-rating/{id}', 'RatingController@has_rating');
  Route::get('/avg-rating/{id}', 'RatingController@avg_rating');

  Route::get('restaurant/all', 'frontEndController@all_restaurants');
  Route::post('restaurant/bycoords', 'frontEndController@restaurant_by_coords');

});







