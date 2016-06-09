<div class="span12">
	<div class="row-fluid">
		<div class="box">
			<div class="box box-color box-bordered magenta">
				<h3>

					Concepto de actitud medica ocupcional
				</h3>
		</div>
		<div class="box-content">
<script>


function sumarestaconcepto(obj){

	if($(obj).is(":checked")){
		concepto++;
	}else{
		concepto--;
	}
	//alert(concepto);
}
</script>

<?php 
$primero=0;
$cods_conceptoactitud="";
foreach ($concepto_actitud_medica_ocupcional as  $datos) {
$cods_conceptoactitud=$cods_conceptoactitud.$datos['codigo'].",";
?>
	<div class="span6">
	<input type="checkbox" onclick="sumarestaconcepto(this)" name="<?php echo "concepto-".$datos['codigo'] ?>" id="<?php echo "concepto-".$datos['codigo'] ?>">
	<?php echo $datos['nombre'] ?>
	</div>
	
<?php

}

?>

	<input type="hidden" name="cods_conceptoactitud" value="<?php echo $cods_conceptoactitud ?>">
        
      </div>
   </div>
 </div>
 </div>