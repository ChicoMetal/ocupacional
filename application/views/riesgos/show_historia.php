

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

		<div class="span8">
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
			<div class="span8">
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

<input type="hidden" value="<?php echo $cod_ries ?>" name="cod_riesgos">
</div>
</div>
</div>
