<script>
$(document).ready(function(){

	$(".page_link").click(function(event){
		event.preventDefault();

		
		numpagina=$(this).attr("pagina");
		paginar_ordendes(porpagina,numpagina,paciente);	

	});


	action="<?php echo base_url() ?>index.php/historias/nueva"

});




</script>


<table class="table table-hover table-nomargin table-striped ">
	<thead>

		<tr>
			<th>Orden</th>
			<th>Paciente</th>
			<th>Empresa</th>
			<th>Fecha</th>
			<th>Tarea</th>
			<th colspan="2">Accion</th>
		</tr>
	</thead>
					

	<tbody>
<?php 

if($actividades!=""){
foreach ($actividades as $datos) {


	?>
	<tr>
		<td> <?php echo $datos['codorden'] ?></td>
		<td>
		<?php echo $datos['nombres'] ?> <?php echo $datos['apellidos'] ?>
		</td>
		<td>
		<?php echo $datos['razonsocial'] ?>
		</td>
		<td> <?php echo $datos['fecha'] ?> <?php echo $datos['estado'] ?></td>

		
			<?php 
				if($datos['estado']=="pendiente"){
			?>
				<td>Ingreso de datos </td>
				<td>
				<form 
					action="<?php echo base_url() ?>index.php/historias/nueva" 
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
			<?php

				}else if($datos['estado']=="llenando" && $ses['permisos']=="administracion"){

			?>
				<td>Examen fisico</td>
				<td>
				<form 
					action="<?php echo base_url() ?>index.php/historias/examen_fisico"
					method="post">

					<input 
						type="hidden" 
						name="codorden" 
						value="<?php echo $datos['codorden']?>"

					>
					<button 
						type="submit"
						class="btn btn-orange icon-caret-right"
					  
					>
					Realizar
				</button>
				</form>
				</td>	
			<?php
				}else if($datos['estado']=="concepto" && $ses['permisos']=="administracion"){

			?>
				<td>Concepto de actitud</td>
				<td>
					
				<form 
					action="<?php echo base_url() ?>index.php/historias/vita_previa_concepto/<?php echo $datos['codhistoria']?>"
					method="post">

					<input 
						type="hidden" 
						name="codorden" 
						value="<?php echo $datos['codorden']?>"

					>
					<button 
						type="submit"
						class="btn btn-satgreen icon-caret-right"
					  
					>
					Realizar
				</button>
				</form>
				</td>
			<?php
				}
			 ?>
		<td>
			<form 
				id="editar_orden" 
				method="post"
				action="<?php echo base_url() ?>index.php/ordenes/editar/"
				>
				<input type="hidden" name="orden" value="<?php echo $datos['codorden']?>">
				<button 
					type="submit"
					class="btn btn-info icon-caret-right"
				  
				>
					Editar
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
	<ul>

<?php
for ($i=1; $i <=$numerodepaginas ; $i++) { 
	echo '<button class="btn page_link" pagina="'.$i.'">'.$i.'</button>"';
}
?>
	</ul>
</div>
<?php


 ?>


		
	