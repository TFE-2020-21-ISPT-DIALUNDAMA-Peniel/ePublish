<?php  
	
	/******************
	* 
	* CONSTANTS
	*
	*******************/
	define('DS', DIRECTORY_SEPARATOR);
  	

  	function getNbr($value,$default=0){
  		
		return $value ? $value : $default;
    	
    }

	/**
	 * converti un fichier pdf en img
	 * avec le package PdfToImage 
	 * https://github.com/spatie/pdf-to-image
	 * 
	 * @param le nom du fichier stoquer dans le dossier bulletins/pdf
	 * @param le lien de stockage du fichier
	 * @return url de img stoquer 
	 * 
	 */

  	function get_path_bulletin_img($file){
		$pathPdf = storage_path('app'.DS.'bulletins'.DS.'pdf'.DS.$file.'.pdf');
		$pathImg = storage_path('app'.DS.'bulletins'.DS.'img'.DS.$file.'.jpg');
		if (file_exists($pathPdf)) {
			// Si l'img existe on la returne directement 
			if (file_exists($pathImg)) {
				return $pathImg;
			}
			$pdf = new \Spatie\PdfToImage\Pdf($pathPdf);
			$pdf->_saveImage($pathImg,$file);
			$format =$pdf->getOutputFormat();
		
			return $pathImg.'.'.$format;	
		}
		//sinon on retourne message d'erreur
    	
    }

    /**
	 * renvoi le lien du pdf stoquer dans storage/bulletin/pdf
	 * 
	 * @param le lien du fichier 
	 * @return url de pdf
	 * 
	 */

  	function get_path_bulletin_pdf($file){
		$pathPdf = storage_path('app'.DS.'bulletins'.DS.'pdf'.DS.$file);
		
		return $pathPdf.'.pdf';	
    	
    }


     /**
	 * renvoi le format du lien de route publish pour l'etudiant connecté 
	 * 
	 * @return string url | null
	 */

      	function getPublishUrl(){
			if (!empty(session('student'))) {
				return session('student')->nom."?c=".session('student')->idcodes;
			}			
			return 'welcome.index';	
    	
    }



    /*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    |
    |	HELPERS UTILISES EN BACKEND
    |
    |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/

     /**
	 * Renvoi la route de redirection de l'utilisateur connecté tenant compte de son role
	 *  
	 * @param $request object request tableau de $__SERVER 
	 * @return string url de route | /
	 **/

    function redirectToDashboard(){
        if(Auth()->check()){
            $role = session('user')['role'];
            //on rédirige par rapport au role | Authntification par niveau
            if (!empty($role)) {
                return route($role.'.index');
            }
        }
        return '/';
    }
     /**
	 * Permet de parser l'url pour récuperer le prefixe du lien
	 *  
	 * @param $request object request tableau de $__SERVER 
	 * @return string prefixe de la route
	 **/

    function getPrefixeRoute($request){
    	if (!empty($request['PATH_INFO'])) {
			$path_info = $request['PATH_INFO'];
		    $path_info =trim($path_info,'/');
		    $prefixe = explode('/',$path_info)[0];
		   
		    return $prefixe;
    	}
    	return '';
    }

  	 /**
	 * Initialise les informations suplémentaire de l'utilisateur connecté
	 *  
	 * @return void
	 **/  
    function setUserSession(){
    	if (Auth()->check()) {
    		if (empty(session('user'))) {
    			$user_role = \App\Models\Users_role::where('idusers_roles',Auth()->user()->idusers_roles)->first();
    			$user_section = \App\Models\Section::where('idsections',Auth()->user()->idsections)->first();

    			session([
    				'user'=>[
    						'idusers_roles' => $user_role->idusers_roles,
    						'role' => $user_role->lib,
    						'idsections' => $user_section ? $user_section->idsections : null,
    						'section' => $user_section ? $user_section->lib : null,
    				]
    			]);

    			return true;
    		}
    	}
    	return false;
    }

 //     /**
	//  * filtre une instance eloquent recupérée sousforme de collections
	//  * la fonction récupere les élément qui passe un teste de vérite
	//  * passé en parametre dans une instace de collection eloquent
	//  * @param $eloquent une instance eloquent | un tableau de collection
	//  * @param array filter clause pour filtrer  ex: [id=>3]
	//  * @param $bolean opérateur  ex: true:id == 3 | false id != 3
	//  * @return Tableau de collection filtré 
	//  **/ 

 //     /*|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 //     |
 //     | A AMELIORE
 //     |
 //     |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/

 //    function filterEloquent($eloquent,array $filter,$boolean = true){
 //        //on enregistre les paramètre dans une variable global
	// 	//pour les faire passée à l'interieur de fonction
 //        session([
 //            'tmp'=>[
 //                    'filter'=>$filter,
 //                    'boolean'=>$boolean
 //                ]
 //        ]);

 //        $filtre = $eloquent->filter(function($value){

 //            if (session('tmp')['boolean'] != true) {
 //                return $value->getAttribute(key(session('tmp')['filter'])) != session('tmp')['filter'][key(session('tmp')['filter'])];    
 //            }else{
 //                return $value->getAttribute(key(session('tmp')['filter'])) == session('tmp')['filter'][key(session('tmp')['filter'])];
 //            }

 //    	});  
 //        //on supprime les variable
 //       session()->forget('tmp');
 //       return $filtre;   
	// }


 //     /**
	//  * Calcul les nombres des correspondances entre deux table
	//  * renvoi dans un tableau chaque Id tab1 => Nbr correpondace tab2
	//  * passé en parametre dans une instace de collection eloquent
	//  * @param $eloquent1 prèmière table
	//  * @param $eloquent2 deuxième table
	//  * @param $name le nom de la clé du tableau associatif
	//  * @return Tableau de collection 
	//  **/ 


 //    function filterNbrCorrespondantEloquents($eloquent1,$eloquent2){
 //    	if ($eloquent1->isNotEmpty()) {	
	//     	foreach ($eloquent1 as $value) {
	//             $id = $value->getAttributeValue($value->getKeyName());
	//             if ($eloquent2->isEmpty()) {
	//            		 $Eloquents[$id]= 0;
	            	
	//             }else{

	//            		 $Eloquents[$id]= filterEloquent($eloquent2,[$value->getKeyName() => $id])->count(); 	
	//             }
	//         }
	//         return $Eloquents;  
 //    	}
 //    	return false;
	// }

	// renvoi une chaine des caractères unique

	function getUniqueCode(){
		$code = strtoupper(str_random(8));
		if(DB::table('codes')->where('code',$code)->count() != 0){
			return getUniqueCode();
		}
		return $code;
	}

	//----------------------------
	//Pour le test seed

	// renvoi une matricule unique

	function getUniqueMatricule(){
		$matricule = random_int(20150000, 20180000);
		if(DB::table('etudiants')->where('matricule',$matricule)->first()){
			return getUniqueMatricule();
		}
		return $matricule;
	}


	 /**
	 * renvoi le lien du pdf stoquer dans storage/bulletin/pdf
	 * 
	 * @param le lien du fichier 
	 * @return url de pdf
	 * 
	 */

  	function get_path_bulletin_pdf_by_etudiant($annee,$session,$auditoire,$matricule){
		$pathPdf = storage_path('app'.DS.'bulletins'.DS.$annee.DS.$session.DS.$auditoire.DS.$matricule);
		
		return $pathPdf.'.pdf';	
    	
    }