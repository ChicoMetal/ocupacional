
<script>

function actualizar_habitos(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_updatehabitos").serialize();
  dataString+="&codhistoria="+codhistoria+"&tabla=habitos";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('habitos','load_habitos');
      $("#dilog_show").dialog("close");
    },
    error: function(data){
      alert("Error al actualizar el tipo de examen "+form);
    }
  });
  
}


</script>


<form  
  id="update_updatehabitos"
  >


<div class="row-fluid">
  <div class="box">
      <div class="box box-color box-bordered magenta">
        <h3>
          
          Fumador
        </h3>
      </div>
      <div class="box-content">
        <div class="span5">
         <label for="textfield" class="control-label">Fumador</label>
          <div class="controls">
              <select name="fumador" id="fumador"> 
                <option value="No fuma">No fuma</option>
                <option value="Fuma">Fuma</option>
                <option value="Ex fuma">Exfumador</option>
              </select>
         </div>
        
      </div>
      <div class="span5">  
        
          <label for="textfield" class="control-label">Frecuencia (Cigarrillos/Dia)</label>
          <div class="controls">
             <input type="number" name="fuma_frecuencia" id="fuma_frecuencia">
          </div>
        
      </div>
      <div class="span5"> 
        
          <label for="textfield" class="control-label">Años de consumo</label>
          <div class="controls">
             <input type="text" name="fuma_anios" id="fuma_anios">
          </div>
        
      </div>
      <div class="span5"> 

        
          <label for="textfield" class="control-label">
            Tipo
          </label>
          <div class="controls">
            <select
              name="fuma_tipo" 
              id="fuma_tipo" 
              
              class="input-xlarge"
              value="<?php echo set_value('descripcion') ?>"
              data-rule-required="true"
              data-rule-maxlength="40"
              >
              
              <option  value="Diario"> Diario </option>
              <option  value="Ocasional"> Ocasional </option>
            </select>

          </div>
       



        </div>
      </div>
</div>

<div class="row-fluid">
  <div class="box">
      <div class="box box-color box-bordered magenta">
        <h3>
          
          Alcohol
        </h3>
      </div>
      <div class="box-content">
        <div class="span5">
         <label for="textfield" class="control-label">Alcohol</label>
          <div class="controls">
              <select name="alcohol" id="alcohol">
                <option value="Bebe">Bebe</option>
                <option value="No bebe">No bebe</option>
                <option value="Ex bebe">Ex bebedor</option>

              </select>


          </div>
        
      </div>
      <div class="span5">  
        
          <label for="textfield" class="control-label">Frecuencia</label>
          <div class="controls">
              <select name="alcohol_frecuencia" id="alcohol_frecuencia">
              
                <option  value="Diario"> Diario </option>
                <option  value="Semanal"> Semanal </option>
                <option  value="Quincenal"> Quincenal </option>
                <option  value="Mensual"> Mensual </option>
                <option  value="Ocacional"> Ocacional </option>
            </select>
          </div>
       
      </div>

      <div class="span12"> 
        
      </div>
      |</div>
  </div>
</div>
  
  <div class="row-fluid">
    <div class="box">
        <div class="box box-color box-bordered magenta">
          <h3>
            
            Deportes
          </h3>
        </div>
        <div class="box-content">

          <div class="span5">
            
            
            
              <label for="textfield" class="control-label">Deportes</label>
              <div class="controls">
                  <select name="deportes" id="deportes">
                    <option value="Deportista">Deportista</option>
                    <option value="No deportista">no deportista</option>
                    <option value="Ex deportista">Ex deportista</option>

                  </select>


              </div>
            
          </div>
          <div class="span5">  
            
              <label for="textfield" class="control-label">Frecuencia </label>
              <div class="controls">
                <select name="deportes_frecuencia" id="deportes_frecuencia">
                  
                  <option  value="Diario"> Diario </option>
                  <option  value="Semanal"> Semanal </option>
                  <option  value="Quincenal"> Quincenal </option>
                  <option  value="Mensual"> Mensual </option>
                  <option  value="Ocacional"> Ocacional </option>
                </select>
              </div>
           
          </div>


          <div class="span5"> 
            
              <label for="textfield" class="control-label">Lesiones</label>
              <div class="controls">
                <select name="lesiones" id="lesiones">
                  
                  <option  value="Si"> Si </option>
                  <option  value="No"> no </option>
               
                </select>
              </div>
            
          </div>
          <div class="span5"> 
           
              <label for="textfield" class="control-label">Observaciones</label>
              <div class="controls">
                <textarea name="hab-observaciones" id="hab-observaciones"></textarea>
              </div>
          
          </div>


        </div>
      </div>
  </div>
</div>
</form>


<?php
if($habitos)
foreach ($habitos as $datos) {


 ?>
<script>
  $("#fumador").val('<?php echo $datos["fumador"] ?>');
  $("#fuma_frecuencia").val('<?php echo $datos["fuma_frecuencia"] ?>');
  $("#fuma_anios").val('<?php echo $datos["fuma_anios"] ?>');
  $("#fuma_tipo").val('<?php echo $datos["fuma_tipo"] ?>');
  $("#alcohol").val('<?php echo $datos["alcohol"] ?>');
  $("#alcohol_frecuencia").val('<?php echo $datos["alcohol_frecuencia"] ?>');
  $("#deportes").val('<?php echo $datos["deportes"] ?>');
  $("#deportes_frecuencia").val('<?php echo $datos["deportes_frecuencia"] ?>');
  $("#lesiones").val('<?php echo $datos["lesiones"] ?>');

</script>
<?php 
}
 ?>


 <button 
  type="button"
  onclick="actualizar_habitos()"
  class="btn btn-green"
  >
  Actalizar
</button>
