<table>
	
	<tr>

<?php 
$tipo="";
$cont=0;
$cods_ant="";

foreach ($antecedentes as  $datos) {
//." - ".$datos['tipo'];
	if($sexo=="Masculino" && $datos['tipo']!="gineco obstétricos"){
		
		$cods_ant=$cods_ant.$datos['codigo'].",";
		if($tipo!=$datos['tipo']){
			echo "<table class='table'><tr><th colspan='4'>Antecedentes ".$datos['tipo']."</th></tr><tr>";
		}
		$tipo=$datos['tipo'];
		if($cont==1){
			echo "</tr><tr>";
			$cont=0;
		}else{
			$cont++;
		}
		
?>


	<td><?php echo $datos['nombre'] ?></td>
	<td>
		Si <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>">
		No <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>" checked>
		<input type="text" name="txtant-<?php echo "".$datos['codigo'] ?>" class="input-medium" value="Niega">
	</td>



	
<?php
}else if($sexo=="Femenino"){
$cods_ant=$cods_ant.$datos['codigo'].",";
		if($tipo!=$datos['tipo']){
			echo "<table class='table'><tr><th colspan='4'>Antecedentes ".$datos['tipo']."</th></tr><tr>";
		}
		$tipo=$datos['tipo'];
		if($cont==1){
			echo "</tr><tr>";
			$cont=0;
		}else{
			$cont++;
		}
		
?>


	<td><?php echo $datos['nombre'] ?></td>
	<td>
		Si <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>">
		No <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>" checked>
		<input type="text" name="txtant-<?php echo "".$datos['codigo'] ?>" class="input-medium" value="Niega">
	</td>



	
<?php

}

}

?>
<input type="hidden"  name="cod_antecedentes" value="<?php echo $cods_ant ?>">
</tr>
</table>