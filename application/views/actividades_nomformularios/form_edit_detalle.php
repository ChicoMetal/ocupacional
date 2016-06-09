

<div>

<script>
	$(document).ready(function() {

		$("#form_actividades_nomformularios_edit_detalle").validate({
		submitHandler: function(form){
		
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/actividades_nomformularios/actualizar_detalle",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
						title: 'actividades_nomformularios',
						text: 'El actividades_nomformulario ha sido actualizado correctamente!',
						
					});
					$("#form_actividades_nomformularios_edit_detalle").each (function(){ this.reset()});
					load_detalle($("#codactividades_nomformulario").val());
					$("#dilog_edit_detalle").dialog("close");
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al actualizar el actividades_nomformulario',
					});

                }

            });
        }
    });

	 


 
	});

</script>

<?php 

if($detalles)
foreach ($detalles as $data) {

?>

<form 
	method="POST" 
	class='form-horizontal form-column form-bordered'
	id="form_actividades_nomformularios_edit_detalle"
	name="form_actividades_nomformularios_edit_detalle"
	>

	<div class="span6">
		
		<input type="hidden" name="codigo" id="codigo" value="<?php echo  $data['codigo']?>">
		
		<div class="control-group">
			<label for="textfield" class="control-label">Nombre</label>
			<div class="controls">
				<select name="codactividades_nomformulario" id="codactividades_nomformulario">
					<?php 
						foreach ($actividades_nomformularios as $dataactividades_nomformulario) {
							if($dataactividades_nomformulario['codigo']==$data['codactividades_nomformulario']){
								?>
									<option selected value="<?php echo $dataactividades_nomformulario['codigo'] ?>"><?php echo $dataactividades_nomformulario['nombre'] ?></option>
								<?php
							}else{
								?>
									<option  value="<?php echo $dataactividades_nomformulario['codigo'] ?>"><?php echo $dataactividades_nomformulario['nombre'] ?></option>
								<?php
							}
						}

					 ?>

				</select>
		

			</div>
		</div>

		
		<div class="control-group">
			<label for="textfield" class="control-label">Nombre</label>
			<div class="controls">
				<input 
					type="text" 
					name="nombre" 
					id="nombre" 
					placeholder="Nombre del actividades_nomformulario" 
					class="input-xlarge"
					value="<?php echo  $data['nombre']?>"
					data-rule-required="true"
					data-rule-maxlength="100"
					
					>
			</div>
		</div>


	


		<div class="control-group">
			<label for="textfield" class="control-label">Estado</label>
			<div class="controls">
				<input 
					type="radio" 
					name="estado" 
					id="estado"  
					value="activo"
					<?php 
						if($data['estado']=="activo"){
							echo "checked";
						}
					?>> Activo <br>
				<input 
					type="radio" 
					name="estado" 
					id="estado" 
					value="inactivo" 
					<?php 
						if($data['estado']=="inactivo"){
							echo "checked";
						}
					?>> Inactivo 
			</div>
		</div>




		


	</div>
	<div class="span12">
		<div class="form-actions">
			<input  
				type="submit" 
				class="btn btn-primary" 
				id="guardar"  
				value="Guardar"
			>

			<button type="reset" class="btn">Reset</button>

		</div>
	</div>

</form>
<?php 
}
 ?>

 </div>