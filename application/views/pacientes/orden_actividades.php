<script type="text/javascript">
var contcontratos=0;
$(document).ready(function(){
	$("#dialog_busueda_pacientes").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 600,
            width: 1000,
            draggable: false
    });

	function mostrar_historia(codigo){
		dataString="codigo="+codigo;
		$.ajax({
			type: "POST",
			url:"<?php echo base_url() ?>index.php/ordenes/mostrar_ajax",
			data: dataString,
			success: function(data){
				
				$("#load_orden").append(data);
			},
			error: function(data){
				$("#load_orden").html(data);
			}

		});

	}

		$("#form_orden").validate({
			submitHandler: function(form){
				if(contcontratos>0){

					var codcontrato=$("#codcontrato").val();
					var codpaciente=$("#codpaciente").val();
					var soloexamenes=$("#soloexamenes").val();
					
					var dataString = $(form).serialize();
						dataString=dataString+"&codcontrato="+codcontrato;
						dataString=dataString+"&codpaciente="+codpaciente;
						dataString=dataString+"&soloexamenes="+soloexamenes;
						
			          $.ajax({
		            	type: "POST",
		                url:"<?php echo base_url() ?>index.php/ordenes/generar_orden",
		                data: dataString,
		                async:false,
		                success: function(data){
		              		if(data=="no"){

		              		}else{
		              			$("#load_contrato").children().remove();
		              			mostrar_historia(data);
		              		}
		                },
		                error: function(data){

		             
		                }

		            });							
		        }else{
		        	alert("Debe elegir la actividad que se viene a hacer");

		        }
			
        }
    });

	


$("#load_actividades_new").load("<?php echo base_url() ?>index.php/actividades/mostrar_elegir_validar");

	$( "#datepicker" ).datepicker({
      changeMonth: false,
      changeYear: true
    });
	$( "#datepicker" ).datepicker( "option", "dateFormat","yy" );

	$("#buscar").click(function(){
		 $( "#dilog_busueda").dialog("open");

	});
	$("#buscar_paciente").click(function(){
		 $( "#dialog_busueda_pacientes").dialog("open");

	});
	
	
	$("#dilog_show").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 600,
            width: 920,
            draggable: false
    });

	



   	 $("#dilog_actividades").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 600,
            width: 1000,
            draggable: false,
            buttons: {
                Guardar: function() {
                   $("#form_orden_nuevo").submit();
                },
                Cerrar: function() {
                    $( this ).dialog( "close" );
                }
            },
    });
	

   	function guardar_actividades(){


   	}

   	 $( "#dilog_busueda").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 600,
            width: 800,
            buttons: {
                
                Cerrar: function() {
                    $( this ).dialog( "close" );
                }
            },
    });
	
    $('#buscar_emp').click(function(){

        var busqueda =$("#campo_busqueda").val();
        do {
                busqueda =busqueda.replace(' ','%20');
        }while(busqueda.indexOf(' ') >= 0);

        $("#load_empresas").load("<?php echo base_url(); ?>index.php/empresas/buscar_empresa?nombre="+busqueda+"&cli=1");
    });




      $('#buscar_pac').click(function(){

        var busqueda = $("#campo_busqueda_pac").val();
        var criterio = $("#criterio").val();
        do {
                busqueda =busqueda.replace(' ','%20');
        }while(busqueda.indexOf(' ') >= 0);

        $("#load_pacientes").load("<?php echo base_url(); ?>index.php/pacientes/buscar_pacientes?valor="+busqueda+"&criterio="+criterio);

    });

     



		
	function load_empresas(desde,hasta,nombre){
			dataString="desde="+desde+"&hasta="+hasta+"&nombre="+nombre;
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

	$("#nit").on("blur",function(){
		
		var dataString="nit="+$("#nit").val();
		
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/empresas/existe_empresa_ajax",
                data: dataString,
                success: function(data){
                		if(data=="si"){
                			$("#nit").addClass("error");
                			alert("Ya existe una empresa con este nit");
                		}else if(data=="no"){
                			$("#nit").removeClass("error");

                		}
              
                },
                error: function(data){

                	$.gritter.add({
										title: 'Error',
										text: 'Ocurrio un error al guardar la empresa',
									});

                }

            });

	});




  });


function changetext(){
    var codempresa=$("#codempresa").val();
    $("#loadcontratos").load("<?php echo base_url() ?>index.php/actividades/show_contratos_empresa/"+codempresa);


}

function search_contratos(){
    var contrato=$("#contrato_select").val();

    $("#load_contrato").load("<?php echo base_url() ?>index.php/actividades/show_contratos_orden/"+contrato);

}



	
</script>




<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color green box-bordered">
			<div class="box-title">
				<h3><i class="icon-list"></i> 
					Orden de atención
				</h3>
			</div>

				
				
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_orden"
					name="form_orden"
					action="<?php echo base_url() ?>index.php/ordenes/generar_orden"
					>


					<div class="span12">
						<div class="span4">
							<label for="textfield" class="control-label">		Seleccione empresa
							</label>
							<input type="hidden" id="codempresa"  name="codempresa"  value="" placeholder="">

							<input 
										type="text" 
										name="empresa" 
										id="empresa" 
										placeholder="Empresa" 
										class="input-medium"
										
										data-rule-required="true"
										data-rule-maxlength="13"
										>

						
							<button id="buscar" type="button" class="btn" >
								<i class="glyphicon-search"></i>Buscar
							</button>
						</div>
						<div class="span8">
							<label for="razon" class="control-label" >
								Razon social:
							</label>
								<input 
								class="input-xlarge"
								type="text" 
								id="razonsocial" 
								name="razonsocial" 
								readonly="readonly"
								value="" >
						</div>

					</div>	
					<div class="span12">


                            <div id="loadcontratos">

                            </div>





                    </div>

					<div class="span12">
						<div class="span4">
							<label for="textfield" class="control-label">		
							Seleccione paciente
							</label>
							<input type="hidden" id="codpaciente"  name="codpaciente"  value="<?php echo $codigo ?>" placeholder="">



							<input 
										type="text" 
										name="paciente" 
										id="paciente" 
										placeholder="Paciente" 
										class="input-medium"
										value="<?php echo $identificacion ?>"
										data-rule-required="true"
									
										>

						
							<button id="buscar_paciente" type="button" class="btn" >
								<i class="glyphicon-search"></i>Buscar
							</button>
						</div>

						<div class="span8">
							<label for="razon" class="control-label" >
								Nombres:
							</label>
								<input 
								class="input-xxlarge"
								type="text" 
								id="nombres" 
								name="nombres" 
								readonly="readonly"
								value="<?php echo $nombres ?>" >
						</div>

						<div class="span12">

							<div class="span3">
								Opciones de examen
								<select name="soloexamenes" id="soloexamenes">
									<option value="no">Realizar toda la historia</option>
									<option value="si">Realizar solo los examenes seleccionados</option>
									
								</select>
							</div>	

						</div>
							
					</div>


					<div class="span12">
						
						<div id="load_contrato">

						</div>
						

					</div>			
							

				
				

				</form>
			<div id="load_orden"></div>
			
		</div>
	</div>
</div>






<div id="dilog_busueda" title="Seleccione una empresa">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
				
				
				<input type="text" name="campo_busqueda" id="campo_busqueda" placeholder="Escriba la razon social">
					<button class="btn btn-primary" id="buscar_emp"><i class="glyphicon-search"></i>  Buscar</button>
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_empresas">
				</div>

			</div>
		</div>
	</div>


</div>




<div id="dialog_busueda_pacientes" title="Seleccione un paciente">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
				<input type="text" name="campo_busqueda_pac" id="campo_busqueda_pac" placeholder="">
				<select 
				name="criterio"
				id="criterio"
				>
					<option value="identificacion">Identificación</option>
					<option value="nombres">nombres</option>
					<option value="apellidos">apellidos</option>

				</select>

				<button class="btn btn-primary" id="buscar_pac"><i class="glyphicon-search"></i>  Buscar</button>
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_pacientes">
				</div>

			</div>
		</div>
	</div>


</div>






</div>
