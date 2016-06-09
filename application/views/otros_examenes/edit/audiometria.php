<div class="span12">
<strong>Audiometrias</strong>

<table class="table table-hover table-nomargin table-bordered">
<tr>
<?php 
//var_dump($data);
$cont=0;
if($data!="")
foreach ($data as $datos) {
	if($cont==3){
		echo "</tr><tr>";
		$cont=0;
	}else{
		$cont++;
	}
?>

<td>
	<?php echo "  ".$datos['nombre']."  "; ?>
</td>
<td>
	<?php echo $datos['valor']."  "; ?>
</td>

<?php

}

 ?>
</tr>
</table>
	
</div>