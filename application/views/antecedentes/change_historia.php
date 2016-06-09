<script>

function actualizar_antecedentes(){
	codhistoria=$("#codhistoria").val();
	var dataString = $("#update_antecedentes").serialize();
	dataString+="&codhistoria="+codhistoria+"&tabla=antecedentes";

	$.ajax({
		url: '<?php echo base_url() ?>index.php/historias/update_historia/',
		type: 'post',
		data: dataString,
		async: false,
		success: function (data) {
		  load_data_form('antecedentes','load_antecedentes');
		  $("#dilog_show").dialog("close");
		},
		error: function(data){
		  alert("Error al actualizar el tipo de examen "+form);
		}
	});
  
}


</script>

<form  
	id="update_antecedentes"
	>

<?php 

$cont=0;
$cods_ant="";
$primera=0;
$tipo="";
foreach ($antecedentes as  $datos) {
	$cods_ant=$cods_ant.$datos['codigo'].",";
	if($tipo!=$datos['tipo']){
		if($primera==1){
			echo "</div></div></div></div>";

		}
		$primera=1;			
		?>

			<div class="span10">
				<div class="box box-color" >
					<div class="box-title">
						<h3>
							Antecedentes <?php echo $datos['tipo'] ?>
							
						</h3>
					</div>

					<div class="box-content" >


		<?php
		}
		$tipo=$datos['tipo'];
		
?>


<div class="span12">

	<?php echo $datos['nombre'] ?> 
	<?php if($datos['observacion']!="Niega"){
	?>	
		Si <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>" checked>
		No <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>" >
		<input type="text" name="txtant-<?php echo "".$datos['codigo'] ?>" class="input-medium" value="<?php echo "".$datos['observacion'] ?>">
	<?php
	}else{
		?>
		Si <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>">
		No <input type="radio" name="<?php echo "ant-".$datos['codigo'] ?>" checked>
		<input type="text" name="txtant-<?php echo "".$datos['codigo'] ?>" class="input-medium" value="Niega">

		<?php

	} ?>
	
</div>		




	
<?php
}
echo "</div></div></div></div>";

?>
<input type="hidden"  name="cod_antecedentes" value="<?php echo $cods_ant ?>">
<button 
	type="button"
	onclick="actualizar_antecedentes()"
	class="btn btn-green"
	>
	Actalizar
</button>
</form>