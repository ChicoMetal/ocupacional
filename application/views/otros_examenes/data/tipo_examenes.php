


<?php 
$primero=0;
$tipo_examenescods_tipo_examenes="";
foreach ($tipo_examenes as  $datos) {
$tipo_examenescods_tipo_examenes=$tipo_examenescods_tipo_examenes.$datos['codigo'].",";
?>

   <div class="control-group">
    <label for="textfield" class="control-label"> <?php echo $datos['nombre'] ?>:</label>
    <div class="controls">
     <input 
      type="radio" 
      name="tipoexamen" 
      id="<?php echo "tipoexamen-".$datos['codigo'] ?>"
      value="<?php echo $datos['codigo'] ?>"
      data-rule-required="true"
      checked="checked"
      > 
    </div>
  </div>

 
  
<?php

}

?>

<input type="hidden" name="tipo_examenescods_tipo_examenes" value="<?php echo $tipo_examenescods_tipo_examenes ?>">
        





          