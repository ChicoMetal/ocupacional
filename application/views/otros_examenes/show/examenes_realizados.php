<div class="span12">
	<div class="row-fluid">
		<div class="box">
			<div class="box box-color box-bordered magenta">
				<h3>

					Examenes Realizados
				</h3>
		</div>
		<div class="box-content">


<?php 
$primero=0;
$cods_examrealizados="";
foreach ($examenes_realizados as  $datos) {
$cods_examrealizados=$cods_examrealizados.$datos['codigo'].",";
?>
	<div class="span3">
	<input type="checkbox" name="<?php echo "examre-".$datos['codigo'] ?>">
	<?php echo $datos['nombre'] ?>
	</div>
	
<?php

}

?>

<input type="hidden" name="cods_examrealizados" value="<?php echo $cods_examrealizados ?>">
        
      </div>
   </div>
 </div>
 </div>