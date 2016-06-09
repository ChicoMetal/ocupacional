<script>
  $(document).ready(function(){


  

    $("#btn-revision").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio de tipo de examen");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/revisiones/change_historia/',
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
<strong>Revision por sistema </strong>
<button 
  type="button"
  id="btn-revision"
  class="btn btn-magenta"
  >
  Cambiar
</button>
<table>
  <caption></caption>
  <thead>
    <tr>
      <th>Antecedentes</th>
      <td>Observacion</td>
      <td></td>
    </tr>
  </thead>
  <tbody>
    
<?php 
if($data!="")
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