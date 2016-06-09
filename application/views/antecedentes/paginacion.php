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
	 	$("#load_edit_antecedentes").children().remove();
		$("#load_edit_antecedentes").load("<?php echo base_url()?>index.php/antecedentes/edit?codigo="+codigo);
	 	
	 }

	 function activar(codigo){
	 	$.ajax({
			url: '<?php echo base_url()?>index.php/antecedentes/cambiarestado',
			type: 'post',
			data: "accion=a&codigo="+codigo,
			success: function (data) {
				load_antecedentes_search();
			}
		});	
	 }
	 function desactivar(codigo){
	 		$.ajax({
			url: '<?php echo base_url()?>index.php/antecedentes/cambiarestado',
			type: 'post',
			data: "accion=d&codigo="+codigo,
			success: function (data) {
				load_antecedentes_search();
			}
		});
	 }

	});

</script>

			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
					<thead>
					
						<tr>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Tipo</th>
							<th>Estado</th>
							<th>Accion</th>

							
						</tr>
					</thead>
					

					<tbody>
					<?php 
					if($antecedentes)
					foreach ($antecedentes as $data) {
						?>
							<tr id="<?php echo "tr-".$data["codigo"] ?>">
								<td><?php echo $data["codigo"] ?></td>
								<td><?php echo $data["nombre"] ?></td>
								<td><?php echo $data["tipo"] ?></td>
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


						<?php
					}

					 ?>

					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>