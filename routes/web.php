<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


/*
|---------------------- 
|ROUTES POUR LE FROTEND
|----------------------
*/
Route::domain('publication.ispt-kin.com')->group(function(){
	//Accueil
	Route::get('/', function () {
	    return redirect()->route('welcome.index');
	});

	Route::prefix('students')->group(function(){
	Route::resource('welcome','Students\WelcomeController')->only('index','store');
	Route::resource('auth','Students\AuthController')->only('index','store');
	Route::resource('publish','Students\PublishController')->only('index','show');
	// Route pour la vue et le télechargement de bulletin
	Route::get('/viewBulletin/{pathToFile}', 'Students\PublishController@viewBulletin')
			->name('viewBulletin');
	Route::get('/dowloadBulletin/{pathToFile}', 'Students\PublishController@dowloadBulletin')
			->name('dowloadBulletin');
	});

});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

















Route::domain('jury.ispt-kin.com')->group(function(){
	Route::get('/', function () {
	    return redirect()->route('login');
	});

	Route::prefix('sections')->group(function(){
		Route::resource('/','Backend\Sections\DashboardController');
	});



	


});


Route::get('/', function () {
	dd(Auth::check());
    return view('welcome');
});










// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return "salut ceci est la page officielle de l'ispt-kin";
// });

