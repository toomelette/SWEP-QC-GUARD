<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});




/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {


	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');


	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::post('/user/logout/{slug}', 'UserController@logout')->name('user.logout');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');


	/** MENU **/
	Route::resource('menu', 'MenuController');


	/** EMPLOYEE BODY TEMPERATURE **/
	Route::resource('body_temp', 'BodyTempController');
	
});






/** Testing **/
// Route::get('/dashboard/test', function(){

// 	$cos_list = App\Models\CosMaster::get();
// 	foreach ($cos_list as $data) {

// 		$cos_obj = App\Models\CosMaster::select('cos_id')->orderBy('cos_id', 'desc')->first();

// 		$id = "";

// 	 	 if($cos_obj != null){
// 	 	     if($cos_obj->cos_id != null){
// 	 	         $num = str_replace('COS', '', $cos_obj->cos_id) + 1;
// 	 	         $id = 'COS' . $num;
// 	 	     }
// 	 	 }

// 		$cos = App\Models\CosMaster::find($data->id);
// 		$cos->cos_id = $id;
// 		$cos->save();
// 		echo $cos->slug .'</br>';

// 	}

// 	return $cos->cos_id .'<br>';

// });

