

<div>

<script>
	$(document).ready(function() {

		$("#form_actividades_edit").validate({
		submitHandler: function(form){
		
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/actividades/actualizar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
						title: 'actividades',
						text: 'El actividad ha sido actualizado correctamente!',
						
					});
					$("#form_actividades").each (function(){ this.reset()});
					load_actividades_search();
					$("#dilog_show").dialog("close");
									
                },
                error: function(data){

                	$.gritter.add({
										title: 'Error',
										text: 'Ocurrio un error al actualizar el actividad',
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
	id="form_actividades_edit"
	name="form_actividades_edit"
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
					placeholder="Nombre del actividad" 
					class="input-xxlarge"
					value="<?php echo  $data['nombre']?>"
					data-rule-required="true"
					data-rule-maxlength="100"
					
					>
			</div>
		</div>


		<div class="control-group">
			<label for="textfield" class="control-label">Descripción</label>
			<div class="controls">
				<textarea 
					
					name="descripcion" 
					id="descripcion" 
					placeholder="Descripción de la actividad" 
					class="input-xxlarge"
					
					data-rule-maxlength="500"
					
					><?php echo  $data['descripcion']?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label for="textfield" class="control-label">valor</label>
			<div class="controls">
				<input 
					type="text" 
					name="valor" 
					id="valor" 
					placeholder="Valor de la actividad" 
					class="input-medium"
					value="<?php echo  $data['valor']?>"
					data-rule-required="true"
					data-rule-number="true"
					>
			</div>
		</div>


		<div class="control-group">
			
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


		<div class="control-group">
			<label for="textfield" class="control-label">Historia Obligatoria</label>
			<div class="controls">
				<input 
					type="radio" 
					name="historia_obligatoria" 
					id="historia_obligatoria"  
					value="si"
					<?php 
						if($data['historia_obligatoria']=="si"){
							echo "checked";
						}
					?>> Si <br>
				<input 
					type="radio" 
					name="historia_obligatoria" 
					id="historia_obligatoria" 
					value="no" 
					<?php 
						if($data['historia_obligatoria']=="no"){
							echo "checked";
						}
					?>> No 
			</div>
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