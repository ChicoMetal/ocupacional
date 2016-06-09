<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <link type="text/css" href="jquery-ui-1.8.12.custom/css/redmond/jquery-ui-1.8.12.custom.css" rel="Stylesheet" />
    <link type="text/css" href="css/jQueryestilo.css" rel="Stylesheet" />
    <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
    <link rel="stylesheet" href="css/template.css" type="text/css"/>
	<link rel="stylesheet"  href="css/estilo.css" type="text/css" />  
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.1.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script src="js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"> </script>
    <link rel="stylesheet" href="calendario/kalendar.css" type="text/css" media="screen" />
	<script language="javascript" type="text/javascript" src="calendario/jquery.kalendar.min.js"></script>
   
<script>
    $(document).ready(function(){
    	$("#fini").kalendar({
    		show_year_control: 'true'
    		
    	});
    	$("#ffin").kalendar({
    		show_year_control: 'true' 
    	});
   
	 
	});

function buscarcodigo(){
	
	if($('#codigo').attr('value')==""){
		alert('Debe escribir un codigo');
	}else{
		$("#load_imagen").remove();
		$("#load_formatos").append('<div id="load_imagen"><img src="img/loading.gif" width="50px" height="50px"></div>');  
		$("#load_formatos").load("busquedas/paginacion_formatos.php?codigo="+$('#codigo').attr('value'));

	}
}

function buscarfecha(){
	
	if($('#ffin').attr('value')=="" || $('#fini').attr('value')==""){
		alert('Debe escribir las fechas');
	}else{
		$("#load_imagen").remove();
		$("#load_formatos").append('<div id="load_imagen"><img src="img/loading.gif" width="50px" height="50px"></div>');  
		$("#load_formatos").load("busquedas/paginacion_formatos.php?fini="+$('#fini').attr('value')+"&ffin="+$('#ffin').attr('value'));

	}
}

</script>
   
   
</head>
<body>
<?php
	require'menu.php';
?>
	<br><br><br><br>
    <table>
        <tr>
            <td> Buscar por c&oacute;digo</td>
            <td>Buscar por fecha</td>
            <td></td>
        </tr>
        <tr>
            <td><input type="text" name="codigo"  id="codigo"> <input type="submit" value="Buscar " onclick="buscarcodigo()"></td>
            <td>F. inicial <input type="text" name="fini"  id="fini"  > F. Final <input type="text" name="ffin"  id="ffin" > 
            	<input type="submit" value="Buscar " onclick="buscarfecha()">
            </td>
            <td></td>
        </tr>
        
    </table>
    <div id="load_formatos">
    	<div id="load_imagen"></div>
        
    </div>

        
    
    
</body>
</html>
    
