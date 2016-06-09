<link rel="stylesheet" href="<?php echo base_url() ?>tools/jquery.dataTables.css">
<script src="<?php echo base_url() ?>tools/jquery.dataTables.min.js"></script>
 

 
<script type="text/javascript">
var contcontratos=0;
$(document).ready(function(){

	

	 $( "#fechainicio" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "2000:2050",
       dateFormat: "yy/mm/dd",
    });

	 $( "#fechacorte" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "2000:2050",
       dateFormat: "yy/mm/dd",
    });



	
	$("#buscar").click(function(){
		 $( "#dilog_busueda").dialog("open");

	});
	
	$("#dilog_show").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 600,
            width: 920
    });

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

     
     $("#buscar_contratos").click(function(){
     	
     	fechainicio=$("#fechainicio").val();
		fechacorte=$("#fechacorte").val();
		codempresa=$("#codempresa").val();

     	dataString="fechainicio="+fechainicio+"&fechacorte="+fechacorte+"&codempresa="+codempresa;
	          
			$.ajax({
			type: "POST",
			url:"<?php echo base_url() ?>index.php/reportes/buscarcontratos",
			data: dataString,
				success: function(data){
					$("#load_contratos").html(data);
				},
				error: function(data){
					$("#load_contratos").html(data);
				}

			});

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
	$("#form_contratar").validate();

	 
	




  });

	
	function changetext(){}

</script>



<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color lightred box-bordered">
			<div class="box-title">
				<h3><i class="icon-list"></i> Generar factura</h3>
			</div>
			<div class="box-content">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_contratar"
					name="form_contratar"
					action="<?php echo base_url() ?>index.php/reportes/guardar_facturas"
					>


					<div class="span12">
						<div class="span6">
							<label for="textfield" class="control-label">		Seleccione empresa
							</label>
							<input 
									type="text" 
									readonly="readonly" 
									id="codempresa"  
									name="codempresa"  
									value="" 
									placeholder=""
									data-rule-required="true"
									data-rule-maxlength="13"
									>

							<input 
								type="text" 
								name="empresa" 
								id="empresa" 
								placeholder="Empresa" 
								class="input-medium"
								readonly="readonly"
								
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

						


					</div>	

					<div class="span12">
						<div class="span6">
							<label for="razon" class="control-label" >
								Fecha inicio:
							</label>
								<input 
								class="input-xlarge"
								type="text" 
								id="fechainicio" 
								name="fechainicio" 
								readonly="readonly"
								value="" >
						</div>

						<div class="span6">
							<label for="razon" class="control-label" >
								Fecha corte:
							</label>
								<input 
								class="input-xlarge"
								type="text" 
								id="fechacorte" 
								name="fechacorte" 
								readonly="readonly"
								value="" >
						</div>

					</div>

					<div class="span12">
						<div class="form-actions">
							<button type="button" id="buscar_contratos" class="btn btn-blue">
								Buscar contratos
							</button>
						</div>

					</div>

					<div class="span12">
						
					<div id="load_contratos">

					</div>

				</div>			
							

					<div class="span12">
						<div class="form-actions">
							<input  
								type="submit" 
								class="btn btn-primary" 
								id="guardar"  value="PDF">


							<button type="reset" class="btn">Limpiar</button>
						</div>
					</div>

				


				</form>

			</div>
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





<div id="dilog_show" title="Actividades Contratadas">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_contrato">
				</div>

			</div>
		</div>
	</div>


</div>



