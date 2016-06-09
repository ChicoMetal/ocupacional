<script>
	$(document).ready(function() {
		$(".action_button").click(function(event){
		 	event.preventDefault();
		 	var array = $(this).attr("id").split("-");
		 	if(array[0]=="e"){
		 		editar(array[1]);
		 	}else if(array[0]=="d"){
		 		desactivar(array[1]);
		 	}else if(array[0]=="a"){
		 		activar(array[1]);
		 	}
		 	
		 });

	

	 function activar(codigo){
	 	$.ajax({
			url: '<?php echo base_url()?>index.php/empresas/cambiarestado',
			type: 'post',
			data: "accion=a&codigo="+codigo,
			success: function (data) {
				load_empresas_search();
			}
		});	
	 }
	 function desactivar(codigo){
	 		$.ajax({
			url: '<?php echo base_url()?>index.php/empresas/cambiarestado',
			type: 'post',
			data: "accion=d&codigo="+codigo,
			success: function (data) {
				load_empresas_search();
			}
		});
	 }

	});

</script>


<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Empresas
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
					<thead>
					
						<tr>
							<th>Codigo</th>
							<th>Nit</th>
							<th>Razon Social</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Acción</th>
						</tr>
					</thead>
									

<tbody>
<?php 
if($empresas)
foreach ($empresas as $data) {
	?>
		<tr>
			<td><?php echo $data["codigo"] ?></td>
			<td><?php echo $data["nit"] ?></td>
			<td><?php echo $data["razonsocial"] ?></td>
			<td><?php echo $data["direccion"] ?></td>
			<td><?php echo $data["telefono"] ?></td>
			<td>
				<div class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Acción <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<!--<li><a class="action_button" href="#" id="<?php echo "e-".$data["codigo"] ?>"><i class="glyphicon-edit"></i>Editar</a></li>-->
						<li><a class="edit_button" href="#" onclick="editar(<?php echo "".$data["codigo"] ?>)"><i class="icon-edit"></i>Editar</a></li>	
						<?php if($data["estado"]=="activo"){
							?>
							<li><a class="action_button" href="#" id="<?php echo "d-".$data["codigo"] ?>"><i class="icon-off"></i>Deactivar</a></li>
							<?php

						}else{
							?>
							<li><a class="action_button" href="#" id="<?php echo "a-".$data["codigo"] ?>"><i class="icon-off"></i>Activar</a></li>
							<?php
						}?>
						
					</ul>
				</div>

			</td>
		</tr>


	<?php
}

 ?>

</tbody>
		
				</table>
			</div>
		</div>
	</div>
</div>