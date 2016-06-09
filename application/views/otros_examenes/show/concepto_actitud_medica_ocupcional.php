<table border="1" >
	
	<thead>
		<tr>
			<th colspan="4">Concepto de actitud medica ocupcional</th>
		</tr>
	</thead>
	<tbody>
		
			


<?php 
$primero=0;
$cods_conceptoactitud="";
foreach ($concepto_actitud_medica_ocupcional as  $datos) {
$cods_conceptoactitud=$cods_conceptoactitud.$datos['codigo'].",";
?>
<tr>
	<td><?php echo "concepto-".$datos['codigo'] ?></td>
	<td><?php echo $datos['nombre'] ?></td>
</tr>	

	
<?php

}

?>


</tbody>
</table>
