<h3>Habitos</h3>
 <script>
  $(document).ready(function(){

    $("#btn-habitos").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio de habitos");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/pacientes/change_historia_habitos/',
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



<button 
  type="button"
  id="btn-habitos"
  class="btn btn-magenta"
  >
  Cambiar
</button>


<?php 


if($data!="")
foreach ($data as $datos) {

 ?>
 <table class="table table-hover table-nomargin table-bordered">

  <tr>
    <td>    
      <?php echo $datos['fumador'] ?></td>
    <td>
      <?php 
        if($datos['fumador']!="No fuma"){
          echo "Frecuencia:  ".$datos['fuma_frecuencia']."";
          echo " Años de consumo:  ".$datos['fuma_anios']."";
          echo " Tipo:  ".$datos['fuma_tipo']."";
         

        }
         ?>
    </td>

  </tr>
    <tr>

      <td>
    <?php echo $datos['alcohol'] ?>
      </td>
      <td>
        <?php 
          if($datos['alcohol']!="No bebe"){
            echo " Frecuencia:  ".$datos['alcohol_frecuencia']."";
           
          }
           ?>
      </td>
  </tr>
  <tr>
    <td>
    <?php echo $datos['deportes'] ?>
    </td>
    <td>
      <?php 
      if($datos['deportes']!="No deportista"){
        echo " Frecuencia:  ".$datos['deportes_frecuencia']."";
        echo "     Lesiones:  ".$datos['lesiones']."";
               }
       ?>
     </td>
  </tr>
  <tr>
    <td>
      Observaciones
    
      
    </td>
    <td>
      <?php echo $datos['observaciones'] ?>
  </td>
  </tr>
     

</table>

<?php 


}

 ?>

