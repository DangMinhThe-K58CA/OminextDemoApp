<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// general user routes.
Route::get('/login', function () {
	return view('auth/login',['error', ""]);
});
Route::match(['get', 'post'],'/generalLoginProcessing', 'GeneralUserController@loginProcessing');

Route::get('/generalLogout', 'GeneralUserController@logout');

Route::get('/generalProfile', 'GeneralUserController@showProfile');

Route::get('/generalInfo', 'GeneralUserController@showInfo');

Route::post('/changeGeneralProfile', 'GeneralUserController@changeGeneralProfile');

Route::post('/changeGeneralPassword', 'GeneralUserController@changePassword');

Route::get('/general/getCategoryWithBookmarkData', 'GeneralUserController@getCategoryWithBookmarkData');

Route::get('/general/readNewsInBookmark', 'GeneralUserController@readNewsInBookmark');

Route::get('/general/deleteNewsFromBookmark', 'GeneralUserController@deleteNewsFromBookmark');
// end of routes



// front routes
Route::get('/', function () {
    return view('front/index');
});

Route::get('/front/getCategories', 'FrontController@getCategories');

Route::get('/front/getNewsOfCate', 'FrontController@getNewsOfCate');

Route::get('/front/getHottestList', 'FrontController@getHottestList');

Route::get('/front/addToBookmark', 'FrontController@addToBookmark');
//end of front routes.

//Test routes:

Route::match(['get', 'post'],'/loginProcessing', 'ViewerController@loginProcessing');

Route::get('/register', 'ViewerController@startRegister');

Route::post('/registerProcessing', 'GeneralUserController@registerProcessing');

Route::get('/logout', 'ViewerController@logoutProcessing');
//




Route::get('/show', 'FileEntryController@getAllImage');

Route::get('/deleteImage', 'FileEntryController@deleteImage');

Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);


Route::post('fileentry/add',[ 
        'as' => 'addentry', 'uses' => 'FileEntryController@add']);
//end of test routes.

//Admin routes: 
//MiddleWare test
Route::get('quan-tri',[
   'middleware' => 'Admin:admin',
   'uses' => 'AdminController@index',
]);
//End of middleware test

Route::get('/adminLogin', function () {
	return view('admin/login');
});


Route::match(['get', 'post'],'/adminLoginProcessing', 'AdminController@loginProcessing');

Route::get('/adminLogout', 'AdminController@logoutProcessing');

Route::get('/showAdminsList', 'AdminController@showAdminsList');

Route::get('/showPartnersList', 'AdminController@showPartnersList');

Route::get('/showViewersList', 'AdminController@showViewersList');

Route::get('/yourProfile', 'AdminController@showAdminProfile');

Route::post('changeAdminInfo', 'AdminController@changeAdminInfo');

Route::post('changeAdminPassword', 'AdminController@changeAdminPassword');

Route::get('/changeRole', 'AdminController@changeRole');
//end of admin routes.

//partner routes:
Route::get('/partnerLogin', function () {
	$data = [
		'error' => ""
	];
	return view('partner/login')->with($data);
});

Route::get('/cong-tac-vien', 'PartnerController@index');

Route::get('/partnerProfile', 'PartnerController@showProfile');

Route::get('/showNewsListOfPartner', function () {
	return view('partner/newsList');
});

Route::get('/makeNews', function () {
	return view('partner/makeNews');
});

Route::post('/saveNewsContent', 'PartnerController@saveNewsContent');

Route::post('changePartnerInfo', 'PartnerController@changeInfo');

Route::post('changePartnerPassword', 'PartnerController@changePassword');

Route::match(['get', 'post'],'/partnerLoginProcessing', 'PartnerController@loginProcessing');

Route::get('/partnerLogout', 'PartnerController@logoutProcessing');
//end of partner routes.