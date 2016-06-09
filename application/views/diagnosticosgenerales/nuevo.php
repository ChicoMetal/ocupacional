
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

   	



	load_diagnosticosgenerales_search();
	
	
	$("#form_diagnosticosgenerales").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/diagnosticosgenerales/guardar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
					title: 'diagnosticosgenerales',
					text: 'La actividades_nomformulario ha sido guardada correctamente!',
					
				});
				$("#form_diagnosticosgenerales").each (function(){ this.reset()});
				load_diagnosticosgenerales_search();
									
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


$("#form_diagnosticosgenerales_detalle").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();

	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/diagnosticosgenerales/guardar_detalle",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
						title: 'diagnosticosgenerales',
						text: 'El actividades_nomformulario ha sido guardada correctamente!',
						
					});
					$("#nombre_detalle").val("");
					load_detalle($("#coddiagnosticosgeneralesadd").val());
									
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
            url:"<?php echo base_url() ?>index.php/diagnosticosgenerales/buscar_actividadesdelaempresa",
            data: dataString,
            dataType: 'json',
            success: function(data){
            	var select="<select name='codactdelaempresa'  id='codactdelaempresa' onchange='load_diagnosticosgenerales_search()' class='input-xxlarge'>"
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

	function load_diagnosticosgenerales_search(){

		nombre 		=$("#nombre_search").val();
		actividad 	=$("#codactdelaempresa").val();
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
		
		$("#load_diagnosticosgenerales").children().remove();
			dataString="&nombre="+nombre
						+"&estado="+estado
						+"&cantidad_res="+cantidad
						+"&actividad="+actividad;
			$.ajax({
				type: "POST",
				url:"<?php echo base_url() ?>index.php/diagnosticosgenerales/mostrar_ajax",
				data: dataString,
				success: function(data){
					$("#load_diagnosticosgenerales").append(data);
				},
				error: function(data){
					$("#load_diagnosticosgenerales").html(data);
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
				<h3><i class="icon-list"></i> Administracion de diagnosticosgenerales</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_diagnosticosgenerales"
					name="form_diagnosticosgenerales"
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
					diagnosticosgenerales
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
		
		onclick="load_diagnosticosgenerales_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_diagnosticosgenerales">


				
</div>

</div>
</div>

<div id="dilog_show" title="Editar diagnosticosgenerales">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_edit_diagnosticosgenerales">
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
									id="form_diagnosticosgenerales_detalle"
									name="form_diagnosticosgenerales_detalle"
									>
									<input type="hidden" name="coddiagnosticosgeneralesadd" id="coddiagnosticosgeneralesadd">
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