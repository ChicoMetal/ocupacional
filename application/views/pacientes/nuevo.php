


<script type="text/javascript">
$(document).ready(function(){
	$("#exite_orden").hide();
	var fecha = new Date();
	var anio = fecha.getFullYear();

	$( "#fechanac" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "1900:"+anio,
		dateFormat: "yy/mm/dd",
	});

	$( "#fechaingreso" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "2000:2020",
       dateFormat: "yy/mm/dd"
    });

    $("#limpiar").click(function(){
    	resetCampos();
    });

    $("#ordendeatencion").hide();

    $("#ordendeatencion").click(function(){

    });


    $("#file_uploadf").change(function(){
    	identificacion=$("#identificacion").val();
    	if(identificacion!=""){
	    	var archivos = document.getElementById("file_uploadf");//Damos el valor del input tipo file
	  		var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
			
			var data = new FormData();
			
			for(i=0; i<archivo.length; i++){
			    data.append('archivo'+i,archivo[i]);

			}

			
			 $.ajax({
	            url:"<?php echo base_url() ?>index.php/pacientes/subirimg/"+identificacion+"/firmas",
	            type:'POST',
	            contentType:false,
	            data:data,
	            processData:false,  
	            cache:false,
	            success: function(data){
	            	if(data==1){
	            		$.gritter.add({
							title: 'Error',
							text: 'El archivo exede el limite de 500k',
						});	
	            	}else if(data==2){
	            		$.gritter.add({
							title: 'Error',
							text: 'La extension del archivo no es correcta',
						});
	            		
	            	}else{
	            		cambiarimagenf(data);
	            	}
					
	            },
	            error: function (){

	            }
	        });
		}else{
			$.gritter.add({
				title: 'Error',
				text: 'Debe escribir primero la identificacion del paciente',
			});

		}				

    });

    $("#file_upload").change(function(){
    	identificacion=$("#identificacion").val();
    	if(identificacion!=""){
	    	var archivos = document.getElementById("file_upload");//Damos el valor del input tipo file
	  		var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
			
			var data = new FormData();
			
			for(i=0; i<archivo.length; i++){
			    data.append('archivo'+i,archivo[i]);

			}

			
			 $.ajax({
	            url:"<?php echo base_url() ?>index.php/pacientes/subirimg/"+identificacion+"/pacientes",
	            type:'POST',
	            contentType:false,
	            data:data,
	            processData:false,  
	            cache:false,
	            success: function(data){
	            	if(data==1){
	            		$.gritter.add({
							title: 'Error',
							text: 'El archivo exede el limite de 500k',
						});	
	            	}else if(data==2){
	            		$.gritter.add({
							title: 'Error',
							text: 'La extension del archivo no es correcta',
						});
	            		
	            	}else{
	            		cambiarimagen(data);
	            	}
					
	            },
	            error: function (){

	            }
	        });
		}else{
			$.gritter.add({
				title: 'Error',
				text: 'Debe escribir primero la identificacion del paciente',
			});

		}				

    });

	function cambiarimagen(ext){
		id=$("#identificacion").val();
		$("#foto").attr("src","<?php echo base_url() ?>fotos/pacientes/blanck.jpg");
		//alert("cambiando");
		$("#foto").attr("src","<?php echo base_url() ?>fotos/pacientes/"+id+"."+ext+"?ajax="+aleatorio());
		$("#fotop").val(id+"."+ext);
	}

	function cambiarimagenf(ext){
		id=$("#identificacion").val();
		$("#firma").attr("src","<?php echo base_url() ?>fotos/firmas/blanck.jpg");
		//alert("cambiando");
		$("#firma").attr("src","<?php echo base_url() ?>fotos/firmas/"+id+"."+ext+"?ajax="+aleatorio());
		$("#firmap").val(id+"."+ext);
		
	}

	function aleatorio(){
	    var text = "";
	    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	    for( var i=0; i < 20; i++ )
	        text += possible.charAt(Math.floor(Math.random() * possible.length));

	    return text;
	}

    function resetCampos(){
    	$("#actualizar").attr("disabled","");
		$("#guardar").removeAttr("disabled","");
		$("#fechaingreso").removeAttr("disabled");
		/*	el valor de actione s saber que accion se va a 
			realizar si es una insercion "i" o es un actualizacion "u"
			se hace para utilizar la misma accion de validacion del formulario
		*/
		$("#foto").attr("src","<?php echo base_url() ?>fotos/pacientes/blanck.jpg");
		$("#firma").attr("src","<?php echo base_url() ?>fotos/firmas/blanck.jpg");
		
		$("#action").val("i");
		$("#ordendeatencion").hide();
		$("#exite_orden").hide();
    }

	 $("#searh_txt").click(function(){
	 	$("#exite_orden").hide();
	 	dataString="identificacion="+$("#identificacion").val();
	 	$.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/pacientes/buscar_paciente",
                data: dataString,
                dataType: 'json',
                success: function(data){
     				$.each(data, function(index){
       					//var paciente = data[index][0];
       					$("#codigo").val(data[index].codigo);
       					$("#identificacion").val(data[index].identificacion);
       					$("#nombres").val(data[index].nombres);
       					$("#apellidos").val(data[index].apellidos);
       					$("#sexo").val(data[index].sexo);
       					$("#fechanac").val(data[index].fechanacimiento);
       					$("#direccion").val(data[index].direccion);
       					$("#telefono").val(data[index].telefono);
       					$("#celular").val(data[index].celular);
       					$("#estadocivil").val(data[index].estadocivil);
       					$("#numhijos").val(data[index].numhijos);
       					$("#escolaridad").val(data[index].escolaridad);
       					$("#escolaridad_completa").val(data[index].escolaridad_completa);
       					$("#eps").val(data[index].eps);
       					$("#afp").val(data[index].afp);
       					$("#arp").val(data[index].arp);
       					$("#observaciones").val(data[index].observaciones);
       					$("#email").val(data[index].email);
       					$("#foto").attr("src","<?php echo base_url() ?>fotos/pacientes/"+data[index].foto);
       					$("#firma").attr("src","<?php echo base_url() ?>fotos/firmas/"+data[index].firma);
       					$("#firmap").val(data[index].firma);
						$("#fotop").val(data[index].foto);
       					$("#estado").val(data[index].estado);

       					$("#fechaingreso").val(data[index].fechaingreso);
						$("#action").val("u");


						$("#fechaingreso").attr("disabled","");
       					$("#guardar").attr("disabled","");
       					$("#actualizar").removeAttr("disabled");
       					$("#ordendeatencion").show();

       					$("#or_cod").val(data[index].codigo);
       					$("#or_id").val(data[index].identificacion);
       					$("#or_nom").val(data[index].nombres+" "+data[index].apellidos);
       					
       					if(data[index].ord_pen){
       						$("#exite_orden").effect("slide",500);
       					}

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


	 });

	
	function existe_paciente_actualizar(){
		var exite=false;
		var dataString="identificacion="+$("#identificacion").val()
					+"&codigo="+$("#codigo").val();
		
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/pacientes/existe_paciente_actualizar",
                data: dataString,
                async: false,
                success: function(data){

					if(data=="si"){
						
						exite=true;
						
					}else if(data=="no"){
						$("#identificacion").removeClass("error");

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
	
	function existe_paciente(){
		var exite=false;
		var dataString="identificacion="+$("#identificacion").val();
		
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/pacientes/existe_paciente_ajax",
                data: dataString,
                async: false,
                success: function(data){

					if(data=="si"){
						
						exite=true;
						
					}else if(data=="no"){
						$("#identificacion").removeClass("error");

					}
              
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al buscar el paciente',
					});

                }

            });
	         
	         return exite;
	}

	$("#identificacion").on("blur",function(){
			
			
			
	});


	$("#form_pacientes").validate({

		submitHandler: function(form){
			
			if($("#action").val()=="i"){
				
				if(!existe_paciente()){
					var dataString = $(form).serialize();
			          $.ajax({
		            	type: "POST",
		                url:"<?php echo base_url() ?>index.php/pacientes/guardar",
		                data: dataString,
		                success: function(data){
		                
			                $.gritter.add({
								title: 'Pacientes',
								text: 'El paciente ha sido guardado correctamente!',
								
							});
							$("#form_ampresas").each (function(){ this.reset()});
											
		                },
		                error: function(data){

		                	$.gritter.add({
								title: 'Error',
								text: 'Ocurrio un error al guardar el paciente',
							});

		                }

		            });

				}else{

	            	$.gritter.add({
						title: 'Error',
						text: 'Existe un paciente con la misma identificación',
					});	
				}

			}else if($("#action").val()=="u"){
					
				if(!existe_paciente_actualizar()){
					var dataString = $(form).serialize();
			          $.ajax({
		            	type: "POST",
		                url:"<?php echo base_url() ?>index.php/pacientes/actualizar",
		                data: dataString,
		                success: function(data){
		                
			                $.gritter.add({
								title: 'Pacientes',
								text: 'El paciente ha sido guardado correctamente!',
								
							});
							$("#form_ampresas").each (function(){ this.reset()});
											
		                },
		                error: function(data){

		                	$.gritter.add({
								title: 'Error',
								text: 'Ocurrio un error al guardar el paciente',
							});

		                }

		            });

				}else{

	            	$.gritter.add({
						title: 'Error',
						text: 'Existe un paciente con la misma identificación',
					});	
				}
					
			}



        }
    });



  });

</script>



<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered teal">
			<div class="box-title">
				<h3><i class="icon-list"></i> Administracion de pacientes</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_pacientes"
					name="form_pacientes"
					>
					<input type="hidden" name="codigo" id="codigo" value="">
					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">Identificación</label>
							<div class="controls">
								<input 
									type="text" 
									name="identificacion" 
									id="identificacion" 
									placeholder="Identificación" 
									class="input-medium"
									value="<?php echo set_value('identificacion') ?>"
									data-rule-required="true"
									data-rule-maxlength="13"
									>
									<button 
										type="button"
										id="searh_txt"
										class="btn btn-info icon-search"

									>
										Buscar
									</button>

									<div id="exite_orden" class="alert alert-warning">
										Tiene Orden pendiente
									</div>
							</div>
						</div>
						
						<div class="control-group">
							<label for="textfield" class="control-label">Nombres</label>
							<div class="controls">
								<input 
									type="text" 
									name="nombres" 
									id="nombres" 
									placeholder="Nombres completos" 
									class="input-xlarge"
									value="<?php echo set_value('nombres') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">Apellidos</label>
							<div class="controls">
								<input 
									type="text" 
									name="apellidos" 
									id="apellidos" 
									placeholder="Apellidos completos" 
									class="input-xlarge"
									value="<?php echo set_value('apellidos') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Sexo
							</label>
							<div class="controls">
								<select 
									id="sexo" 
									name="sexo" 
									class="input-xlarge"
									value="<?php echo set_value('sexo') ?>"
									data-rule-required="true"
									data-rule-maxlength="10"
								>
									<option value="">Seleccione un sexo</option>
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>

								</select>
								
							</div>
						</div>



						<div class="control-group">
							<label for="textfield" class="control-label">
								Fecha de nacimiento
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="fechanac" 
									id="fechanac" 
									placeholder="yyyy/mm/dd" 
									class="input-xlarge"
									value="<?php echo set_value('fechanac') ?>"
									data-rule-required="true"
									data-rule-date="true"
									data-rule-format="yyyy/mm/dd"
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
									placeholder="Ciudad" 
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
								Foto
							</label>
							<div class="controls">

								<div class="span2">
									<div class="span12" width="150">
										<img 
											src="<?php echo base_url() ?>fotos/pacientes/blanck.jpg" 
											id="foto" 
											width="200">
									</div>

									<input 
										type="file" 
										name="file_upload"
										id="file_upload"
										class="btn btn-teal glyphicon-upload"
										value="Elegir foto"	  
									/>
										  
									

								</div>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">
								Estado Civil
							</label>
							<div class="controls">
								<select 
									id="estadocivil" 
									class="input-xlarge"
									value="<?php echo set_value('estadocivil') ?>"
									name="estadocivil"
									
									data-rule-maxlength="10"
								>
									<option value="">Seleccione un estado civil</option>
									<option value="Soltero">Soltero</option>
									<option value="Casado">Casado</option>
									<option value="Union libre">Union libre</option>
									<option value="Separado">Separado</option>
									<option value="Viudo">Viudo</option>
									

								</select>
							</div>
						</div>

					

						<div class="control-group">
							<label for="textfield" class="control-label">
								No de Hijos
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="numhijos" 
									id="numhijos" 
									placeholder="Número de hijos" 
									class="input-xlarge"
									value="<?php echo set_value('numhijos') ?>"
									
									data-rule-maxlength="2"
									data-rule-number="true"
									>
							</div>
						</div>

					

						<div class="control-group">
							<label for="textfield" class="control-label">
								Escolaridad
							</label>
							<div class="controls">
								<select 
									id="escolaridad" 
									name="escolaridad"
									class="input-xlarge"
									value="<?php echo set_value('escolaridad') ?>"
									
									data-rule-maxlength="10"
								>
									<option value="">Seleccione Escolaridad</option>
									<option value="Primaria">Primaria</option>
									<option value="Secundaria">Secundaria</option>
									<option value="Técnico">Técnico</option>
									<option value="Técnologo">Técnologo</option>
									<option value="Universitario">Universitario</option>
									<option value="Postgrado">Postgrado</option>
									<option value="Analfabeta">Analfabeta</option>

								</select>
							</div>
						</div>



						<div class="control-group">
							<label for="textfield" class="control-label">
								Escolaridad Completa
							</label>
							<div class="controls">
								<select 
									id="escolaridad_completa" 
									name="escolaridad_completa"
									class="input-xlarge"
									value="<?php echo set_value('escolaridad_completa') ?>"
									
									data-rule-maxlength="10"
								>
									<option value="">¿Escolaridad completa?</option>
									<option value="si">si</option>
									<option value="no">no</option>
									

								</select>
							</div>
						</div>


						<div class="control-group">
							<label for="textfield" class="control-label">
								EPS
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="eps" 
									id="eps" 
									placeholder="EPS" 
									class="input-xlarge"
									value="<?php echo set_value('eps') ?>"
									
									data-rule-maxlength="100"
									
									>
							</div>
						</div>


						<div class="control-group">
							<label for="textfield" class="control-label">
								AFP
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="afp" 
									id="afp" 
									placeholder="AFP" 
									class="input-xlarge"
									value="<?php echo set_value('afp') ?>"
									
									data-rule-maxlength="100"
									
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								ARP
							</label>
							<div class="controls">
								<input 
									type="text" 
									name="arp" 
									id="arp" 
									placeholder="ARP" 
									class="input-xlarge"
									value="<?php echo set_value('arp') ?>"
									
									data-rule-maxlength="100"
									
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
									class="input-xlarge  icon-e-mail"
									value="<?php echo set_value('email') ?>"
									
									data-rule-email="true"
									>
							</div>
						</div>

						<div class="control-group">
							<label for="textfield" class="control-label">
								Fecha ingreso 
							</label>
		
							<div class="controls">
								
								<input 
									type="date" 
									name="fechaingreso" 
									id="fechaingreso" 
									placeholder="Fecha" 
									class="input-medium"
									value="<?php echo set_value('fechaingreso') ?>"
									
									
									>
							</div>
						</div>
					
						<div class="control-group">
							<label for="textfield" class="control-label">
								Firma
							</label>
							<div class="controls">
								<input type="hidden" name="fotop"  id="fotop" value="blanck.jpg">
								<div class="span2">
									<div class="span12" width="150">
										<img 
											src="<?php echo base_url() ?>fotos/firmas/blanck.jpg" 
											id="firma" 
											height="200">
									</div>
									<input type="hidden" name="firmap" id="firmap" value="blanck.jpg">
									<input 
										type="file" 
										name="file_uploadf"
										id="file_uploadf"
										class="btn btn-teal glyphicon-upload"
										value="Elegir foto"	  
									/>
										  
									

								</div>
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
				<form 
					action="<?php echo base_url() ?>index.php/pacientes/orden" 
					method="post" 
					>
					<input 
						type="hidden" 
						name="or_nom" 
						id="or_nom" 
						value="">

					<input 
						type="hidden" 
						name="or_cod" 
						id="or_cod" 
						value="">
					<input 
						type="hidden" 
						name="or_id" 
						id="or_id" 
						value="">

					<button 
						type="submit"
						id="ordendeatencion"
						class="btn btn-magenta  icon-share-alt"
						
						>
						Realizar orden
					</button>
				</form>
			</div>
		</div>
	</div>
</div>



										
				
</div>





