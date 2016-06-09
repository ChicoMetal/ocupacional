

<?php 
$primero=0;
$nombreriesgo="";
foreach ($riesgos as  $datos) {
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
</div>
</div>
</div>
