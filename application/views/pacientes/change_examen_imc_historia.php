<script>

function actualizar_examen_imc_ocu(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_examen_imc").serialize();
  dataString+="&codhistoria="+codhistoria+"&tabla=examen_fisico_imc";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('examen_fisico_imc','load_examen_fisico_imc');
      $("#dilog_show").dialog("close");
    },
    error: function(data){
      alert("Error al actualizar el tipo de examen "+form);
    }
  });
  
}

 function calcularimc(){
    peso=$("#peso").val();
    estatura=$("#talla").val()/100;
    console.log("por asio"+estatura);
      if(peso!="" && estatura!=""){
          imc=peso/(estatura*estatura);
          imc= Math.round(imc * 100) / 100;
          $("#imc").val(imc);
      }
      //alert("calculando");
    }

</script>

<form  
  id="update_examen_imc"
  >


<?php
if($examen_imc)
foreach ($examen_imc as $datos) {


 ?>
<div class="span4">
 <div class="row-fluid">
    <div class="span3">
      
        <label for="textfield" class="control-label">Talla (cm)</label>
        
          <input 
            name="talla" 
            id="talla" 
            placeholder="Talla" 
            class="input-block-level" 
            type="text"
            value="<?php echo $datos['talla'] ?>"
            onkeyup="calcularimc()"
            >
    </div>
    <div class="span3">
      
        <label for="textfield" class="control-label">Peso (Kgs)</label>
        
          <input 
            name="peso" 
            id="peso" 
            placeholder="Peso" 
            class="input-block-level" 
            type="text"
            value="<?php echo $datos['peso'] ?>"
            onkeyup="calcularimc()"
            >
    </div>
    <div class="span3">
      
        <label for="textfield" class="control-label">TA (mmHg)</label>
        
          <input 
            name="ta" 
            id="ta" 
            placeholder="TA " 
            class="input-block-level" 
            type="text"
             value="<?php echo $datos['ta'] ?>"
            >
    </div>

    <div class="span3">
      
        <label for="textfield" class="control-label">FC (x min)</label>
        
          <input 
            name="fc" 
            id="fc" 
            placeholder="FC" 
            class="input-block-level" 
            type="text"
            value="<?php echo $datos['fc'] ?>"
            >
    </div>
    <div class="span3">
      
        <label for="textfield" class="control-label">FR (x min)</label>
        
          <input 
            name="fr" 
            id="fr" 
            placeholder="FR" 
            class="input-block-level" 
            type="text"
            value="<?php echo $datos['fr'] ?>"
            >
    </div>

    <div class="span3">
      
        <label for="textfield" class="control-label">IMC</label>
        
          <input 
            name="imc" 
            id="imc" 
            placeholder="IMC" 
            class="input-block-level" 
            type="text"
            value="<?php echo $datos['imc'] ?>"
            >
    </div>
    <div class="span3">
      
        <label for="textfield" class="control-label">TEMP °C</label>
        
          <input 
            name="temp" 
            id="temp" 
            placeholder="Tempreratura" 
            class="input-block-level" 
            type="text"
            value="<?php echo $datos['temperatura'] ?>"
            >
    </div>
    
    <div class="span5">
      
        <label for="textfield" class="control-label">Brazo</label>
        <select name="brazo" id="brazo">
          <option value="Diestro">Diestro</option>
          <option value="Zurdo">Zurdo</option>
          <option value="Ambidiestro">Ambidiestro</option>
        </select>
          
    </div>

  </div> 
</div> 



<?php 

  }

 ?>
 <button 
  type="button"
  onclick="actualizar_examen_imc_ocu()"
  class="btn btn-green"
  >
  Actalizar
</button>
</form>