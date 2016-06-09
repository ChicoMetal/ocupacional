<script>
  $(document).ready(function(){

    $("#btn-antecedentes_laborales").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio antecedentes laborales");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/pacientes/change_historia_antecedentes_laborales/',
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

</script>


<h3> Antecedentes laborales</h3>

<button 
  type="button"
  id="btn-antecedentes_laborales"
  class="btn btn-magenta"
  >
  Cambiar
</button>
<?php 
if($antecedentes_laborales)
foreach ($antecedentes_laborales as $datos) {


 ?>

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

  }# code...

 ?>