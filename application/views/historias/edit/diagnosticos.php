
<script>

  $(document).ready(function(){

    $("#btn-diagnosticos").click(function(){
    	
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Disgnosticos");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/diagnosticos/change_historia/',
        type: 'post',
        data: dataString,
        success: function (data) {
         
          $("#load_edit_datos").html(data);
        },
        error: function(data){
          alert("Error al cargar un formulario "+form);
        }
      });
  

    });

  });

function eliminar_diagnostico(codigo){
	
	codhistoria=$("#codhistoria").val();
	var dataString="&codhistoria="+codhistoria+"&coddiagnostico="+codigo+"&tabla=historias_diagnosticos";

	$.ajax({
		url: '<?php echo base_url() ?>index.php/historias/delete_diagnostico/',
		type: 'post',
		data: dataString,
		async: false,
		success: function (data) {
		  load_data_form('diagnosticos','load_diagnosticos');
		 
		},
		error: function(data){
		  
		}
	});
  

}

</script>

<div class="span12">
<strong>Diagnosticos</strong>
<button 
	type="button"
	id="btn-diagnosticos"
	class="btn btn-magenta"
	>
	Agregar
</button>
<br>
<?php 
//var_dump($data);
$diagnostico="";
if($data!="")
foreach ($data as $datos) {
?>
<button 
	class="btn icon-remove"
	type="button"
	onclick="eliminar_diagnostico(<?php echo $datos['codigo'] ?>)"
	>
	<?php echo $datos['nombre'] ?>
</button>
<?php

}

 ?>
<br>
</div>