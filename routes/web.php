<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
	use App\Models\Etudiant;
	Route::get("test",function(){
	$users = Etudiant::all();
	return view('backend.sections.dataTable',['users'=>$users]);
		// $return null;
	});

Route::get('/etudiantDataTable','Backend\Sections\DashboardController@etudiantDataTable')->name('etudiantDataTable');






	/**************************************
	|
	| ROUTES POUR LE FRONTEND
	|
	**************************************/
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


	/**************************************
	|
	|  Routes AUTHENTIFICATION
	|
	**************************************/

	Auth::routes();
	Route::get('logout', 'Auth\LoginController@logout');


	/**************************************
	|
	|  Routes BACKEND
	|
	**************************************/

Route::group(['middleware'=>['auth','checkUserRole']],function(){


	Route::domain('jury.ispt-kin.com')->group(function(){
		Route::get('/', function () {
		    return redirect()->route('login');
		});

		/*|||||||||||||||||||||||||||||||||||||
		|
		|  Routes pour Admin
		|
		|||||||||||||||||||||||||||||||||||||*/
		Route::prefix('admin')->group(function(){
			Route::name('admin.')->group(function () {
				Route::get('/', function () {
					return 'PAGE ADMIN';
				})->name('index');
			});
		});

		/*||||||||||||||||||||||||||||||||||||
		|
		|  Routes pour le Jury
		|
		*||||||||||||||||||||||||||||||||||||*/
		
		Route::prefix('jury')->group(function(){
			Route::name('jury.')->group(function () {
				Route::get('/', function () {
					return view('backend.jury.index');
				})->name('index');
			});
		});

		/*|||||||||||||||||||||||||||||||||||||
		|
		|  Routes pour les Sections
		|
		*||||||||||||||||||||||||||||||||||||*/
		Route::prefix('section')->group(function(){ //@prefixe prefixé le lien url
			Route::name('section.')->group(function () { //@name pour prefixé les intinairaire 
				Route::get('/','Backend\Sections\DashboardController@index')->name('index');
				Route::get('/session/{session}','Backend\Sections\DashboardController@show')->name('show');
				
				Route::match(['get', 'post'],'/session/{session}/auditoire/{auditoire}','Backend\Sections\DashboardController@showAuditoire')
						->name('show_auditoire');

				Route::get('/etudiantDataTable','Backend\Sections\DashboardController@etudiantDataTable')->name('etudiantDataTable');

				Route::match(['get', 'post'],'/codeActivated/{code}','Backend\Sections\DashboardController@codeActivated')
						->name('code_activated');

			});

		// Route::prefix('sections')->group(function(){
		// 	Route::resource('/','Backend\Sections\DashboardController');
		});
	});
});



	/**************************************
	|
	|  Routes Welcome domain name
	|
	**************************************/
	Route::get('/', function () {
	    return view('welcome');
	});










// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return "salut ceci est la page officielle de l'ispt-kin";
// });

