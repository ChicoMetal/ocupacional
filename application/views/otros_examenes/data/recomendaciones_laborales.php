<script>


function sumarestarecomendacion(obj){

	if($(obj).is(":checked")){
		recomendaciones++;
	}else{
		recomendaciones--;
	}
	//alert(recomendaciones);
}
</script>
<div class="span12">
<h4><strong>Recomendaciones laborales</strong></h4>

<?php 
$primero=0;
$nombrerecomendaciones_laborales="";
$cod_recomendaciones="";
foreach ($recomendaciones_laborales as  $datos) {
	$cod_recomendaciones=$cod_recomendaciones.$datos['codigo'].",";
	if($nombrerecomendaciones_laborales!=$datos['nomrecomendaciones_laborales']){
		if($primero!=0){
		?>
				</div>
			</div>
		</div>

		<div class="span8">
			<div class="box box-color">
				<div class="box-title">
					<h3>
						<?php echo $datos['nomrecomendaciones_laborales'] ?>
					</h3>
				</div>
				<div class="box-content" data-height="180">
		<?php
		}else{
			$primero=1;
			?>
			<div class="span8">
				<div class="box box-color" >
					<div class="box-title">
						<h3>
							<?php echo $datos['nomrecomendaciones_laborales'] ?>
						</h3>
					</div>
					<div class="box-content" data-height="180">
			<?php

		}

	}


?>
	<input type="checkbox" onclick="sumarestarecomendacion(this)" name="<?php echo "recomlab-".$datos['codigo'] ?>" id="<?php echo "recomlab-".$datos['codigo'] ?>">
	<?php echo $datos['nombre'] ?></td>
	<br>


	
<?php
$nombrerecomendaciones_laborales=$datos['nomrecomendaciones_laborales'];
}

?>

<input type="hidden" value="<?php echo $cod_recomendaciones ?>" name="cod_recomendaciones">
</div>
</div>
</div>
</div>