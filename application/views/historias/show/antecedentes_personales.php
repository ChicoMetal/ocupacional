<table  >
	
	<thead>
		<tr>
			<th colspan="4">Antecedentes personales</th>
		</tr>
	</thead>
	<tbody>
		
	
<?php 
if($data!="")
foreach ($data as $datos) {
	
?>
<tr>
	<td><?php echo $datos['nombre']?></td>
	<td><?php echo $datos['observacion']?></td>
</tr>	



<?php

}

 ?>

</tbody>
</table>
