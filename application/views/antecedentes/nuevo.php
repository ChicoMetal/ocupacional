
<script type="text/javascript">
nombre="";
tipo="";
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

   	



	load_antecedentes_search();
	
	
	$("#form_antecedentes").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/antecedentes/guardar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
										title: 'antecedentes',
										text: 'La antecedente ha sido guardada correctamente!',
										
									});
									$("#form_antecedentes").each (function(){ this.reset()});
									load_antecedentes_search();
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al guardar la antecedente',
					});

                }

            });
        }
    });

	 


  });

	function load_antecedentes_search(){

		nombre 		=$("#nombre_search").val();
		tipo 		=$("#tipo_search").val();
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
	
		$("#load_antecedentes").children().remove();
			dataString="&nombre="+nombre
						+"&tipo="+tipo
						+"&estado="+estado
						+"&cantidad_res="+cantidad;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/antecedentes/mostrar_ajax",
            data: dataString,
            success: function(data){
        		$("#load_antecedentes").append(data);
            },
            error: function(data){
            	$("#load_antecedentes").html(data);
            }

        });


	}



</script>



<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered green">
			<div class="box-title">
				<h3><i class="icon-list"></i> Administracion de antecedentes</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_antecedentes"
					name="form_antecedentes"
					>

					<div class="span6">
						
						
						<div class="control-group">
							<label for="textfield" class="control-label">Nombre</label>
							<div class="controls">
								<input 
									type="text" 
									name="nombre" 
									id="nombre" 
									placeholder="Nombre del antecedente" 
									class="input-xxlarge"
									value="<?php echo set_value('nombre') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>



						<div class="control-group">
							<label for="textfield" class="control-label">
								Tipo
							</label>
							<div class="controls">
								<select
									name="tipo" 
									id="tipo" 
									
									class="input-xlarge"
									value="<?php echo set_value('descripcion') ?>"
									data-rule-required="true"
									data-rule-maxlength="40"
									>
									<option  value="">Elija el tipo</option>
									<option  value="familiares"> Familiares </option>
									<option  value="personales"> Personales </option>
									<option  value="gineco obstétricos"> Gineco obstétricos </option>
								</select>

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
					Antecedentes
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

	Tipo
	<select
		name="tipo_search" 
		id="tipo_search"
		class="input-medium"
		>
		<option  value=""> Todos </option>
		<option  value="personales" selected> Personales </option>
		<option  value="familiares"> Familiares </option>
		<option  value="gineco obstétricos"> Gineco obstétricos </option>
		
		
	</select>
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
		
		onclick="load_antecedentes_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_antecedentes">


				
</div>

</div>
</div>

<div id="dilog_show" title="Editar Antecedentes">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_edit_antecedentes">
				</div>

			</div>
		</div>
	</div>


</div>



