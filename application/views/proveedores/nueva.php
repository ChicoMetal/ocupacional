
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


	function exitsproveedor(){
		return false;
		var existe=false;
		var dataString="nit="+$("#nit").val();
		
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/proveedores/existe_proveedor_ajax",
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
						text: 'Ocurrio un error al buscar el proveedor',
					});

                }

            });
	          return existe;

	}


	$("#dilog_show").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 460,
            width: 800,
             resizable: false 
    });

   	



	load_proveedores_search();
	
	
	$("#form_proveedores").validate({
		submitHandler: function(form){
			if($("#action").val()=="i"){
				if(!exitsproveedor()){
					var dataString = $(form).serialize();
			          $.ajax({
		            	type: "POST",
		                url:"<?php echo base_url() ?>index.php/proveedores/guardar",
		                data: dataString,
		                success: function(data){
		                
			                $.gritter.add({
								title: 'proveedores',
								text: 'el proveedor ha sido guardada correctamente!',
								
							});
							$("#form_proveedores").each (function(){ this.reset()});
							load_proveedores_search();
											
		                },
		                error: function(data){

		                	$.gritter.add({
								title: 'Error',
								text: 'Ocurrio un error al guardar el proveedor',
							});

		                }

		            });
			    }else{
			    	$.gritter.add({
						title: 'Error',
						text: 'Ya existe una proveedor con este nit, no se puede guardar',
					});

			    }
		    }else if($("#action").val()=="u"){
		    	if(!existe_proveedor_actualizar()){
					var dataString = $(form).serialize();
			          $.ajax({
		            	type: "POST",
		                url:"<?php echo base_url() ?>index.php/proveedores/actualizar",
		                data: dataString,
		                success: function(data){
		                
			                $.gritter.add({
								title: 'proveedores',
								text: 'el proveedor ha sido actualizada correctamente!',
								
							});
							$("#form_proveedores").each (function(){ this.reset()});
							load_proveedores_search();
							
		                },
		                error: function(data){

		                	$.gritter.add({
								title: 'Error',
								text: 'Ocurrio un error al guardar el proveedor',
							});

		                }

		            });	
			    }else{

	            	$.gritter.add({
						title: 'Error',
						text: 'Existe una proveedor con el mismo nit',
					});	
				}      
		   	}
        }
    });

	 


  });



	function existe_proveedor_actualizar(){
		return false;
		var exite=false;
		var dataString="nit="+$("#nit").val()
					+"&codigo="+$("#codigo").val();
		
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/proveedores/existe_proveedor_actualizar",
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
	
	function load_proveedores_search(){

		nombre 			=$("#nombre_search").val();
		ciudad_search 	=$("#ciudad_search").val();
		estado 			=$("#estado_search").val();
		cantidad 		=$("#cantidad_res").val();
	
		$("#load_proveedores").children().remove();
			dataString="&nombre="+nombre
						+"&ciudad_search="+ciudad_search
						+"&estado="+estado
						+"&cantidad_res="+cantidad;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/proveedores/mostrar_ajax",
            data: dataString,
            success: function(data){
        		$("#load_proveedores").append(data);
            },
            error: function(data){
            	$("#load_proveedores").html(data);
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
                url:"<?php echo base_url() ?>index.php/proveedores/buscar_proveedor_edit",
                data: dataString,
                dataType: 'json',
                success: function(data){
                	
     				$.each(data, function(index){
       					//var paciente = data[index][0];
       					$("#codigo").val(data[index].codigo);
       					
       					$("#nombre").val(data[index].nombre);
       					$("#direccion").val(data[index].direccion);
       					$("#telefono").val(data[index].telefono);
       					$("#celular").val(data[index].celular);
       					$("#contacto").val(data[index].contacto);

						$("#action").val("u");


						
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
				<h3><i class="icon-list"></i> Administracion de proveedores</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_proveedores"
					name="form_proveedores"
					>
					<input type="hidden" name="codigo" id="codigo" value="">

					<div class="span6">
						
						
						<div class="control-group">
							<label for="textfield" class="control-label">Nombre social</label>
							<div class="controls">
								<input 
									type="text" 
									name="nombre" 
									id="nombre" 
									placeholder="Nombre social del proveedor" 
									class="input-xlarge"
									value="<?php echo set_value('nombre') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>


						<div class="control-group">
							<label for="textfield" class="control-label">
								Dirrección
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
								Celular
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="celular" 
									id="celular" 
									placeholder="Celular" 
									class="input-xlarge"
									value="<?php echo set_value('celular') ?>"
									
									data-rule-maxlength="40"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Contacto
							</label>
							<div class="controls">
								
								<input 
									type="text" 
									name="contacto" 
									id="contacto" 
									placeholder="Nombres del contacto" 
									class="input-xlarge"
									value="<?php echo set_value('contacto') ?>"
									
									data-rule-maxlength="40"
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
					proveedores
				</h3>

			</div>
			<br>
	<div class="control-group">
	nombre
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
		
		onclick="load_proveedores_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>





<div id="load_proveedores">
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
				
				<div id="load_edit_proveedores">
				</div>

			</div>
		</div>
	</div>


</div>
