<!--
  10-> Audiometria tamiz
  12-> Visiometria tamiz
  13-> Espirometria
  16-> Prueba de esfuerzo
-->
<script>
var codorden      ='<?php echo $codorden      ?>';
var codactividad  ='<?php echo $codactividad  ?>';
$(document).ready(function() {
  $("#historia_clinica").validate();

  $("#tabs").tabs();
  load_data_form('tipo','load_tipo');
  load_data_form('examen','load_cuestionario');
 
});

 

  function load_data_form(form,div){
    dataString="codorden="+codorden+"&codactividad="+codactividad;
    $.ajax({
      url: '<?php echo base_url() ?>index.php/otros_examenes/load_data_form/'+form,
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

<form 
  id="historia_clinica" 
  class='form-horizontal form-column form-bordered'
  action="<?php echo base_url() ?>index.php/otros_examenes/guardar_inicial"
  method="post"
  >

<input type="hidden" name="codorden" value="<?php echo $codorden ?>">
<input type="hidden" name="codactividad" value="<?php echo $codactividad ?>">


<div class="box box-bordered box-color <?php echo $color ?>">
  <div class="box-title">
    <h3>HISTORIA CLINICA OCUPACIONAL     <button type="submit" class="btn btn-darkblue right">Guardar</button></h3>
  </div>
  <div class="box-content nopadding">
    Cargo
    <input 
      type="text" 
      name="cargo" 
      value="" 
      placeholder="Digite el cargo"
      data-rule-required="true"
      >
     <div class="tab-pane active" id="tipo">
          <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('tipo','load_tipo');"
          >
          Recargar este formulario
        </button>
          <div id="load_tipo"><div problemas></div></div>       
       
      </div>

    <div id="load_cuestionario">
    </div>

    
  </div>
</div>
</div>
</form>
