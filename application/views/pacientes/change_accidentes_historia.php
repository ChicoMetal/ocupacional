<script>

function actualizar_informacion_ocu(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_informacion").serialize();
  dataString+="&codhistoria="+codhistoria+"&tabla=accidentes";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('accidentes','load_accidentes');
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
if($accidentes){
foreach ($accidentes as $datos) {


 ?>

    <input type="hidden" name="new" value="0"/>


  <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Accidentes de trabajo</label>
      <div class="controls">
        <input type="text" value="<?php echo $datos['accidentes'] ?>" name="accidentes" id="accidentes">
        <input type="text" value="<?php echo $datos['accidentes1'] ?>" name="accidentes1" id="accidentes1">
      </div>
    </div>
  </div>


   <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Enfermedad profesional</label>
      <div class="controls">
        <input type="text" value="<?php echo $datos['enfermedad'] ?>" name="enfermedad" id="enfermedad">
        <input type="text" value="<?php echo $datos['enfermedad1'] ?>" name="enfermedad1" id="enfermedad1">
      </div>
    </div>
  </div>


  <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Fecha</label>
      <div class="controls">
        <input type="text" value="<?php echo $datos['fechaaccidente'] ?>" name="fechaaccidente" id="fechaaccidente" value="" placeholder="">
        <input type="text" value="<?php echo $datos['fechaaccidente1'] ?>" name="fechaaccidente1" id="fechaaccidente1" value="" placeholder="">
      </div>
    </div>
  </div>


  <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Empresa</label>
      <div class="controls">
       <input type="text" value="<?php echo $datos['empresaaccidente'] ?>" name="empresaaccidente" id="empresaaccidente">
       <input type="text" value="<?php echo $datos['empresaaccidente1'] ?>" name="empresaaccidente1" id="empresaaccidente1">
      </div>
    </div>
  </div>

  <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Tipo de lesion</label>
      <div class="controls">
       <input type="text" value="<?php echo $datos['tipodelesion'] ?>" name="tipodelesion" id="tipodelesion">
       <input type="text" value="<?php echo $datos['tipodelesion1'] ?>" name="tipodelesion1" id="tipodelesion1">
      </div>
    </div>
  </div>

  <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Sitio de lesion</label>
      <div class="controls">
       <input type="text" value="<?php echo $datos['sitiodelesion'] ?>" name="sitiodelesion" id="sitiodelesion">
       <input type="text" value="<?php echo $datos['sitiodelesion1'] ?>" name="sitiodelesion1" id="sitiodelesion1">
      </div>
    </div>
  </div>


  <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Incapacidad</label>
      <div class="controls">
       <input type="text" value="<?php echo $datos['incapacidad'] ?>" name="incapacidad" id="incapacidad">
       <input type="text" value="<?php echo $datos['incapacidad1'] ?>" name="incapacidad1" id="incapacidad1">
      </div>
    </div>
  </div>


  <div class="span12">
   
    <div class="control-group">
      <label for="textfield" class="control-label">Secuelas</label>
      <div class="controls">
       <input type="text" value="<?php echo $datos['secuelas'] ?>" name="secuelas" id="secuelas">
       <input type="text" value="<?php echo $datos['secuelas1'] ?>" name="secuelas1" id="secuelas1">
      </div>
    </div>
  </div>




<?php 

  }
}else{
?>

    <input type="hidden" name="new" value="1"/>

    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Accidentes de trabajo</label>
            <div class="controls">
                <input type="text" value="niega"name="accidentes" id="accidentes">
                <input type="text" value="niega"name="accidentes1" id="accidentes1">
            </div>
        </div>
    </div>


    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Enfermedad profesional</label>
            <div class="controls">
                <input type="text" value="niega"name="enfermedad" id="enfermedad">
                <input type="text" value="niega"name="enfermedad1" id="enfermedad1">
            </div>
        </div>
    </div>


    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Fecha</label>
            <div class="controls">
                <input type="text" value="niega"name="fechaaccidente" id="fechaaccidente" value="" placeholder="">
                <input type="text" value="niega"name="fechaaccidente1" id="fechaaccidente1" value="" placeholder="">
            </div>
        </div>
    </div>


    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Empresa</label>
            <div class="controls">
                <input type="text" value="niega"name="empresaaccidente" id="empresaaccidente">
                <input type="text" value="niega"name="empresaaccidente1" id="empresaaccidente1">
            </div>
        </div>
    </div>

    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Tipo de lesion</label>
            <div class="controls">
                <input type="text" value="niega"name="tipodelesion" id="tipodelesion">
                <input type="text" value="niega"name="tipodelesion1" id="tipodelesion1">
            </div>
        </div>
    </div>

    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Sitio de lesion</label>
            <div class="controls">
                <input type="text" value="niega"name="sitiodelesion" id="sitiodelesion">
                <input type="text" value="niega"name="sitiodelesion1" id="sitiodelesion1">
            </div>
        </div>
    </div>


    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Incapacidad</label>
            <div class="controls">
                <input type="text" value="niega"name="incapacidad" id="incapacidad">
                <input type="text" value="niega"name="incapacidad1" id="incapacidad1">
            </div>
        </div>
    </div>


    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Secuelas</label>
            <div class="controls">
                <input type="text" value="niega"name="secuelas" id="secuelas">
                <input type="text" value="niega"name="secuelas1" id="secuelas1">
            </div>
        </div>
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