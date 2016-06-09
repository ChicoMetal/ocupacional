<?php
 require 'Core/gosConfig.inc.php';
 
Class FB{

	 public static function rem($cad){
         $cad=str_replace("'","",$cad);
		 $cad=str_replace("\\","",$cad);
		
		 
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

}




?>