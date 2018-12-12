<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('students')->group(function(){

	Route::resource('welcome','Students\WelcomeController')->only('index','store');
	Route::resource('auth','Students\AuthController')->only('index','store')
													 ->middleware(['sessionActive']);
	Route::resource('publish','Students\PublishController')->only('index','show')
														   ->middleware(['codeAuth','noCache']);
	// Route pour la vue et le télechargement de bulletin													   
	Route::get('/viewBulletin/{pathToFile}', 'Students\PublishController@viewBulletin')
			->name('viewBulletin')->middleware('viewBulletin');
	Route::get('/dowloadBulletin/{pathToFile}', 'Students\PublishController@dowloadBulletin')
	->name('dowloadBulletin')->middleware('viewBulletin');
});


Route::get('/table', function () {
	$table=['sections','facultes','auditoires','gestion_annees','etudiants','sessions','session_actives','codes','bulletins','users_roles','users','ventes'];
	foreach ($table as $value) {
		echo "php artisan make:migration creation_table_$value --create=$value <br>";
		
	}
	
    return 'ok';
});

