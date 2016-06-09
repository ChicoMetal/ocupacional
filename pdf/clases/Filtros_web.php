

<?php
 require 'Filtros/Core/gosConfig.inc.php';
  
Class FW{

	 public static function rem($cad){
	 	
        $cad=str_replace("'"," ",$cad);
		 $cad=str_replace("\\"," ",$cad);
		 $cad=str_replace("\""," ",$cad);
		 $cad=str_replace("`"," ",$cad);
		 $cad=str_replace("¨"," ",$cad);
		 $cad=str_replace("¨"," ",$cad);
		 $cad=str_replace("\n"," - ",$cad);
		 $cad=str_replace("\r"," - ",$cad);

		 
		 $cad=str_replace("alert"," ",$cad);
		 $cad=str_replace("<script>"," ",$cad);
		 $cad=str_replace("</script>"," ",$cad);
		 $cad=str_replace("select"," ",$cad);
		 $cad=str_replace("insert"," ",$cad);
		 $cad=str_replace("drop"," ",$cad);
		 $cad=str_replace("delete"," ",$cad);
		 $cad=str_replace("show"," ",$cad);
		 $cad=str_replace("create"," ",$cad);

  		$cad = trim(rtrim($cad));
		
		/*
	
	    $cad = str_replace(
	        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
	        array('&aacute;', '&aacute;', '&aacute;', '&aacute;', '&aacute;', '&Aacute;', '&Aacute;', '&Aacute;', '&Aacute;'),
	        $cad
	    );
	 
	    $cad = str_replace(
	        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
	        array('&eacute;', '&eacute;', '&eacute;', '&eacute;', '&Eacute;', '&Eacute;', '&Eacute;', '&Eacute;'),
	        $cad
	    );
	 
	    $cad = str_replace(
	        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
	        array('&iacute;', '&iacute;', '&iacute;', '&iacute;', '&Iacute;', '&Iacute;', '&Iacute;', '&Iacute;'),
	        $cad
	    );
	 
	    $cad = str_replace(
	        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
	        array('&oacute;', '&oacute;', '&oacute;', '&oacute;', '&Oacute;', '&Oacute;', '&Oacute;', '&Oacute;'),
	        $cad
	    );
	 
	    $cad = str_replace(
	        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
	        array('&uacute;', '&uacute;', '&uacute;', '&uacute;', '&Uacute;', '&Uacute;', '&Uacute;', '&Uacute;'),
	        $cad
	    );
	 
	    $cad = str_replace(
	        array('ñ', 'Ñ', 'ç', 'Ç'),
	        array('&ntilde;', '&Ntilde;', 'c', 'C',),
	        $cad
	    );
		
		/*/
	    return $cad;
   }
  
   public static function vt($xss){
         $html = gosSanitizer::sanitizeForHTMLContent($xss);
         $html =antijs($html);
         return $html;
   }
  
    public static function antijs($js){
   		$js_limpia=gosSanitizer::sanitizeForJS($js);
   		return $js_limpia; 
	
   }
	public  function timequery(){
	   static $querytime_begin;
	   list($usec, $sec) = explode(' ',microtime());
	    
	       if(!isset($querytime_begin))
	      {   
	         $querytime_begin= ((float)$usec + (float)$sec);
	      }
	      else
	      {
	         $querytime = (((float)$usec + (float)$sec)) - $querytime_begin;
	         echo sprintf('<br />La consulta tardó %01.5f segundos.- <br />', $querytime);
	      }
	}
}




?>