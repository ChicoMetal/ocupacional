
<table>
	<tr>
<?php 
$cont=0;
$cods_ant="";
foreach ($antecedentes as  $datos) {
	$cods_ant=$cods_ant.$datos['codigo'].",";
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
		<input type="text" name="txtant-<?php echo "".$datos['codigo'] ?>" class="input-medium" placeholder="Niega">
	</td>



	
<?php
}

?>
<input type="hidden"  name="cod_antecedentes" value="<?php echo $cods_ant ?>">
</tr>
</table>