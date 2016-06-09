<script>
var numpaginaotros=1;
var porpaginaotros=0;
var numpagina=1;
var porpagina=0;
var paciente="";
 $(document).ready(function() {
 	  
 	porpagina 		= $("#porpagina").val();
 	porpaginaotros 	= $("#porpaginaotros").val();
 	porpagina 		= $("#porpagina").val();
 	paciente = $("#paciente").val();
 	paginar_ordendes(porpagina,numpagina,paciente);
 	paginar_ordendes_otros(porpaginaotros,numpaginaotros,pacientes);
 	

 	$("#porpaginaotros").click(function() {
 		porpagina =$(this).val();
 		
 		paginar_ordendes_otros(porpagina,numpaginaotros,paciente);
 	});

 	$("#porpagina").click(function() {
 		porpagina =$(this).val();
 		paginar_ordendes(porpagina,numpaginaotros,paciente);
 	});

 	$("#buscar_nom").click(function(){
 		paciente = $("#paciente").val();
 		paginar_ordendes_otros(porpagina,1,paciente);
 		paginar_ordendes(porpagina,1,paciente);
 	})

 });


function paginar_ordendes(porpagina,pagina,paciente){
	
	dataString="porpagina="+porpagina+"&pagina="+pagina+"&paciente="+paciente;	
	$.ajax({
		type: "POST",
		url:"<?php echo base_url() ?>index.php/ordenes/paginar",
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


function paginar_ordendes_otros(porpagina,pagina,paciente){
	
	dataString="porpagina="+porpagina+"&pagina="+pagina+"&paciente="+paciente;	
	$.ajax({
		type: "POST",
		url:"<?php echo base_url() ?>index.php/ordenes/paginar_otros",
		data: dataString,
		async: false,
		success: function(data){
			$("#load_otros_examenes").html(data);
		},
		error: function(data){
			$.gritter.add({
				title: 'Error',
				text: 'Ocurrio un error en la actualizacion',
			});
		}

	});
}


</script>



<div class="container">

<div class="span12">

<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Examenes fisicos por realizar 
					<input type="text" name="paciente" id="paciente" placeholder="">
					<button type="button" class="btn" id="buscar_nom"> Buscar</button>
					<br>
					<select name="porpagina" id="porpagina" >
						
						<option value="50">50</option>
						<option value="40">40</option>
						<option value="30">30</option>
						
						

					</select>
				</h3>
			</div>
			<div class="box-content nopadding">
				

					<div id="load_actividades">

					</div>




			</div>
		</div>
	</div>






</div>

</div>


<div class="span12">

<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Otros examenes 
					<br>
					<select name="porpaginaotros" id="porpaginaotros" >
						<option value="50">50</option>
						<option value="40">40</option>
						<option value="30">30</option>

					</select>
				</h3>
			</div>
			<div class="box-content nopadding">
				

					<div id="load_otros_examenes">

					</div>




			</div>
		</div>
	</div>






</div>


</div>
</div>