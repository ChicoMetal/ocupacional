<script type="text/javascript">
	
	$(".action_button2").click(function(event){
	 	event.preventDefault();
	 	var array = $(this).attr("id").split("-");
	 	
	 	if(array[1]=="e"){
	 		editar_det(array[2]);
	 	}else if(array[1]=="d"){
	 		desactivar_det(array[2]);
	 	}else if(array[1]=="a"){
	 		activar_det(array[2]);
	 	}
	 	
	 });

	function abrirDialogDetalle(codigo){

		$("#dilog_new_detalle").dialog("open");
		$("#codrecomendaciones_laboraleadd").val(codigo);
	}


	function editar_det(codigo){
		
	 	$("#dilog_edit_detalle").dialog("open");
	 	$("#load_edit_detalle").children().remove();
		$("#load_edit_detalle").load("<?php echo base_url()?>index.php/recomendaciones_laborales/edit_detalle?codigo="+codigo);
	 	
	}
	function activar_det(codigo){
		$.ajax({
		url: '<?php echo base_url()?>index.php/recomendaciones_laborales/cambiarestado_detalle',
		type: 'post',
		data: "accion=a&codigo="+codigo,
		success: function (data) {
			load_detalle($("#codrecomendaciones_laborale").val());
		}
	});	
	}
	function desactivar_det(codigo){
			$.ajax({
		url: '<?php echo base_url()?>index.php/recomendaciones_laborales/cambiarestado_detalle',
		type: 'post',
		data: "accion=d&codigo="+codigo,
		success: function (data) {
			load_detalle($("#codrecomendaciones_laborale").val());
		}
	});
	}

</script>



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered dark_blue_smal">
			<div class="box-title">
				<h3><i class="icon-list"></i> Detalles de <?php echo $recomendaciones_laborales ?></h3>
			</div>

<div class="box-content nopadding">

<table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder yellow_smal">
	<thead>
	
		<tr>
			
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Estado</th>
			<th>Acción</th>
			<th><button class="btn btn-green" onclick="abrirDialogDetalle('<?php  echo $codigo ?>')">Añadir</button></th>
		</tr>
	</thead>
	

	<tbody>
	<?php 
	if($detallesderecomendaciones_laborales)
	foreach ($detallesderecomendaciones_laborales as $data) {
		?>
			<tr>
				
				<td><?php echo $data["codigo"] ?></td>
				<td colspan="2"><?php echo $data["nombre"] ?></td>
				<td><?php echo $data["estado"] ?></td>
				<td>
					<div class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Acción <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a class="action_button2" href="#" id="<?php echo "d-e-".$data["codigo"] ?>"><i class="glyphicon-edit"></i>Editar</a></li>
							
							<?php if($data["estado"]=="activo"){
								?>
								<li><a class="action_button2" href="#" id="<?php echo "d-d-".$data["codigo"] ?>"><i class="icon-off"></i>Deactivar</a></li>
								<?php

							}else{
								?>
								<li><a class="action_button2" href="#" id="<?php echo "d-a-".$data["codigo"] ?>"><i class="icon-off"></i>Activar</a></li>
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

