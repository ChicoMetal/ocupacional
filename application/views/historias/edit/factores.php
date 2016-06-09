<script>

  $(document).ready(function(){

    $("#btn-factores").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio de tipo de examen");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/riesgos/change_historia/',
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

function eliminar_factor(codigo){
	
	codhistoria=$("#codhistoria").val();
	var dataString="&codhistoria="+codhistoria+"&codfactor="+codigo+"&tabla=factores";

	$.ajax({
		url: '<?php echo base_url() ?>index.php/historias/delete_factor/',
		type: 'post',
		data: dataString,
		async: false,
		success: function (data) {
		  load_data_form('factores','load_factores');
		 
		},
		error: function(data){
		  
		}
	});
  

}

</script>

<div class="span12">
<strong>Factores de riesgo</strong>
<button 
	type="button"
	id="btn-factores"
	class="btn btn-magenta"
	>
	Agregar
</button>
<br>
<?php 
//var_dump($data);
$factor="";
if($data!="")
foreach ($data as $datos) {
?>
<button 
	class="btn icon-remove"
	type="button"
	onclick="eliminar_factor(<?php echo $datos['codigo'] ?>)"
	>
	<?php echo $datos['nombre'] ?>
</button>
<?php

}

 ?>
<br>
</div>