<script>

function actualizar_examen_fisico(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_examen_fisico").serialize();
  dataString+="&codhistoria="+codhistoria+"&tabla=examen_fisico";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('examen_fisico','load_examen_fisico');
      $("#dilog_show").dialog("close");
    },
    error: function(data){
      alert("Error al actualizar el tipo de examen "+form);
    }
  });
  
}


</script>

<form  
  id="update_examen_fisico"
  >

<table class="table table-hover table-nomargin table-bordered">
    <thead>
      <tr>
        <th>SISTEMA</th>
        <th>OBSERVACION</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $cods_examen_fisico="";
      foreach ($examen_fisico as  $data) {
        $cods_examen_fisico=$cods_examen_fisico.$data['codigo'].",";
        ?>

        <tr>
          <td><?php echo $data['nombre'] ?></td>
          <td>
            <input type="text" name="<?php echo 'exaf-'.$data['codigo']  ?>" id="<?php echo 'rsis-'.$data['codigo']  ?>" value="<?php echo $data['observacion']  ?>">
          </td>
        </tr>
        <?php
      }
     ?>
     <input type="hidden" name="cods_exaf" value="<?php echo $cods_examen_fisico ?>">
    </tbody>
</table>

<button 
  type="button"
  onclick="actualizar_examen_fisico()"
  class="btn btn-green"
  >
  Actalizar
</button>

</form>


