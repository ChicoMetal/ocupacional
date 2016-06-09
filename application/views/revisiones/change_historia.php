<script>

function actualizar_sistemas(){
  codhistoria=$("#codhistoria").val();
  var dataString = $("#update_sistemas").serialize();
  dataString+="&codhistoria="+codhistoria+"&tabla=sistemas";

  $.ajax({
    url: '<?php echo base_url() ?>index.php/historias/update_historia/',
    type: 'post',
    data: dataString,
    async: false,
    success: function (data) {
      load_data_form('revision_por_sistema','load_revision_por_sistema');
      $("#dilog_show").dialog("close");
    },
    error: function(data){
      alert("Error al actualizar el tipo de examen "+form);
    }
  });
  
}


</script>

<form  
  id="update_sistemas"
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
      $cods_sistemas="";
      foreach ($sistema as  $data) {
        $cods_sistemas=$cods_sistemas.$data['codigo'].",";
        ?>

        <tr>
          <td><?php echo $data['nombre'] ?></td>
          <td>
            <input type="text" name="<?php echo 'rsis-'.$data['codigo']  ?>" id="<?php echo 'rsis-'.$data['codigo']  ?>" value="<?php echo $data['observacion']  ?>">
          </td>
        </tr>
        <?php
      }
     ?>
     <input type="hidden" name="cods_sistemas" value="<?php echo $cods_sistemas ?>">
    </tbody>
</table>

<button 
  type="button"
  onclick="actualizar_sistemas()"
  class="btn btn-green"
  >
  Actalizar
</button>

</form>


