
<script type="text/javascript">
nombre="";
estado="";
cantidad=30;
$(document).ready(function(){
	

	$("#dilog_show").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 460,
            width: 800,
             resizable: false 
    });

   	



	load_audiometrias_sugerencias_search();
	
	
	$("#form_audiometrias_sugerencias").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/audiometrias_sugerencias/guardar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
										title: 'audiometrias_sugerencias',
										text: 'La tipo_examene ha sido guardado correctamente!',
										
									});
									$("#form_audiometrias_sugerencias").each (function(){ this.reset()});
									load_audiometrias_sugerencias_search();
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al guardar la tipo_examene',
					});

                }

            });
        }
    });

	 


  });

	function load_audiometrias_sugerencias_search(){

		nombre 		=$("#nombre_search").val();
		
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
	
		$("#load_audiometrias_sugerencias").children().remove();
			dataString="&nombre="+nombre
						
						+"&estado="+estado
						+"&cantidad_res="+cantidad;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/audiometrias_sugerencias/mostrar_ajax",
            data: dataString,
            success: function(data){
        		$("#load_audiometrias_sugerencias").append(data);
            },
            error: function(data){
            	$("#load_audiometrias_sugerencias").html(data);
            }

        });


	}



</script>



<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered green">
			<div class="box-title">
				<h3><i class="icon-list"></i> Administracion de audiometrias_sugerencias</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_audiometrias_sugerencias"
					name="form_audiometrias_sugerencias"
					>

					<div class="span6">
						
						
						<div class="control-group">
							<label for="textfield" class="control-label">Nombre</label>
							<div class="controls">
								<input 
									type="text" 
									name="nombre" 
									id="nombre" 
									placeholder="Nombre del tipo_examene" 
									class="input-xxlarge"
									value="<?php echo set_value('nombre') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>


		
					</div>
					<div class="span12">
						<div class="form-actions">
							<input  
								type="submit" 
								class="btn btn-satblue" 
								id="guardar"  value="Guardar">
							<button type="reset" class="btn">Limpiar</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>




<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered lightred">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					audiometrias_sugerencias
				</h3>

			</div>
			<br>
	<div class="control-group">
	Nombre
	<input 
		type="text" 
		name="nombre_search" 
		id="nombre_search"
		class="input-small"

	>
	
	Estado
	<select
		name="estado_search" 
		id="estado_search"
		class="input-medium"
		>
		
		<option  value="activo"> Activo </option>
		<option  value="inactivo"> Inactivo </option>
		<option  value=""> Todos </option>
	</select>
	Mostrar
	<select 
		id="cantidad_res"
		class="select2-container input-medium"
	>
		<option value="30">30</option>
		<option value="50">50</option>
		<option value="100">100</option>

	</select>

	<button 
		type="button"
		
		onclick="load_audiometrias_sugerencias_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_audiometrias_sugerencias">


				
</div>

</div>
</div>

<div id="dilog_show" title="Editar audiometrias_sugerencias">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_edit_audiometrias_sugerencias">
				</div>

			</div>
		</div>
	</div>


</div>



