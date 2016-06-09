
<script type="text/javascript">
nombre="";

estado="";
cantidad=30;
$(document).ready(function(){
	//$("#hijo").hide();
	buscaractividadesdelaempresa();
	
	$("#dilog_edit_detalle").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 460,
            width: 800,
             resizable: false 
    });
	
	$("#dilog_new_detalle").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 460,
            width: 800,
             resizable: false 
    });
	

	$("#dilog_show").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 460,
            width: 800,
             resizable: false 
    });

   	



	load_actividades_nomformularios_search();
	
	
	$("#form_actividades_nomformularios").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/actividades_nomformularios/guardar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
										title: 'actividades_nomformularios',
										text: 'La actividades_nomformulario ha sido guardada correctamente!',
										
									});
									$("#form_actividades_nomformularios").each (function(){ this.reset()});
									load_actividades_nomformularios_search();
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al guardar la actividades_nomformulario',
					});

                }

            });
        }
    });


$("#form_actividades_nomformularios_detalle").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();

	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/actividades_nomformularios/guardar_detalle",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
						title: 'actividades_nomformularios',
						text: 'El actividades_nomformulario ha sido guardada correctamente!',
						
					});
					$("#nombre_detalle").val("");
					load_detalle($("#codactividades_nomformulariosadd").val());
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al guardar la actividades_nomformulario',
					});

                }

            });
        }
    });

	
	 


  });



function buscaractividadesdelaempresa(){
	dataString="";
	$.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/actividades_nomformularios/buscar_actividadesdelaempresa",
            data: dataString,
            dataType: 'json',
            success: function(data){
            	var select="<select name='codactdelaempresa'  id='codactdelaempresa' onchange='load_actividades_nomformularios_search()' class='input-xxlarge'>"
				select+="<option value=''>Elija un examen </option>";
				$.each(data, function(index){
					select+="<option value='"+data[index].codigo+"'>";
					select+=data[index].nombre;
					select+="</option>";

				});

				select+="</select>";
				$("#load_examenes").html(select);

            },
            error: function(data){
            	
            }

        });




}

	function load_actividades_nomformularios_search(){

		nombre 		=$("#nombre_search").val();
		actividad 	=$("#codactdelaempresa").val();
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
		
		$("#load_actividades_nomformularios").children().remove();
			dataString="&nombre="+nombre
						+"&estado="+estado
						+"&cantidad_res="+cantidad
						+"&actividad="+actividad;
			$.ajax({
				type: "POST",
				url:"<?php echo base_url() ?>index.php/actividades_nomformularios/mostrar_ajax",
				data: dataString,
				success: function(data){
					$("#load_actividades_nomformularios").append(data);
				},
				error: function(data){
					$("#load_actividades_nomformularios").html(data);
				}

			});


	}



</script>


<div class="container" >
 <div id="padre">


<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered yellow_smal">
			<div class="box-title">
				<h3><i class="icon-list"></i> Administracion de actividades_nomformularios</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_actividades_nomformularios"
					name="form_actividades_nomformularios"
					>
					<div class="span12">
						<div class="control-group">
							<label for="textfield" class="control-label">Examen</label>
							<div class="controls">
								<div id="load_examenes">
								</div>	


							</div>
						</div>


					</div>
					<div class="span6">
						
						
						<div class="control-group">
							<label for="textfield" class="control-label">Título</label>
							<div class="controls">
								<input 
									type="text" 
									name="nombre" 
									id="nombre" 
									placeholder="Titulo" 
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
					actividades_nomformularios
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
		<option value="10">30</option>
		<option value="20">50</option>
		<option value="30">100</option>

	</select>

	<button 
		type="button"
		
		onclick="load_actividades_nomformularios_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_actividades_nomformularios">


				
</div>

</div>
</div>

<div id="dilog_show" title="Editar actividades_nomformularios">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_edit_actividades_nomformularios">
				</div>

			</div>
		</div>
	</div>


</div>






<div id="dilog_new_detalle" title="Nuedo detalle">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Nuevo detalle</h3>
							</div>
							<div class="box-content nopadding">
								<form 
									method="POST" 
									class='form-horizontal form-column form-bordered'
									id="form_actividades_nomformularios_detalle"
									name="form_actividades_nomformularios_detalle"
									>
									<input type="hidden" name="codactividades_nomformulariosadd" id="codactividades_nomformulariosadd">
									<div class="span6">
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Nombre</label>
											<div class="controls">
												<input 
													type="text" 
													name="nombre_detalle" 
													id="nombre_detalle" 
													placeholder="Nombre del actividades_nomformulario" 
													class="input-xlarge"
													data-rule-required="true"
													data-rule-maxlength="500"
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
			
			</div>
		</div>
	</div>


</div>



<div id="dilog_edit_detalle" title="Editar detalle">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Editar detalle</h3>
							</div>
							<div class="box-content nopadding">
								<div id="load_edit_detalle">

								</div>
									
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</div>
	</div>


</div>

</div>

<div id="hijo">



</div>
</div>


<input type="hidden" id="cod_padre" value="">