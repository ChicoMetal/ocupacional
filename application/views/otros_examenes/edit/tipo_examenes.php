<script>
  $(document).ready(function(){


  

    $("#btn-tipoexamen").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio de tipo de examen");

      var dataString="codigoexamen="+$("#tipoexamen").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/tipo_examenes/change_historia/',
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


Tipo de examen
<br>
<?php 
$primero=0;

foreach ($data as  $datos) {

?>

 <input 
  type="hidden" 
  name="tipoexamen" 
  id="tipoexamen" 
  value="<?php echo $datos['codigo'] ?>" 
  readonly="readonly" >

 <input 
  type="text" 
  name="tipoexamentext" 
  value="<?php echo $datos['nombre'] ?>" 
  readonly="readonly" >
  
<?php

}

?>
<button 
  type="button"
  id="btn-tipoexamen"
  class="btn btn-magenta"
>
  Cambiar
</button>



