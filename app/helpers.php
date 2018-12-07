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
	 * @param le lien du fichier 
	 * @param le lien de stockage du fichier
	 * @return url de img stoquer 
	 * 
	 */

  	function get_bulletin_img($file){
		
		$pathPdf = storage_path('app'.DS.'bulletins'.DS.'pdf'.DS.$file);
		$pathImg = storage_path('app'.DS.'bulletins'.DS.'img'.DS.$file);
		$pdf = new \Spatie\PdfToImage\Pdf('/home/bilwifi/www/ePublish/storage/app/bulletins/pdf/201515_DIALUNDAMA_1.pdf');
		$pdf->_saveImage($pathImg,$file);
		$format =$pdf->getOutputFormat();
	
		return $pathImg.'.'.$format;	
    	
    }

    /**
	 * renvoi le lien du pdf stoquer dans storage/bulletin/pdf
	 * 
	 * @param le lien du fichier 
	 * @return url de pdf
	 * 
	 */

      	function get_bulletin_pdf($file){
			$pathPdf = storage_path('app'.DS.'bulletins'.DS.'pdf'.DS.$file);
			
			return $pathPdf.'.pdf';	
    	
    }


      /**
	 * renvoi le ormat de lien de route publish pour l'etudiant connecté 
	 * 
	 * @return string url | null
	 */

      	function getPublishUrl(){
			if (!empty(session('student'))) {
				return session('student')->nom."?c=".session('student')->idcodes;
			}			
			return 'welcome.index';	
    	
    }