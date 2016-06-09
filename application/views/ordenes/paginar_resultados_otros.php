<script>
$(document).ready(function(){

	$(".page_link").click(function(){
		
		
		numpaginaotros=$(this).attr("pagina");
		paginar_ordendes_otros(porpaginaotros,numpaginaotros,paciente);	
		
	});


	action="<?php echo base_url() ?>index.php/historias/nueva"

});




</script>


<table class="table table-hover table-nomargin table-striped ">
	<thead>

		<tr>
			<th>Orden</th>
			<th>Paciente</th>
			<th>Fecha</th>
			<th>Examen</th>
			<th>Accion</th>
		</tr>
	</thead>
					

	<tbody>
<?php 

if($actividades!=""){
foreach ($actividades as $datos) {


	?>
	<tr>
		<td><?php echo $datos['codorden'] ?></td>
		<td>
		<?php echo $datos['nombres'] ?> <?php echo $datos['apellidos'] ?>
		</td>
		<td> <?php echo $datos['fecha'] ?> <?php echo $datos['estado'] ?></td>
		<td><?php echo $datos['actividad'] ?> </td>
		<td>
		<form 
			action="<?php echo base_url() ?>index.php/otros_examenes/nueva" 
		method="post"
		>
			<input 
				type="hidden" 
				name="codorden" 
				value="<?php echo $datos['codorden']?>"
			>
			<input 
				type="hidden" 
				name="codactividad" 
				value="<?php echo $datos['codactividad']?>"
			>

			<button 
				type="submit"
			  	class="btn btn-lightred icon-caret-right"
			>
				Realizar
			</button>
		</form>
		</td>

	</tr>

	<?php
}

}else{
	echo "No exiten historias pendientes";

}
?>

				</tbody>
		
				</table>
				

<div class="pagination btn-group">
	
<?php
for ($i=1; $i <=$numerodepaginas ; $i++) { 
	echo '<button class="btn page_link" pagina="'.$i.'">'.$i.'</button>"';
}
?>
	
</div>
<?php


 ?>


		
	