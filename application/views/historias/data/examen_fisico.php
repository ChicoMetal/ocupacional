<script type="text/javascript">
  $(document).ready(function() {
    var peso="", estatura="", imc;
    $("#talla").keyup(function(){
        estatura=$(this).val()/100;
         calcularimc();

    });

    $("#peso").keyup(function(){
        peso=$(this).val();
         calcularimc();
    });


    function calcularimc(){
      if(peso!="" && estatura!=""){
          imc=peso/(estatura*estatura);
          imc= Math.round(imc * 100) / 100;
          $("#imc").val(imc);
      }
      //alert("calculando");
    }
  });

</script>


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
            value="0"
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
            value="0"
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
            value="0"
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
            value="0"
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
            value="0"
            >
    </div>

    <div class="span3">
      
        <label for="textfield" class="control-label">Brazo</label>
        <select name="brazo" id="brazo">
          <option value="Diestro">Diestro</option>
          <option value="Zurdo">Zurdo</option>
          <option value="Ambidiestro">Ambidiestro</option>
        </select>
          
    </div>
    <div class="span3">
      
        <label for="textfield" class="control-label">IMC</label>
        
          <input 
            name="imc" 
            id="imc" 
            placeholder="IMC" 
            class="input-block-level" 
            type="text"
            value="0"
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
            value="0"
            >
    </div>


  </div> 
</div> 
<br>
<div class="span12"></div>
<div class="span6">
  <table class="table table-hover table-nomargin table-bordered">
    <thead>
      <tr>
        <th>Organo </th>
        <th>Observacion </th>
        
        
      </tr>
    </thead>
    <tbody>
       <?php 
        $cods_exaf="";
        foreach ($examen as  $data) {
          
          $cods_exaf=$cods_exaf.$data['codigo'].",";
          ?>

          <tr>
            <td><?php echo $data['nombre'] ?></td>
            <td>
              <input type="text" name="<?php echo 'exaf-'.$data['codigo']  ?>" id="<?php echo 'exaf-'.$data['codigo']  ?>" value="Sin datos de importancia">
            </td>
          </tr>
          <?php
        }
       ?>


    </tbody>

  </table>
</div>

<input  type="hidden" name="cods_exaf" value="<?php echo $cods_exaf ?>">

<div class="span12">
  Observaciones
  <textarea name="exaf-observaciones" id="exaf-observaciones" placeholder="Observaciones" rows="5" class="input-block-level"></textarea>
</div>

          