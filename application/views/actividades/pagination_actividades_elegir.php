<script>
	function habilitar_text(campo){
		if($("#ch-"+campo).is(":checked")){
			$("#tx-"+campo).removeAttr("disabled");
			$("#codigo-act-"+campo).removeAttr("disabled");
			$("#ch-"+campo).closest("tr").css("background","#D3E9D3" );
			contcontratos++;
		}else{
			
			$("#codigo-act-"+campo).attr("disabled","");
			$("#ch-"+campo).closest("tr").css("background","#fff");
			contcontratos--;
		}


	}


</script>


<div class="row-fluid">


	<div class="span12">

	


		<table class="table bordered">
			<caption>Seleccione Actividades a contratar</caption>
			<thead>
				<tr>
					<th>Contrarar</th>
					<th>Nombre/Descripción</th>
					<th>Valor</th>
				</tr>
			</thead>
			<tbody>



<?php 
$cods_acts="";

if($actividades)
foreach ($actividades as $data) {
$cods_acts=$cods_acts. $data["codigo"].",";
	?>

			
		<input 
			type="hidden" 
			name="codigo-act-<?php echo $data["codigo"] ?>"  
			id="codigo-act-<?php echo $data["codigo"] ?>"  
			value="<?php echo $data["codigo"] ?>" 
			disabled=""
			>
			<tr class="trchange">
				
				<td> 
					<input 
						type="checkbox" 
						name="ch-<?php echo $data["codigo"] ?>" 
						id="ch-<?php echo $data["codigo"] ?>" 
						onclick="habilitar_text('<?php echo $data["codigo"] ?>')"
					> 
				</td>
				<td class="span8">
					<?php echo $data["nombre"] ?>
					<?php echo $data["descripcion"] ?>
				</td>
				<td class="span4">
					<div class="input-append">
							<input 
							type="text" 
							id="<?php echo 'tx-'.$data["codigo"] ?>"  
							name="<?php echo 'tx-'.$data["codigo"] ?>"  
							value="<?php echo $data["valor"] ?>" 
							data-rule-required="true"
							data-rule-number="true"
							disabled=""
						>							
						<span class="add-on">$</span>
					</div>
					
					
				</td>
			</tr>
		
		

		

	<?php
}



 ?>
<input type="hidden" name="cods_acts" value="<?php echo $cods_acts ?>" >
		</tbody>
		</table>

	</div>
</div>
	
</form>



	