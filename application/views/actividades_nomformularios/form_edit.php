

<div>

<script>
	$(document).ready(function() {

		$("#form_actividades_nomformularios_edit").validate({
		submitHandler: function(form){
		
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/actividades_nomformularios/actualizar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
						title: 'actividades_nomformularios',
						text: 'El actividades_nomformulario ha sido actualizado correctamente!',
						
					});
					$("#form_actividades_nomformularios").each (function(){ this.reset()});
					load_actividades_nomformularios_search();
					$("#dilog_show").dialog("close");
									
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

if($actividad)
foreach ($actividad as $data) {

?>

<form 
	method="POST" 
	class='form-horizontal form-column form-bordered'
	id="form_actividades_nomformularios_edit"
	name="form_actividades_nomformularios_edit"
	>

	<div class="span6">
		
		<input type="hidden" name="codigo" id="codigo" value="<?php echo  $data['codigo']?>">
		

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
			<label for="textfield" class="control-label">Orden</label>
			<div class="controls">
				<input 
					type="text" 
					name="orden" 
					id="orden" 
					placeholder="Orden" 
					class="input-xlarge"
					value="<?php echo  $data['orden']?>"
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