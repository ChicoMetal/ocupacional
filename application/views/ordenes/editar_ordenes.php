<script type="text/javascript">
var contcontratos=0;
var codem;
var contrato;
var orden='<?php echo $codorden ?>'
$(document).ready(function(){
	
	changetext(codem);
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
				$("#tabla_detalle").find("tr").each(function(index, el) {
					$(this).remove();
				});
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
		                url:"<?php echo base_url() ?>index.php/ordenes/actualizar_orden",
		                data: dataString,
		                async:false,
		                success: function(data){
		              		if(data=="no"){

		              		}else{
		              			$("#load_contrato").children().remove();
		              			mostrar_historia(orden);
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


	function changetext(codempresa){
		
		var fecha=$("#fecha").val();

		if(fecha!=""){
			$("#load_contrato").load("<?php echo base_url() ?>index.php/ordenes/show_contratos_orden_edit/"+codempresa+"/"+contrato+"/"+orden);
			
		}
		

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
					<input type="hidden" name="codorden" value="<?php echo $codorden ?>">
					<table class="table" id="tabla_detalle">
						<caption>Actividades de la orden</caption>
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Nombre</th>
							</tr>
						</thead>
						<tbody>
							
						
					<?php 
					
					foreach ($orden as $data) {
						?>

						<tr>
							<td><?php echo $data['codigo']; ?> </td>
							<td><?php echo $data['nombre']; ?> </td>
						</tr>
						<script>

							codem='<?php echo $data["codempresa"]; ?>';
							contrato='<?php echo $data["contrato"]; ?>';
						</script>
						<?php
					}



					?>
					</tbody>
					</table>
					<input type="text" name="codempresa"  id="codempresa" value="">
					<div class="span12">
						


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
