<script>

function actualizar_informacion_ocu(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_informacion").serialize();
  dataString+="&codhistoria="+codhistoria+"&tabla=antecedentes_laborales";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('antecedentes_laborales','load_antecedentes_laborales');
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
if($antecedentes){
foreach ($antecedentes as $datos) {


 ?>

    <input type="hidden" name="new" value="0"/>


    <div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Empresa</label>
    <div class="controls">
     <input type="text"  value="<?php echo $datos['empresaantecedente'] ?>"name="empresaantecedente" id="empresaantecedente">
     <input type="text"  value="<?php echo $datos['empresaantecedente1'] ?>"name="empresaantecedente1" id="empresaantecedente1">
    </div>
  </div>
</div>

<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Cargo</label>
    <div class="controls">
     <input type="text"  value="<?php echo $datos['cargoanttecedente'] ?>"name="cargoanttecedente" id="cargoanttecedente">
     <input type="text"  value="<?php echo $datos['cargoanttecedente1'] ?>"name="cargoanttecedente1" id="cargoanttecedente1">
    </div>
  </div>
</div>

<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Tiempo</label>
    <div class="controls">
     <input type="text"  value="<?php echo $datos['tiempoantecedente'] ?>"name="tiempoantecedente" id="tiempoantecedente">
     <input type="text"  value="<?php echo $datos['tiempoantecedente1'] ?>"name="tiempoantecedente1" id="tiempoantecedente1">
    </div>
  </div>
</div>


<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Incapacidad</label>
    <div class="controls">
     <input type="text"  value="<?php echo $datos['incapacidadantecedente'] ?>"name="incapacidadantecedente" id="incapacidadantecedente">
     <input type="text"  value="<?php echo $datos['incapacidadantecedente1'] ?>"name="incapacidadantecedente1" id="incapacidad1">
    </div>
  </div>
</div>


<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Riesgos</label>
    <div class="controls">
     <input type="text"  value="<?php echo $datos['riesgosantecdentes'] ?>"name="riesgosantecdentes" id="riesgosantecdentes">
     <input type="text"  value="<?php echo $datos['riesgosantecdentes1'] ?>"name="riesgosantecdentes1" id="riesgosantecdentes1">
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
            <label for="textfield" class="control-label">Empresa</label>
            <div class="controls">
                <input type="text"  value="niega"name="empresaantecedente" id="empresaantecedente">
                <input type="text"  value="niega"name="empresaantecedente1" id="empresaantecedente1">
            </div>
        </div>
    </div>

    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Cargo</label>
            <div class="controls">
                <input type="text"  value="niega"name="cargoanttecedente" id="cargoanttecedente">
                <input type="text"  value="niega"name="cargoanttecedente1" id="cargoanttecedente1">
            </div>
        </div>
    </div>

    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Tiempo</label>
            <div class="controls">
                <input type="text"  value="niega"name="tiempoantecedente" id="tiempoantecedente">
                <input type="text"  value="niega"name="tiempoantecedente1" id="tiempoantecedente1">
            </div>
        </div>
    </div>


    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Incapacidad</label>
            <div class="controls">
                <input type="text"  value="niega"name="incapacidadantecedente" id="incapacidadantecedente">
                <input type="text"  value="niega"name="incapacidadantecedente1" id="incapacidad1">
            </div>
        </div>
    </div>


    <div class="span12">

        <div class="control-group">
            <label for="textfield" class="control-label">Riesgos</label>
            <div class="controls">
                <input type="text"  value="niega"name="riesgosantecdentes" id="riesgosantecdentes">
                <input type="text"  value="niega"name="riesgosantecdentes1" id="riesgosantecdentes1">
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