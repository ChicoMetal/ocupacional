<script>
$(document).ready(function(){

	$(".page_link").click(function(event){
		event.preventDefault();
		porpagina =$("#porpagina").val();
		pagina=$(this).attr("pagina");
		paginar(porpagina,pagina);	

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
			<th>Tarea</th>
			<th>Accion</th>
		</tr>
	</thead>
					

	<tbody>
<?php 
if($certificados!=""){

foreach ($certificados as $datos) {


	?>
	<tr>
		<td><?php echo $datos['codorden'] ?></td>
		<td>
		<?php echo $datos['nombres'] ?> <?php echo $datos['apellidos'] ?>
		</td>
		<td><?php echo $datos['fecha'] ?></td>

				<td>Finalizada</td>
				<td>
				<form 
					action="<?php echo base_url() ?>index.php/formatos/mostrar_certificado_historia/<?php echo $datos['codigo']?>" 
				method="post"
				>
					
					<button 
						type="submit"
					  	class="btn btn-lightred icon-caret-right"
					>
						Ver
					</button>
				</form>
				</td>
	
	</tr>

	<?php

}

}else{
	echo "<tr><td colspan='5'>No exiten Certificados del paciente</td></tr>";

}
?>

				</tbody>
		
				</table>
				

<div class="pagination">
	<ul>

<?php
for ($i=1; $i <=$numerodepaginas ; $i++) { 
	echo '<li><a href="#" pagina="'.$i.'" class="page_link">'.$i.'</a></li>';
}
?>
	</ul>
</div>
<?php


 ?>


		
	