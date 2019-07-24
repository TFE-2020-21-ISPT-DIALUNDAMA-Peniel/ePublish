<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// 	Route::get("test",function(){
// 		$idsessions=1;
// 		$idsections=2;
// 		$idauditoires=10;
// 		return App\Models\Auditoire::GetAuditoireNonPublieBySession($idsessions)->get();
// 	});

// Route::get('/testDatatable','Backend\Sections\DashboardController@testTable');


// Route::get('/etudiantDataTable','Backend\Sections\DashboardController@etudiantDataTable')->name('etudiantDataTable');








	/**************************************
	|
	| ROUTES POUR LE FRONTEND
	|
	**************************************/
// Route::domain('publication.ispt-kin.local')->group(function(){
	
	//Accueil 
	Route::get('/', function () {
	    return redirect()->route('students.index');
	});

	Route::prefix('publication')->group(function(){
		Route::name('students.')->group(function () {
			Route::get('/','Frontend\DashboardController@index')->name('index');
		  	Route::post('/','Frontend\DashboardController@authentification')->name('authentification');
			Route::get('/authentification/{publication}','Frontend\DashboardController@showAuthentificationForm')->name('show_authentification_form');
			
			Route::post('/Bulletin','Frontend\DashboardController@getBulletin')->name('showBulletin');
			// Route::get('/{session}/{etudiant}/{code}','Frontend\DashboardController@showBulletin')->name('showBulletinStudent');
			Route::post('/dowloadBulletin', 'Frontend\DashboardController@dowloadBulletin')
				->name('dowloadBulletin');
		});



		// Route::resource('welcome','Students\WelcomeController')->only('index','store');
		// Route::resource('auth','Students\AuthController')->only('index','store');
		// Route::resource('publish','Students\PublishController')->only('index','show');
		// // Route pour la vue et le télechargement de bulletin
		// Route::get('/viewBulletin/{pathToFile}', 'Students\PublishController@viewBulletin')
		// 		->name('viewBulletin');
		// Route::get('/dowloadBulletin/{pathToFile}', 'Students\PublishController@dowloadBulletin')
		// 		->name('dowloadBulletin');
	});

// });


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


	Route::domain('jury.ispt-kin.local')->group(function(){
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
					return redirect()->route('admin.showAuditoires');
				})->name('index');
				// Etudiant
				// Partager avec l'interface Jury 
				Route::get('/getAuditoires','Backend\Admin\DashboardController@showAuditoiresEtudiant')->name('showAuditoires');
				Route::get('/getAuditoires/auditoire/{auditoire}','Backend\Admin\DashboardController@showEtudiantsByAuditoires')->name('showEtudiants');
				Route::resource('etudiant','Backend\EtudiantController');
				Route::post('/importEtudiant','Backend\Admin\DashboardController@importEtudiantByAuditoire')->name('importEtudiantByAuditoire');

				// user
				Route::get('/users/{users_roles}','Backend\Admin\DashboardController@getUser')->name('get_users');
				Route::post('/gestion_users','Gestions\UsersController@store')->name('users_store');
				Route::post('/user_activation','Gestions\UsersController@activation')->name('users_activation');



			});

		});

		/*||||||||||||||||||||||||||||||||||||
		|
		|  Routes pour le Jury
		|
		*||||||||||||||||||||||||||||||||||||*/
		
		Route::prefix('jury')->group(function(){
			Route::name('jury.')->group(function () {
				Route::get('/','Backend\Jury\DashboardController@index')->name('index');
				// Etudiants
				Route::get('/getAuditoires','Backend\Jury\DashboardController@showAuditoiresEtudiant')->name('showAuditoires');
				Route::get('/getAuditoires/auditoire/{auditoire}','Backend\Jury\DashboardController@showEtudiantsByAuditoires')->name('showEtudiants');
				Route::resource('etudiant','Backend\EtudiantController');

				Route::post('/importEtudiant','Backend\Jury\DashboardController@importEtudiantByAuditoire')->name('importEtudiantByAuditoire');

				// Bulletin
				Route::get('/getBulletin/session/{session}','Backend\Jury\DashboardController@showAuditoiresByBulletin')->name('getBulletinBySession');
				Route::get('/getBulletin/session/{session}/auditoire/{auditoire}','Backend\Jury\DashboardController@showBulletinByAuditoireAndSession')->name('getBulletinByAuditoire');

				Route::post('/upload/bulletins/{annee}/{session}/{auditoire}','Backend\Jury\DashboardController@storeBulletin')->name('storeBulletin');

				Route::post('getBulletinImg','Backend\Jury\DashboardController@showBulletinImg')->name('showBulletinImg');
				// Publication

				Route::get('/Publication/session/{session}','Backend\Jury\DashboardController@getPublicationBySession')->name('getPublicationBySession');
				Route::post('/publish','Backend\Jury\DashboardController@publish')->name('publish');

				// Palmarès
				Route::get('/Palmares/session/{session}','Backend\Jury\DashboardController@getPalmaresBySession')->name('getPalmaresBySession');
				Route::get('/Palmares/session/{session}/auditoire/{auditoire}','Backend\Jury\DashboardController@showPalmaresByAuditoireAndSession')->name('showPalmaresByAuditoireAndSession');
				Route::get('/Palmares/Add/session/{session}/auditoire/{auditoire}','Backend\Jury\DashboardController@showAddEtudiantPalmaresByAuditoireAndSession')->name('showAddEtudiantPalmaresByAuditoireAndSession');
				
				// Route::get('/etudiant_success/etudiant/{etudiant}/session/{session}','Backend\Jury\DashboardController@etudiantSucces')->name('etudiant_succes');
				// Ajoute un étudiant dans la table success
				Route::post('/etudiant_success/','Backend\Jury\DashboardController@etudiantSucces')->name('etudiant_succes');
				// Route::get('/etudiant_success/{etudiants_succes}','Backend\Jury\DashboardController@etudiantNoSucces')->name('etudiant_no_succes');
				// Supprime un étudiant dans la table success
				Route::post('/etudiant_no_success','Backend\Jury\DashboardController@etudiantNoSucces')->name('etudiant_no_succes');




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
				Route::get('/session/{session}','Backend\Sections\DashboardController@getAuditoiresBySection')->name('show');
				
				Route::match(['get', 'post'],'/session/{session}/auditoire/{auditoire}','Backend\Sections\DashboardController@getEtudiantsByAuditoire')
						->name('show_auditoire');

				// Route::get('/etudiantDataTable','Backend\Sections\DashboardController@etudiantDataTable')->name('etudiantDataTable');

				Route::post('/codeActivated','Backend\Sections\DashboardController@codeActivated')
						->name('code_activated');

			});
			
		// Route::prefix('sections')->group(function(){
		// 	Route::resource('/','Backend\Sections\DashboardController');
		});
	});
// });



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
});

