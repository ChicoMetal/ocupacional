<script>
$(document).ready(function(){

	$(".page_link1").click(function(event){
		event.preventDefault();
		
		porpagina =$("#porpagina1").val();
		pagina=$(this).attr("pagina");
		alert(porpagina+" "+pagina);
		paginar_ordendes_otros(porpagina,pagina);	

	});


	action="<?php echo base_url() ?>index.php/historias/nueva"

});




</script>


<table class="table table-hover table-nomargin table-striped ">
	<thead>

		<tr>
			<th>Orden</th>
			<th>Paciente</th>
			<th>Dirección</th>
			<th>Accion</th>
		</tr>
	</thead>
					

	<tbody>
<?php 
foreach ($audiometrias as $datos) {
	?>
	<tr>
		<td><?php echo $datos['codorden'] ?></td>
		<td>
		<?php echo $datos['nombres'] ?> <?php echo $datos['apellidos'] ?>
		</td>
		<td><?php echo $datos['fecha'] ?></td>
		<td>
			
			<form 
				action="<?php echo base_url() ?>index.php/audiometrias/realizar" 
			method="post"
			>
				<input 
					type="hidden" 
					name="codorden" 
					value="<?php echo $datos['codorden']?>"
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
?>

				</tbody>
		
				</table>
				

<div class="pagination">
	<ul>

<?php
for ($i=1; $i <=$numerodepaginas ; $i++) { 
	echo '<li><div pagina="'.$i.'" class="page_link1">'.$i.'</div></li>';
}
?>
	</ul>
</div>
<?php


 ?>


		
	