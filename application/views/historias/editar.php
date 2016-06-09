
<script>

soloexamenes="no";
$(document).ready(function() {
	$("#dilog_show").dialog({
		modal: true,
		autoOpen: false,
		height: 460,
		width: 800,
		resizable: false 
    });


	load_data_form('tipo','load_tipo');
	load_data_form('datos_paciente','load_datos_paciente');
	load_data_form('informacion_ocupacional','load_informacion');
	load_data_form('habitos','load_habitos');
	load_data_form('antecedentes','load_antecedentes');


  $("#tabs").tabs();

});




  function load_data_form(form,div){
  	var dataString="codhistoria=<?php echo $codhistoria ?>";
    $.ajax({
      url: '<?php echo base_url() ?>index.php/historias/edit_data_form/'+form,
      type: 'post',
      data: dataString,
      success: function (data) {
        $("#"+div).html(data);
      },
      error: function(data){
        alert("Error al cargar un formulario "+form);
      }
    });
  
  }


</script>

<div class="container">
	
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Guardado correctamente
					<br>
					Detalle de la historia
				</h3>
			</div>
			<div class="box-content nopadding">
				<input 
					type="hidden" 
					id="codhistoria" 
					name="codhistoria" 
					value="<?php echo $codhistoria ?>"
				>

				<form>
					
					<div id="load_tipo"></div>
					<br>
					<div id="load_datos_paciente"></div>
					<br>
					<div id="load_informacion"></div>
					<br>
					<div id="load_habitos"></div>
					<br>
					<div id="load_antecedentes"></div>
					<br>
					<div id="load_factores"></div>
					<br>
					<div id="load_revision_por_sistema"></div>
					<br>
					<div id="load_examen_fisico"></div>
					<br>
					<div id="load_examen_fisico_osteo"></div>
					<br>
					<div id="load_examen_de_alto_riesgo"></div>
					<br>
					<div id="load_audiometria"></div>
					<br>
					<div id="load_audiometria_grafica"></div>





					
				</form>

			</div>
		</div>
	</div>
</div>



</div>





<div id="dilog_show" title="Cambios">
  <div class="box box-bordered">
    <div class="box-title">
      <h3>
  		<label for="nombre_edit" id="nombre_edit"></label>
  		
      </h3>
      
    </div>
    <div class="box-content">
      <div class="tab-content">
        
        <div id="load_edit_datos">
        </div>

      </div>
    </div>
  </div>


</div>