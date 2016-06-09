
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

   	



	load_tipo_examenes_search();
	
	
	$("#form_tipo_examenes").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/tipo_examenes/guardar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
										title: 'tipo_examenes',
										text: 'La tipo_examene ha sido guardado correctamente!',
										
									});
									$("#form_tipo_examenes").each (function(){ this.reset()});
									load_tipo_examenes_search();
									
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

	function load_tipo_examenes_search(){

		nombre 		=$("#nombre_search").val();
		
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
	
		$("#load_tipo_examenes").children().remove();
			dataString="&nombre="+nombre
						
						+"&estado="+estado
						+"&cantidad_res="+cantidad;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/tipo_examenes/mostrar_ajax",
            data: dataString,
            success: function(data){
        		$("#load_tipo_examenes").append(data);
            },
            error: function(data){
            	$("#load_tipo_examenes").html(data);
            }

        });


	}



</script>



<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered green">
			<div class="box-title">
				<h3><i class="icon-list"></i> Administracion de tipo_examenes</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_tipo_examenes"
					name="form_tipo_examenes"
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
									class="input-xlarge"
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
					tipo_examenes
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
		
		onclick="load_tipo_examenes_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_tipo_examenes">


				
</div>

</div>
</div>

<div id="dilog_show" title="Editar tipo_examenes">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_edit_tipo_examenes">
				</div>

			</div>
		</div>
	</div>


</div>



