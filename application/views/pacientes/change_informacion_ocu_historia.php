<script>

function actualizar_informacion_ocu(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_informacion").serialize();
  dataString+="&codhistoria="+codhistoria+"&tabla=informacion_ocupacional";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('informacion_ocupacional','load_informacion');
      $("#dilog_show").dialog("close");
    },
    error: function(data){
      alert("Error al actualizar el tipo de examen "+form);
    }
  });
  
}


</script>

<form  
  id="update_informacion"
  >


<?php
if($informacion)
foreach ($informacion as $datos) {


 ?>

<div class="span12">

<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Cargo actual</label>
    <div class="controls">
      <input type="text" value="<?php echo $datos['cargo_atual']  ?>" class="input-xlarge"  name="cargoactual" id="cargoactual">
    </div>
  </div>
</div>


 <div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Horario laboral (Hs)</label>
    <div class="controls">
      <input type="text" value="<?php echo $datos['holario_laboral']  ?>" class="input-xlarge"  name="horaciolaboral" id="horaciolaboral">
    </div>
  </div>
</div>


<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Turno</label>
    <div class="controls">
      <input type="text"  class="input-xlarge"  name="turno" id="turno"  value="<?php echo $datos['turno']  ?>" >
      
      
    </div>
  </div>
</div>


<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Funciones</label>
    <div class="controls">
     <input type="text"  value="<?php echo $datos['funciones']  ?>" class="input-xlarge"  name="funciones" id="funciones">
    </div>
  </div>
</div>

<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Antiguedad</label>
    <div class="controls">
     <input type="text"   value="<?php echo $datos['antiguedad']  ?>"  class="input-xlarge"  name="antiguedad" id="antiguedad">
    </div>



<?php 

  }

 ?>
 <button 
  type="button"
  onclick="actualizar_informacion_ocu()"
  class="btn btn-green"
  >
  Actalizar
</button>
</form>