
<table>
	<caption>Examen de alto riesgo</caption>
	<thead>
		<tr>
			<th>Pregunta</th>
			<td>Observacion</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		
<?php 
if($data!="")
foreach ($data as $datos) {
	
?>
<tr>
	<td><?php echo $datos['pregunta']?></td>
	<td><?php echo $datos['valor']?></td>

</tr>


<?php

}

 ?>

	</tbody>
</table>