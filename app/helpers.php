<?php  
	
	/**
	* 
	* CONSTANTS
	*
	**/
	define('DS', DIRECTORY_SEPARATOR);


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