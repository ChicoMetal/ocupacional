<?php 
$nombre="";
$primero=0;
$cods_exasm_alto="";
foreach ($examen as $data) {
	$cods_exasm_alto=$cods_exasm_alto.$data['codigo'].",";
	if($nombre!=$data['nombre']){
		if($primero!=0){
			?>
			</tbody>
			</table class="table">
			<table>
				<thead>
					<th colspan="3"><?php echo $data['nombre'] ?></th>
				</thead>
				<tbody>
			<?php

		}else{
			?>
			<table  class="table">
				<thead>
					<th colspan="3"><?php echo $data['nombre'] ?></th>
				</thead>
				<tbody>

				


			<?php
		}

	}

	?>
		<tr>
			<td><?php echo $data['pregunta'] ?></td>
			<td>
				<?php 
				if($data['tipo']=="text"){
					?>
						<input 
							type="text" 
							name="<?php echo 'examar-'.$data['codigo'] ?>"
							id="<?php echo 'examar-'.$data['codigo'] ?>"
							placeholder="<?php echo $data['predeterminado'] ?>"
						>

					<?php

				}else if($data['tipo']=="radio"){
					$radioval=explode(",",$data['predeterminado']);
					foreach ($radioval as $radio) {
						?>
							
							<?php echo $radio ?>
							<input 
								type="radio" 
								name="<?php echo 'examar-'.$data['codigo'] ?>"
								id="<?php echo 'examar-'.$data['codigo'] ?>"
								value="<?php echo $radio ?>"
								>

						<?php
					}
				}else if($data['tipo']=="select"){
					$selectval=explode(",",$data['predeterminado']);
					?>
						<select 
							name="<?php echo 'examar-'.$data['codigo'] ?>"
							id="<?php echo 'examar-'.$data['codigo'] ?>"
						>
						
					<?php
					foreach ($radioval as $select) {
						?>
							<option value="<?php echo $radio ?>"><?php echo $radio ?> </option>
						<?php
					}
					?>
					</select>
					<?php
				}

				 ?>
			</td>
			<td>
				<?php 
					if($data['observacion']=="si"){
						?>
							<input
								type="text"	
								name="<?php echo 'obsex-'.$data['codigo'] ?>"
								placeholder="Sin datos deimportancia"
							>
						<?php
					}
				 ?>
			</td>
		</tr>

<?php

$nombre=$data['nombre'];
}



 ?>
<input type="hidden" name="cods_exasm_alto" value="<?php echo $cods_exasm_alto ?>">