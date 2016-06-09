<?php 
	echo date("Y/m/d H:m:s");
 ?>
<script>

var concepto=0;
var recomendaciones=0;

soloexamenes="no";
$(document).ready(function() {


  $("#tabs").tabs();


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
	load_data_form('factores','load_factores');
	load_data_form('revision_por_sistema','load_revision_por_sistema');
	load_data_form('examen_fisico','load_examen_fisico');
	load_data_form('diagnosticos','load_diagnosticos');
	load_data_form('examen_fisico_imc','load_examen_fisico_imc');
	load_data_form('otros_diagnosticos','load_otros_diagnosticos');
	load_data_form('antecedentes_laborales','load_antecedentes_laborales');
	load_data_form('accidentes','load_accidentes');
	load_data_form('ayudasdiasgnosticas','load_otros_examenes');
	


	load_data_form_final('concepto_actitud_medica_ocupcional','load_concepto_actitud_medica_ocupcional');
	load_data_form_final('recomendaciones_laborales','load_recomendaciones_laborales');

 
});

	function finalizar(){
			
		if(concepto==0){
			$.gritter.add({
				title: 'Error',
				text: 'Debe ingresar almenos un concepto',
			});
		}else if(recomendaciones==0){
			$.gritter.add({
				title: 'Error',
				text: 'Debe ingrsar almenos una recomendacion',
			});
		}else{
			$("#form_final_historia").submit();	
		}
		


		

	}


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


  function load_data_form_final(form,div){
    $.ajax({
      url: '<?php echo base_url() ?>index.php/historias/load_data_form/'+form,
      type: 'post',
      data: {},
      success: function (data) {
        $("#"+div).html(data);
      },
      error: function(data){
        alert("Error al cargar un formulario "+form);
      }
    });
  
  }



</script>
<?php 
 $codhistoria= $codhistoria=$historia = $this->uri->segment(3) ;

 ?>
<form 
			action="<?php echo base_url() ?>index.php/historias/finalizar_historia"
			method="post"
			id="form_final_historia"
			
			>

<div class="container">
<div class="box box-color box-bordered green">
	<div class="box-title">
		<h3>HISTORIA CLINICA OCUPACIONAL CONCEPTO DE ACTITUD  
			<button 
				type="button"
				class="btn btn-red"
				onclick="finalizar()"
				>
				Finalizar
			</button>  
		</h3>
	</div>
	<div class="box-content nopadding">
		<div class="tabs-container">
			 <ul class="tabs tabs-inline tabs-top">

		        <li id="tab_tipo_de_examen">
		          <a href="#datos_tipo_de_examen" data-toggle='tab'><strong>Tipo de Examen</strong></a>
		        </li>
		        <li id="tab_datos_paciente">
		          <a href="#datos_paciente" data-toggle='tab'><strong>Datos del paciente</strong></a>
		        </li>
		        <li id="tab_informacion_ocupacional">
		          <a href="#datos_informacion_ocupacional" data-toggle='tab'><strong>Información Ocupacional</strong></a>
		        </li>

		        <li id="tab_antecedentes_laborales">
		          <a href="#datos_antecedentes_laborales" data-toggle='tab'><strong>Antecedentes Laborales</strong></a>
		        </li>		        
		        <li id="tab_accidentes">
		          <a href="#datos_accidentes" data-toggle='tab'><strong>Accidentes Laborales</strong></a>
		        </li>
		        <li id="tab_habitos">
		          <a href="#datos_habitos" data-toggle='tab'><strong>Habitos</strong></a>
		        </li>
		        <li id="tab_antecedentes">
		          <a href="#datos_antecedentes" data-toggle='tab'><strong>Antecedentes</strong></a>
		        </li>
		        <li id="tab_factores">
		          <a href="#datos_factores" data-toggle='tab'><strong>Factores de riesgo</strong></a>
		        </li>
		        <li id="tab_revision_por_sistema">
		          <a href="#datos_revision_por_sistema" data-toggle='tab'><strong>Revision por sistema</strong></a>
		        </li>
		        <li id="tab_examen_fisico_imc">
		          <a href="#datos_examen_fisico_imc" data-toggle='tab'><strong>Examen fisico imc</strong></a>
		        </li>
		        <li id="tab_examen_fisico">
		          <a href="#datos_examen_fisico" data-toggle='tab'><strong>Examen fisico</strong></a>
		        </li>
		        <li id="tab_diagnosticos">
		          <a href="#datos_diagnosticos" data-toggle='tab'><strong>Diagnosticos</strong></a>
		        </li>
		       

		        <li id="tab_concepto">
		          <a href="#datos_concepto" data-toggle='tab'><strong>Concepto de actitud</strong></a>
		        </li>
		        <li id="tab_recomendaciones_laborales">
		          <a href="#datos_recomendaciones_laborales" data-toggle='tab'><strong>Recomendaciones Laborales</strong></a>
		        </li>
		        <li id="tab_remisiones">
		          <a href="#datos_remisiones" data-toggle='tab'><strong>Remisiones</strong></a>
		        </li>
		        <li id="tab_otros_examenes">
		          <a href="#datos_otros_examenes" data-toggle='tab'><strong>Ayudas Diagnósticas</strong></a>
		        </li>





		        
		     <ul>
		</div>
		<div class="tab-content padding tab-content-inline tab-content-bottom">
			<div class="tab-pane active" id="datos_tipo_de_examen">
				<div id="load_tipo"></div>
			</div>
			<div class="tab-pane" id="datos_paciente">
				<div id="load_datos_paciente"></div>
			</div>
			<div class="tab-pane" id="datos_informacion_ocupacional">
				<div id="load_informacion"></div>
			</div>

			<div class="tab-pane" id="datos_antecedentes_laborales">
				<div id="load_antecedentes_laborales"></div>
			</div>
			<div class="tab-pane" id="datos_accidentes">
				<div id="load_accidentes"></div>
			</div>
			<div class="tab-pane" id="datos_habitos">
				<div id="load_habitos"></div>
			</div>
			<div class="tab-pane" id="datos_antecedentes">
				<div id="load_antecedentes"></div>
			</div>
			<div class="tab-pane" id="datos_factores">
				<div id="load_factores"></div>
			</div>
			<div class="tab-pane" id="datos_revision_por_sistema">
				<div id="load_revision_por_sistema"></div>
			</div>
			<div class="tab-pane" id="datos_examen_fisico_imc">
				<div id="load_examen_fisico_imc"></div>
			</div>
			<div class="tab-pane" id="datos_examen_fisico">
				<div id="load_examen_fisico"></div>
			</div>
			<div class="tab-pane" id="datos_diagnosticos">
				<div id="load_diagnosticos"></div>
			</div>
			
		
			<div class="tab-pane" id="datos_concepto">
				
				<input 
						type="hidden" 
						name="codhistoria" 
						id="codhistoria" 
						value="<?php echo $codhistoria ?>">

						<div id="load_concepto_actitud_medica_ocupcional"></div>
				
			</div>
		
			<div class="tab-pane" id="datos_recomendaciones_laborales">
				<div id="load_recomendaciones_laborales"></div>
			
			</div>
			<div class="tab-pane" id="datos_remisiones">
					Remite
					<select name="remision" >
						<option value="no">no</option>
						<option value="si">si</option>
						
					</select>
					Motivo de la remision
					<textarea name="motivo_remision" value="" placeholder="Dijite el motivo"></textarea>
			
			</div>
			<div class="tab-pane" id="datos_otros_examenes">
				<div id="load_otros_examenes"></div>
			</div>
			
				
		</div>
	</div>
</div>	


<input 
	type="hidden" 
	id="codhistoria" 
	name="codhistoria" 
	value="<?php echo $codhistoria ?>"
>


<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					
					<br>
					
				</h3>
			</div>
			<div class="box-content nopadding">

				


					
				

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
</form>
