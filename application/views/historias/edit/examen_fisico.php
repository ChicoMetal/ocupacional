<script>
  $(document).ready(function(){


  

    $("#btn-examen").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio de tipo de examen");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/examen_fisico/change_historia/',
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

<div class="span12">
<strong>Examen fisico</strong>

<button 
  type="button"
  id="btn-examen"
  class="btn btn-magenta"
  >
  Cambiar
</button>

<table>
  <caption></caption>
  <thead>
    <tr>
      <th>Nombre</th>
      <td>Observacion</td>
      <td></td>
    </tr>
  </thead>
  <tbody>
    
<?php 
//var_dump($data);
foreach ($data as $datos) {
  
?>
<tr>
  <td><?php echo $datos['nombre']?></td>
  <td><?php echo $datos['observacion']?></td>

</tr>


<?php

}

 ?>

  </tbody>
</table>
</div>