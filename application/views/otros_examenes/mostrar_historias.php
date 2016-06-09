
<script>
 $(document).ready(function() {

	$("#fechainicial").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1900:2013",
       dateFormat: "yy/mm/dd",
    });
	$("#fechafinal").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "1900:2013",
       dateFormat: "yy/mm/dd",
    });

	$("#dialog_busueda_pacientes").dialog({

		modal: true,
		autoOpen: false,
		height: 600,
		width: 1000,
		draggable: false
	});

 	porpagina =$("#porpagina").val();
 	porpaginaaudio =$("#porpaginaaudio").val();
 	
 	$("#buscar_historias_btn").click(function() {

 		paginar_historias(porpagina,1);
 	});

 	
 	
 	$("#buscar_paciente").click(function(){
		 $( "#dialog_busueda_pacientes").dialog("open");

	});



      $('#buscar_pac').click(function(){

        var busqueda = $("#campo_busqueda_pac").val();
        var criterio = $("#criterio").val();
        do {
                busqueda =busqueda.replace(' ','%20');
        }while(busqueda.indexOf(' ') >= 0);

        $("#load_pacientes").load("<?php echo base_url(); ?>index.php/pacientes/buscar_pacientes?valor="+busqueda+"&criterio="+criterio);

    });

     

 });

function paginar_historias(porpagina,pagina){
	
	
	codpaciente		=	$("#codpaciente").val();
	fechainicial	=	$("#fechainicial").val();
	fechafinal		=	$("#fechafinal").val();

	if(codpaciente==""){
		$.gritter.add({
			title: 'Error',
			text: 'Debe elegir un paciente',
		});

	}else if(fechainicial==""){
		$.gritter.add({
			title: 'Error',
			text: 'Debe elegir una fecha inicial',
		});
	}else{

		dataString="porpagina="+porpagina+"&pagina="+pagina;
		dataString=dataString+"&codpaciente="+codpaciente+"&fechainicial="+fechainicial+"&fechafinal="+fechafinal;	
		$.ajax({
			type: "POST",
			url:"<?php echo base_url() ?>index.php/historias/paginar_historias",
			data: dataString,
			async: false,
			success: function(data){
				$("#load_actividades").html(data);
			},
			error: function(data){
				$.gritter.add({
					title: 'Error',
					text: 'Ocurrio un error en la actualizacion',
				});
			}

		});
	}
}


function changetext(){}
</script>



<div class="container">

<div class="span12">

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered teal">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					historias
					<br>
					<select name="porpagina" id="porpagina" >
						<option value="30">30</option>
						<option value="40">40</option>
						<option value="50">50</option>
					</select>
				</h3>
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
								<i class="glyphicon-search"></i>Buscar paciente
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
	
					</div>
					<div class="span12">
						<input 
							type="text" 
							name="fechainicial" 
							id="fechainicial" 
							value="" 
							placeholder=""
						>

						<input 
							type="text" 
							name="fechafinal" 
							id="fechafinal" 
							value="" 
							placeholder=""
						>
						<button id="buscar_historias_btn" type="button" class="btn btn-green" >
								<i class="glyphicon-search"></i>Buscar historias
							</button>
					</div>
			</div>
			<div class="box-content nopadding">
				
					


					<div id="load_actividades">

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




