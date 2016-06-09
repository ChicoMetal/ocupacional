<script>

function actualizar_diagnosticos(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_diagnosticos").serialize();
  
  dataString+="&codhistoria="+codhistoria+"&tabla=antecedentes";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia_diagnosticos/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('diagnosticos','load_diagnosticos');
      $("#dilog_show").dialog("close");
    },
    error: function(data){
      alert("Error al actualizar el tipo de examen "+form);
    }
  });
  
}



</script>

<form id="update_diagnosticos">
  


<?php 
$primero=0;
$nombrediagnostico="";
$cod_diagnosticos="";
foreach ($diagnosticos as  $datos) {
  $cod_diagnosticos=$cod_diagnosticos.$datos['codigo'].",";

?>
  <input type="checkbox" name="<?php echo "diag-".$datos['codigo'] ?>">
  <?php echo $datos['nombre'] ?></td>
  <br>


  
<?php

}

?>

<input type="hidden" value="<?php echo $cod_diagnosticos ?>" name="cod_diagnosticos" id="cod_diagnosticos">

<div class="span12">
<button 
  type="button" 
  class="btn"
  onclick="actualizar_diagnosticos()"
  >
  Guardar
</button>
</div>
</form>