

<div>

<script>
	$(document).ready(function() {

		$("#form_recomendaciones_laborales_edit_detalle").validate({
		submitHandler: function(form){
		
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/recomendaciones_laborales/actualizar_detalle",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
						title: 'recomendaciones_laborales',
						text: 'El recomendaciones_laborale ha sido actualizado correctamente!',
						
					});
					$("#form_recomendaciones_laborales_edit_detalle").each (function(){ this.reset()});
					load_detalle($("#codrecomendaciones_laborales").val());
					$("#dilog_edit_detalle").dialog("close");
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al actualizar el recomendaciones_laborale',
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
	id="form_recomendaciones_laborales_edit_detalle"
	name="form_recomendaciones_laborales_edit_detalle"
	>

	<div class="span6">
		
		<input type="hidden" name="codigo" id="codigo" value="<?php echo  $data['codigo']?>">
		
		<div class="control-group">
			<label for="textfield" class="control-label">Nombre</label>
			<div class="controls">
				<select name="codrecomendaciones_laborales" id="codrecomendaciones_laborales">
					<?php 
						foreach ($recomendaciones_laborales as $datarecomendaciones_laborale) {

							//echo "<script>alert('".$data['codrecomendaciones_laborale']."')</script>";

							if($datarecomendaciones_laborale['codigo']==$data['codrecomendaciones_laborales']){
								?>
									<option selected value="<?php echo $datarecomendaciones_laborale['codigo'] ?>"><?php echo $datarecomendaciones_laborale['nombre'] ?></option>
								<?php
							}else{
								?>
									<option  value="<?php echo $datarecomendaciones_laborale['codigo'] ?>"><?php echo $datarecomendaciones_laborale['nombre'] ?></option>
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
					placeholder="Nombre del recomendaciones_laborale" 
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