<script>
  $(document).ready(function(){

    $("#btn-ocupacional").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio informacion ocupacional");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/pacientes/change_historia_ocupacional/',
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


Información Ocupacional

<button 
  type="button"
  id="btn-ocupacional"
  class="btn btn-magenta"
  >
  Cambiar
</button>
<?php 
if($data)
foreach ($data as $datos) {


 ?>

<div class="span12">

<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Cargo actual</label>
    <div class="controls">
      <input type="text" value="<?php echo $datos['cargo_atual']  ?>" class="input-xlarge" readonly="readonly" name="cargoactual" id="cargoactual">
    </div>
  </div>
</div>


 <div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Horario laboral (Hs)</label>
    <div class="controls">
      <input type="text" value="<?php echo $datos['holario_laboral']  ?>" class="input-xlarge" readonly="readonly" name="horaciolaboral" id="horaciolaboral">
    </div>
  </div>
</div>


<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Turno</label>
    <div class="controls">
      <input type="text"  class="input-xlarge" readonly="readonly" name="turno" id="turno"  value="<?php echo $datos['turno']  ?>" >
      
      
    </div>
  </div>
</div>


<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Funciones</label>
    <div class="controls">
     <input type="text"  value="<?php echo $datos['funciones']  ?>" class="input-xlarge" readonly="readonly" name="funciones" id="funciones">
    </div>
  </div>
</div>

<div class="span12">
 
  <div class="control-group">
    <label for="textfield" class="control-label">Antiguedad</label>
    <div class="controls">
     <input type="text"   value="<?php echo $datos['antiguedad']  ?>"  class="input-xlarge" readonly="readonly" name="antiguedad" id="antiguedad">
    </div>



<?php 

  }# code...

 ?>