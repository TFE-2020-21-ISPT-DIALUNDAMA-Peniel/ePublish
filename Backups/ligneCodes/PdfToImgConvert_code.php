<?php


	/**
	 * converti un fichier pdf en img
	 * avec le package PdfToImage 
	 * https://github.com/spatie/pdf-to-image
	 * @param le fichier pdf à convertir
	 * @param le lien du fichier 
	 * @param le lien de stockage du fichier
	 * @return bolean
	 * 
	 */

    public function convertPdfToImg($file,$linkFile,$linkStock){
    	if(is_file($file)){
    		if ($file['extention'] == 'pdf' && $file['size'] <= 1000000) {
    			$pdf = new \Spatie\PdfToImage\Pdf($linkFile);
    			$pdf->saveImage($linkStock);
    			return true;
    		}
    		return 'Format non prise en charge';
    	}
    }