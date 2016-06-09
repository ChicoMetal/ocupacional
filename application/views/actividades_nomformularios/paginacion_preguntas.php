<table class="table"> 
	
	<thead>
	
		<tr>
			
			<th>Codigo</th>
			<th colspan="2">Pregunta</th>
			<th>Respuestas</th>
			<th>Estado</th>
			<th>Acción</th>
			
		</tr>
	</thead>
	
	<tbody>
		
<?php 
if($preguntas!="")
foreach ($preguntas as $data) {
	?>
<tr>
	
	<td><?php echo $data["codigo"] ?></td>
	<td colspan="2"><?php echo $data["pregunta"] ?></td>
	<td><?php echo $data["campos"] ?></td>
	<td><?php echo $data["estado"] ?></td>
	

</tr>


	<?php
}

 ?>
	</tbody>
</table>