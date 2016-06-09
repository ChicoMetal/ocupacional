<link rel="stylesheet" href="<?php echo base_url() ?>tools/jquery.dataTables.css">
<script src="<?php echo base_url() ?>tools/jquery.dataTables.min.js"></script>

<script>

soloexamenes="no";
$(document).ready(function() {
	$('#tablehistoria').dataTable( {
        "sDom": 'T<"clear">lfrtip',
        "oTableTools": {
        	
            "sSwfPath": "<?php echo base_url() ?>tools/copy_csv_xls_pdf.swf"
        }
    });

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

 
});

	function finalizar(){
		
		$("#historia_form").submit();

	}


  function load_data_form(form,div){
  	var dataString="codhistoria=<?php echo $codhistoria ?>";
    $.ajax({
      url: '<?php echo base_url() ?>index.php/historias/show_data_form/'+form,
      type: 'post',
      data: dataString,
      success: function (data) {
        $("#"+div).html(data);
        if(form=="informacion_ocupacional"){
        	

        }

      },
      error: function(data){
        alert("Error al cargar un formulario "+form);
      }
    });
  
  }


  function load_data_form_final(form,div){
    $.ajax({
      url: '<?php echo base_url() ?>index.php/historias/show_data_form/'+form,
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

<table id="tablehistoria">
	<thead>
		<tr>
			<th>header1</th>
			<th>header2</th>
			<th>header3</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>data111</td>
			<th>heade22</th>
			<th>
				<img src="<?php echo base_url() ?>img/apple-touch-icon-precomposed.png" alt="">

			</th>
		</tr>
	</tbody>
</table>


<!--
<table  border="1">
<caption>Historias clinica</caption>
					
<tbody>
	<tr>
	<td></td>

	<tr>

	</tr>
		<td>

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
			<div class="span12"></div>

		</td>
	</tr>
</tbody>
</table>	
				

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