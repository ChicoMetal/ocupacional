<style type="text/css">
	i{
		cursor: pointer;

	}

</style>


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

	 function editar(codigo){
	 	$("#dilog_show").dialog("open");
	 	$("#load_edit_diagnosticosgenerales").children().remove();
		$("#load_edit_diagnosticosgenerales").load("<?php echo base_url()?>index.php/diagnosticosgenerales/edit?codigo="+codigo);
	 	
	 }

	 function activar(codigo){
	 	$.ajax({
			url: '<?php echo base_url()?>index.php/diagnosticosgenerales/cambiarestado',
			type: 'post',
			data: "accion=a&codigo="+codigo,
			success: function (data) {
				load_diagnosticosgenerales_search();
			}
		});	
	 }
	 function desactivar(codigo){
	 		$.ajax({
			url: '<?php echo base_url()?>index.php/diagnosticosgenerales/cambiarestado',
			type: 'post',
			data: "accion=d&codigo="+codigo,
			success: function (data) {
				load_diagnosticosgenerales_search();
			}
		});
	 }

	});

	function expand(codigo){

		if($("#i-"+codigo).attr("class")=="glyphicon-expand"){
			$("#trshow-"+codigo).removeClass('hidden');
			$("#i-"+codigo).removeClass('glyphicon-expand').addClass('glyphicon-collapse_top');
			load_detalle(codigo);
		}else if($("#i-"+codigo).attr("class")=="glyphicon-collapse_top"){
			$("#trshow-"+codigo).addClass('hidden');
			$("#i-"+codigo).removeClass('glyphicon-collapse_top').addClass('glyphicon-expand');
	

		}
			
			
	}

	function load_detalle(codigo){
		$.ajax({
				url: '<?php echo base_url()?>index.php/diagnosticosgenerales/buscardetalle',
				type: 'post',
				data: "codigo="+codigo,
				success: function (data) {
					$("#load_detalle-"+codigo).children().remove("div");
					$("#load_detalle-"+codigo).append(data);
				}
			});

	}

</script>

			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
					<thead>
					
						<tr>
							<th></th>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Accion</th>

							
						</tr>
					</thead>
					

					<tbody>
					<?php 
					if($diagnosticosgenerales)
					foreach ($diagnosticosgenerales as $data) {
						?>
							<tr id="<?php echo "tr-".$data["codigo"] ?>" >
								<td><i onclick="expand('<?php echo $data["codigo"] ?>')" id="<?php echo "i-".$data["codigo"] ?>" class="glyphicon-expand"></i></td>
								<td><?php echo $data["codigo"] ?></td>
								<td><?php echo $data["nombre"] ?></td>
								<td><?php echo $data["estado"] ?></td>
								<td>
									<div class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Acción <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a class="action_button" href="#" id="<?php echo "e-".$data["codigo"] ?>"><i class="glyphicon-edit"></i>Editar</a></li>
											
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
							<tr class="hidden" id="<?php echo "trshow-".$data["codigo"] ?>">
								<td colspan="5">
									<div id="load_detalle-<?php echo $data["codigo"] ?>">

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