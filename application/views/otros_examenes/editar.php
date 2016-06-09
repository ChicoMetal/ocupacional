
<script>
var diagnostico=0;
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
	load_data_form('diagnosticos','load_diagnosticos');
	load_data_form('cuestionario','load_cuestionario');
	

  $("#tabs").tabs();

});



	function finalizar(){
		
		if(diagnostico==0){
			var pasa=confirm("No ha ingresado diagnosticos!!!\nDesea continuar sin diagnosticos?")
			if(pasa){
				$("#form_final_historia").submit();	
			}
		}else{
			$("#form_final_historia").submit();	
		}
		

	}


  function load_data_form(form,div){
  	var dataString="codhistoria=<?php echo $codhistoria ?>&codactividad=<?php echo $codactividad ?>";
    $.ajax({
      url: '<?php echo base_url() ?>index.php/otros_examenes/edit_data_form/'+form,
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
					
					<br>
					Detalle de la historia
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
				

				<div id="load_diagnosticos"></div>
				
				<form 
					id="form_final_historia" 
					method="post"
					action="<?php echo base_url() ?>index.php/otros_examenes/finalizar"
					>
					<input 
						type="hidden" 
						id="codhistoria" 
						name="codhistoria" 
						value="<?php echo $codhistoria ?>"
					>
					<input 
						type="hidden" 
						name="codactividad"  
						id="codactividad" 
						value="<?php echo $codactividad ?>" 
						>
					<div id="load_tipo"></div>
					<br>
					<div id="load_cuestionario"></div>
					<br>
					


					
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