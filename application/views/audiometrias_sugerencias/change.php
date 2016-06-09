<script>
  $(document).ready(function(){
  	$("#update_examen").click(function(){

  		if(confirm("Desea cambiar el tipo de examen")){
  			codigo=$("input[name='tipoexamen']:checked").val();
  			if(codigo){
  				update(codigo);
  			}else{
  				alert("no hizo nunguna eleccion");

  			}
  			
  		}
  		
  	});


  });
function update(codigo){
	codhistoria=$("#codhistoria").val();
	var dataString="codigo="+codigo+"&codhistoria="+codhistoria;
	$.ajax({
	url: '<?php echo base_url() ?>index.php/tipo_examenes/update_historia/',
	type: 'post',
	data: dataString,
	async: false,
	success: function (data) {
	  load_data_form('tipo','load_tipo');
	  $("#dilog_show").dialog("close");
	},
	error: function(data){
	  alert("Error al actualizar el tipo de examen "+form);
	}
	});
  
}

</script>

<form>
	

<?php 

foreach ($tipo_examenes as $datos) {
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
      > 
    </div>
  </div>

	<?php
}


 ?>
 <button 
 	type="button"
 	id="update_examen"
 	class="btn btn-darkblue"
 >
 Cambiar
 </button>


</form>
