<script>

function actualizar_riesgos(){
	codhistoria=$("#codhistoria").val();
	var dataString = $("#update_riesgos").serialize();
	
	dataString+="&codhistoria="+codhistoria+"&tabla=antecedentes";

	$.ajax({
		url: '<?php echo base_url() ?>index.php/historias/update_historia_riesgos/',
		type: 'post',
		data: dataString,
		async: false,
		success: function (data) {
		  load_data_form('factores','load_factores');
		  $("#dilog_show").dialog("close");
		},
		error: function(data){
		  alert("Error al actualizar el tipo de examen "+form);
		}
	});
  
}



</script>

<form id="update_riesgos">
	


<?php 
$primero=0;
$nombreriesgo="";
$cod_ries="";
foreach ($riesgos as  $datos) {
	$cod_ries=$cod_ries.$datos['codigo'].",";
	if($nombreriesgo!=$datos['nomriesgo']){
		if($primero!=0){
		?>
				</div>
			</div>
		</div>

		<div class="span4">
			<div class="box box-color">
				<div class="box-title">
					<h3>
						<?php echo $datos['nomriesgo'] ?>
					</h3>
				</div>
				<div class="box-content" data-height="180">
		<?php
		}else{
			$primero=1;
			?>
			<div class="span4">
				<div class="box box-color" >
					<div class="box-title">
						<h3>
							<?php echo $datos['nomriesgo'] ?>
						</h3>
					</div>
					<div class="box-content" data-height="180">
			<?php

		}

	}


?>
	<input type="checkbox" name="<?php echo "rie-".$datos['codigo'] ?>">
	<?php echo $datos['nombre'] ?></td>
	<br>


	
<?php
$nombreriesgo=$datos['nomriesgo'];
}

?>

<input type="hidden" value="<?php echo $cod_ries ?>" name="cod_riesgos" id="cod_riesgos">
</div>
</div>
</div>

<div class="span12">
<button 
	type="button" 
	class="btn"
	onclick="actualizar_riesgos()"
	>
	Guardar
</button>
</div>
</form>