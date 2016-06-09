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
	 	$("#load_edit_historias").children().remove();
		$("#load_edit_historias").load("<?php echo base_url()?>index.php/historias/edit?codigo="+codigo);
	 	
	 }

	 function activar(codigo){
	 	$.ajax({
			url: '<?php echo base_url()?>index.php/historias/cambiarestado',
			type: 'post',
			data: "accion=a&codigo="+codigo,
			success: function (data) {
				load_historias_search();
			}
		});	
	 }
	 function desactivar(codigo){
	 		$.ajax({
			url: '<?php echo base_url()?>index.php/historias/cambiarestado',
			type: 'post',
			data: "accion=d&codigo="+codigo,
			success: function (data) {
				load_historias_search();
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
				url: '<?php echo base_url()?>index.php/historias/buscardetalle',
				type: 'post',
				data: "codigo="+codigo,
				success: function (data) {
					$("#load_detalle-"+codigo).children().remove("div");
					$("#load_detalle-"+codigo).append(data);
				}
			});

	}

</script>

<div class="container">
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
					if($historias)
					foreach ($historias as $data) {
						?>
							<tr id="<?php echo "tr-".$data["codigo"] ?>" >
								<td><i onclick="expand('<?php echo $data["codigo"] ?>')" id="<?php echo "i-".$data["codigo"] ?>" class="glyphicon-expand"></i></td>
								<td><?php echo $data["codigo"] ?></td>
								<td><?php echo $data["nombres"] ?></td>
								<td><?php echo $data["estado"] ?></td>
								<td>
									<form 
										method="post" 
										action="<?php echo base_url() ?>index.php/historias/editar" 
										>
										
										<input type="hidden" name="codhistoria" value="<?php echo $data["codigo"] ?>">
										<button
											type="submit"
											class="btn btn-green"
										>
											Continuar
										</button>									
									</form>
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
</div>