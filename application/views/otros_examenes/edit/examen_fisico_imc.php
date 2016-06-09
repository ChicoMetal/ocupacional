
        <h3>

         Examen fisico
        </h3>


<script>
  $(document).ready(function(){

    $("#btn-examen_fisico_imc").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio informacion examen_fisico_imc");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/pacientes/change_historia_examen_fisico_imc/',
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

    var peso="", estatura="", imc;
   


   
  });

  
</script>




<button 
  type="button"
  id="btn-examen_fisico_imc"
  class="btn btn-magenta"
  >
  Cambiar
</button>
<?php 
if($data)
foreach ($data as $datos) {


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

     <div class="span3">
      
        <label for="textfield" class="control-label">Brazo</label>
        <select name="brazo" id="brazo"  >
          <option value="<?php echo $datos['brazo'] ?>"><?php echo $datos['brazo'] ?></option>
          
        </select>
          
    </div>

  </div> 
 


<?php 

  }# code...

 ?>
