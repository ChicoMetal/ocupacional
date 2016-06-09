
<script type="text/javascript">

nombre="";
ciudad_search="";
estado="";
cantidad=30;
$(document).ready(function(){
	 $( "#fecha" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1900:2013",
       dateFormat: "yy/mm/dd",
    });


	function exitsempresa(){
		var existe=false;
		var nittemp=$("#nit").val();
		if(nittemp!=""){
		var dataString="nit="+$("#nit").val();
		
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/empresas/existe_empresa_ajax",
                data: dataString,
                async: false,
                success: function(data){
                		if(data=="si"){
                			$("#nit").addClass("error");
                			existe=true;

                		}else if(data=="no"){
                			$("#nit").removeClass("error");

                		}
              
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al buascar la empresa',
					});

                }

            });
	       }
	          return existe;

	}


	$("#dilog_show").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 460,
            width: 800,
             resizable: false 
    });

   	



	load_empresas_search();
	
	
	$("#form_empresas").validate({
		submitHandler: function(form){
			if($("#action").val()=="i"){
				if(!exitsempresa()){
					var dataString = $(form).serialize();
			          $.ajax({
		            	type: "POST",
		                url:"<?php echo base_url() ?>index.php/empresas/guardar",
		                data: dataString,
		                success: function(data){
		                
			                $.gritter.add({
								title: 'empresas',
								text: 'La empresa ha sido guardada correctamente!',
								
							});
							$("#form_empresas").each (function(){ this.reset()});
							load_empresas_search();
											
		                },
		                error: function(data){

		                	$.gritter.add({
								title: 'Error',
								text: 'Ocurrio un error al guardar la empresa',
							});

		                }

		            });
			    }else{
			    	$.gritter.add({
						title: 'Error',
						text: 'Ya existe una empresa con este nit, no se puede guardar',
					});

			    }
		    }else if($("#action").val()=="u"){
		    	if(!existe_empresa_actualizar()){
					var dataString = $(form).serialize();
			          $.ajax({
		            	type: "POST",
		                url:"<?php echo base_url() ?>index.php/empresas/actualizar",
		                data: dataString,
		                success: function(data){
		                
			                $.gritter.add({
								title: 'empresas',
								text: 'La empresa ha sido actualizada correctamente!',
								
							});
							$("#form_empresas").each (function(){ this.reset()});
							load_empresas_search();
							
		                },
		                error: function(data){

		                	$.gritter.add({
								title: 'Error',
								text: 'Ocurrio un error al guardar la empresa',
							});

		                }

		            });	
			    }else{

	            	$.gritter.add({
						title: 'Error',
						text: 'Existe una empresa con el mismo nit',
					});	
				}      
		   	}
        }
    });

	 


  });



	function existe_empresa_actualizar(){
		var exite=false;
		var dataString="nit="+$("#nit").val()
					+"&codigo="+$("#codigo").val();
		
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/empresas/existe_empresa_actualizar",
                data: dataString,
                async: false,
                success: function(data){

					if(data=="si"){
						
						exite=true;
						
					}else if(data=="no"){
						$("#nit").removeClass("error");

					}
              
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error en la actualizacion',
					});

                }

            });
	         
	         return exite;
	}
	
	function load_empresas_search(){

		nombre 			=$("#nombre_search").val();
		ciudad_search 	=$("#ciudad_search").val();
		estado 			=$("#estado_search").val();
		cantidad 		=$("#cantidad_res").val();
	
		$("#load_empresas").children().remove();
			dataString="&nombre="+nombre
						+"&ciudad_search="+ciudad_search
						+"&estado="+estado
						+"&cantidad_res="+cantidad;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/empresas/mostrar_ajax",
            data: dataString,
            success: function(data){
        		$("#load_empresas").append(data);
            },
            error: function(data){
            	$("#load_empresas").html(data);
            }

        });


	}

  function resetCampos(){
    	$("#actualizar").attr("disabled","");
		$("#guardar").removeAttr("disabled","");
		$("#fecha").removeAttr("disabled");
		/*	el valor de actione s saber que accion se va a 
			realizar si es una insercion "i" o es un actualizacion "u"
			se hace para utilizar la misma accion de validacion del formulario
		*/

		$("#action").val("i");

    }

function editar(codigo){

	 	dataString="codigo="+codigo;
	 	$.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/empresas/buscar_empresa_edit",
                data: dataString,
                dataType: 'json',
                success: function(data){
                	
     				$.each(data, function(index){
       					//var paciente = data[index][0];
       					$("#codigo").val(data[index].codigo);
       					$("#nit").val(data[index].nit);
       					$("#razon").val(data[index].razonsocial);
       					$("#direccion").val(data[index].direccion);
       					$("#telefono").val(data[index].telefono);
       					$("#ciudad").val(data[index].ciudad);
       					$("#departamento").val(data[index].departamento);
       					$("#email").val(data[index].email);
       					$("#contactof").val(data[index].contactofinanciero);
       					$("#fecha").val(data[index].fechacreacion);

       					$("#contactofc").val(data[index].celularfinanciero);
       					$("#contactofe").val(data[index].emailfinanciero);
       					$("#solicitante").val(data[index].solicitante);
       					$("#solicitantec").val(data[index].celularsolicitante);
       					$("#solicitantee").val(data[index].emailsolicitante);
       					$("#objetosocial").val(data[index].objetosocial);
       					

						$("#action").val("u");


						$("#fecha").attr("disabled","");
       					$("#guardar").attr("disabled","");
       					$("#actualizar").removeAttr("disabled");


       					

       				});

               			
              
                },
                error: function(data){
                	var id=$("#identificacion").val();
                	$("form")[0].reset();
                	resetCampos();
                	$("#identificacion").val(id);

                	$.gritter.add({
						title: 'Paciente',
						text: 'El paciente no existe',
					});

                }

            });


}








</script>



<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered green">
			<div class="box-title">
				<h3><i class="icon-list"></i> Administracion de empresas</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_empresas"
					name="form_empresas"
					>
					<input type="hidden" name="codigo" id="codigo" value="">

					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">NIT</label>
							<div class="controls">
								<input 
									type="text" 
									name="nit" 
									id="nit" 
									placeholder="Nit de la empresa" 
									class="input-medium"
									
									
									data-rule-maxlength="13"
									>
							</div>
						</div>
						
						<div class="control-group">
							<label for="textfield" class="control-label">Razon social</label>
							<div class="controls">
								<input 
									type="text" 
									name="razon" 
									id="razon" 
									placeholder="Razon social de la emrpesa" 
									class="input-xlarge"
									value="<?php echo set_value('razon') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>


						<div class="control-group">
							<label for="textfield" class="control-label">
								Domicilio principal
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="direccion" 
									id="direccion" 
									placeholder="Direccion" 
									class="input-xlarge"
									value="<?php echo set_value('direccion') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Telefonos
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="telefono" 
									id="telefono" 
									placeholder="Telefonos" 
									class="input-xlarge"
									value="<?php echo set_value('telefono') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>


						<div class="control-group">
							<label for="textfield" class="control-label">
								Ciudad
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="ciudad" 
									id="ciudad" 
									placeholder="Ciudad" 
									class="input-xlarge"
									value="<?php echo set_value('ciudad') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>


						<div class="control-group">
							<label for="textfield" class="control-label">
								Departamento
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="departamento" 
									id="departamento" 
									placeholder="Departamento" 
									class="input-xlarge"
									value="<?php echo set_value('departamento') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								E-mail
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="email" 
									id="email" 
									placeholder="Email" 
									class="input-xlarge"
									value="<?php echo set_value('email') ?>"
									
									data-rule-email="true"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Fecha (YYYY/MM/DD)
							</label>
		
							<div class="controls">
								
								<input 
									type="date" 
									name="fecha" 
									id="fecha" 
									placeholder="Fecha" 
									class="input-medium"
									value="<?php echo set_value('fecha') ?>"
									data-rule-required="true"
									data-rule-date="true"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Obeto social
							</label>
		
							<div class="controls">
								
								<textarea 
									
									name="objetosocial" 
									id="objetosocial" 
									placeholder="Breve descripción del obeto social" 
									class="input-xlarge"
									value="<?php echo set_value('objetosocial') ?>"
									
									data-rule-maxlength="200"
									>

								</textarea>
							</div>
						</div>
		
					</div>
					<div class="span6">
								
						<div class="control-group">
							<label for="textfield" class="control-label">
								Contacto financiero
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="contactof" 
									id="contactof" 
									placeholder="Nombres del contacto financiero" 
									class="input-xlarge"
									value="<?php echo set_value('contactof') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Celular Contacto financiero
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="contactofc" 
									id="contactofc" 
									placeholder="Celular del contacto financiero" 
									class="input-xlarge"
									value="<?php echo set_value('contactofc') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Email Contacto financiero
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="contactofe" 
									id="contactofe" 
									placeholder="Email del contacto financiero" 
									class="input-xlarge"
									value="<?php echo set_value('contactofe') ?>"
									
									data-rule-maxlength="40"
									data-rule-email="true"
									>
							</div>
						</div>
		
						<div class="control-group">
							<label for="textfield" class="control-label">
								Solicitante del servicio
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="solicitante" 
									id="solicitante" 
									placeholder="Nombres del solicitante" 
									class="input-xlarge"
									value="<?php echo set_value('solicitante') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Celular Solicitante
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="solicitantec" 
									id="solicitantec" 
									placeholder="Celular del solicitante" 
									class="input-xlarge"
									value="<?php echo set_value('solicitantec') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Email solicitante
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="solicitantee" 
									id="solicitantee" 
									placeholder="Email del solicitante" 
									class="input-xlarge"
									value="<?php echo set_value('solicitante') ?>"
									
									data-rule-maxlength="40"
									data-rule-email="true"
									>
							</div>
						</div>

		
					</div>
					<div class="span12">
						<input type="hidden" name="action" id="action" value="i">


						<div class="form-actions">
							<button  
								type="submit" 
								class="btn btn-primary icon-save" 
								id="guardar"  
								>
								Guardar
							</button>
							<button 
								type="submit"
								id="actualizar"
								class="btn btn-satgreen  icon-refresh"
								disabled="" 
								>
								Actualizar
							</button>
							<button 
								type="reset"
								id="limpiar" 
								class="btn btn-lightgrey glyphicon-cleaning">
								Limpiar
							</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>


<div class="box box-color box-bordered lightred">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Empresas
				</h3>

			</div>
			<br>
	<div class="control-group">
	Razon social
	<input 
		type="text" 
		name="nombre_search" 
		id="nombre_search"
		class="input-small"

	>

	Nit
	<input 
		type="text" 
		name="ciudad_search" 
		id="ciudad_search"
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
		
		onclick="load_empresas_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>





<div id="load_empresas">
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
				
				<div id="load_edit_empresas">
				</div>

			</div>
		</div>
	</div>


</div>
