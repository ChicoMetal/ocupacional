


<script type="text/javascript">
var contcontratos=0;
$(document).ready(function(){

	var fecha = new Date();
	var anio = fecha.getFullYear();


	 $( "#fecha1" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1900:"+anio,
       dateFormat: "yy/mm/dd",
    });

	$( "#fecha2" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "2000:2020",
       dateFormat: "yy/mm/dd"
    });


	$("#buscar_orden_search").click(function(){


		var fecha1=$("#fecha1").val();
		var fecha2=$("#fecha2").val();
		var paciente=$("#codpaciente").val();
		if(fecha1==""){
			alert("Debe elegir una fecha inicial");
		}else if(paciente==""){
			alert("Debe elegir un paciente");
		}else{
			dataString="fecha1="+fecha1+"&fecha2="+fecha2+"&paciente="+paciente;
			$.ajax({
				type: "POST",
				url:"<?php echo base_url() ?>index.php/ordenes/buscar_ordenes",
				data: dataString,
				success: function(data){
					
					$("#load_ordenes").children().remove("div");
					$("#load_ordenes").append(data);
				},
				error: function(data){
					$("#load_ordenes").append(data);
				},
				beforeSend: function(data){
					
				}

			});

		}


		
	});

	$("#dialog_busueda_pacientes").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 600,
            width: 1000,
            draggable: false
    });



	$("#buscar_paciente").click(function(){
		 $( "#dialog_busueda_pacientes").dialog("open");

	});
	
	
	
	




   	function guardar_actividades(){


   	}

	
   




      $('#buscar_pac').click(function(){

        var busqueda = $("#campo_busqueda_pac").val();
        var criterio = $("#criterio").val();
        do {
                busqueda =busqueda.replace(' ','%20');
        }while(busqueda.indexOf(' ') >= 0);

        $("#load_pacientes").load("<?php echo base_url(); ?>index.php/pacientes/buscar_pacientes?valor="+busqueda+"&criterio="+criterio);

    });

     



  });


	function changetext(){
		var codempresa=$("#codempresa").val();
		var fecha=$("#fecha").val();

		if(fecha!=""){
			$("#load_contrato").load("<?php echo base_url() ?>index.php/actividades/show_contratos_orden/"+codempresa+"/"+fecha);
			
		}
		

	}



	
</script>




<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered dark_blue_smal">
			<div class="box-title">
				<h3><i class="icon-list"></i> 
					Buscar orden de atención
				</h3>
			</div>

			
					
					<div class="span12">
						<div class="span4">
							<label for="textfield" class="control-label">		
							Seleccione paciente
							</label>
							<input type="hidden" id="codpaciente"  name="codpaciente"  value="" placeholder="">

							<input 
										type="text" 
										name="paciente" 
										id="paciente" 
										placeholder="Paciente" 
										class="input-medium"
										
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
								value="" >
						</div>

							
					</div>
					<div class="span12">
						<div class="span6">
							<label for="razon" class="control-label" >
								Fecha inicial
							</label>
							<input type="text" name="fecha1" id="fecha1">		
									
						</div>
						<div class="span6">
							<label for="razon" class="control-label" >
								Fecha final
							</label>
							<input type="text" name="fecha2" id="fecha2">
						</div>			

					</div>
					<div class="span12">
						<button id="buscar_orden_search" type="button" class="btn btn-orange" >
							<i class="glyphicon-search"></i>Buscar
						</button>	
					</div>

						
							

				
				

			
			
		</div>



	</div>

</div>
		



</div>




<div class="container">


<div class="span10">
<div id="load_ordenes"></div>

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





