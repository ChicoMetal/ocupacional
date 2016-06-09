<script type="text/javascript">
var contcontratos=0;
$(document).ready(function(){
	$("#dilog_edit_valores").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 300,
            width: 500,
            draggable: false
    });

		$("#modificar_valor").validate({
			submitHandler: function(form){
				var codcontrato=$("#codcontrato").val();
				var dataString = $(form).serialize();
					dataString=dataString+"&codcontrato="+codcontrato;
		          $.ajax({
	            	type: "POST",
	                url:"<?php echo base_url() ?>index.php/actividades/editar_detalle",
	                data: dataString,
	                success: function(data){
	              		if(data=="no"){

	              		}else{
	              			$("#dilog_edit_valores").dialog("close");

                            search_contratos();
	              			
	              		}
	                },
	                error: function(data){

	             
	                }

	            });

			
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
                   $("#form_contratar_nuevo").submit();
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
        $("#load_contrato_actividades").load("<?php echo base_url() ?>index.php/actividades/show_contratos_empresa_codigo/"+contrato);
    }





	
</script>




<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color lightred box-bordered">
			<div class="box-title">
				<h3><i class="icon-list"></i> Actividades Contratadas</h3>
			</div>
			<div class="box-content">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_contratar"
					name="form_contratar"
					action="<?php echo base_url() ?>index.php/actividades/contratar"
					>


					<div class="span12">
						<div class="span6">
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
                        <div class="span6">
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


                        <div id="loadcontratos">

                        </div>




					</div>	
				
					<div class="span12">
						
					<div id="load_actividades">

					</div>

				</div>			
							

					<div class="span12">
						<div class="form-actions">
							<input  
								type="submit" 
								class="btn btn-primary" 
								id="guardar"  value="Guardar">
							<button type="reset" class="btn">Limpiar</button>
						</div>
					</div>

				


				</form>

			</div>
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



<div id="dilog_actividades"  title="Seleccione una actividad">
	<div class="box box-bordered">
		<div class="box-title">
			
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				<div id="load_actividades_new">
				</div>
			</div>
		</div>
	</div>


</div>

<div id="dilog_edit_valores"  title="Cambio del valor">
	<div class="box box-bordered">
		<div class="box-title">
			
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				<form id="modificar_valor">
					<label> Nuevo valor</label>
					<input  type="hidden" id="cod_actividad" name="cod_actividad">
					<input 
						type="text" 
						id="nuevo_valor" 
						name="nuevo_valor"
						data-rule-required="true"
						data-rule-number="true"
					>
					<br>
					<button type="submit" class="btn btn-brown">
						Actualizar
					</button>
					
				</form>
			</div>
		</div>
	</div>


</div>





<div id="load_contrato_actividades">
</div>


</div>
