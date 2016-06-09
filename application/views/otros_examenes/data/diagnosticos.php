

<?php 

$cod_diagnosticos="";
foreach ($diagnosticos as  $datos) {
	$cod_diagnosticos=$cod_diagnosticos.$datos['codigo'].",";
	

?>
	<input type="checkbox" name="<?php echo "diag-".$datos['codigo'] ?>">
	<?php echo $datos['nombre'] ?></td>
	<br>


	
<?php

}

?>

<input type="hidden" value="<?php echo $cod_diagnosticos ?>" name="cod_diagnosticos">
