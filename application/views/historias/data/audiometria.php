<script type="text/javascript">
	$(document).ready(function() {
		$("#fechacalibracion").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      yearRange: "1900:2013",
	       dateFormat: "yy/mm/dd",
	    });
	});

</script>

<?php 
$primero=0;
$nombreaudiometria="";
$cods_audiometria="";
foreach ($audiometrias as  $datos) {
	$cods_audiometria=$cods_audiometria.$datos['codigo'].",";
	if($nombreaudiometria!=$datos['nomaudiometria']){
		if($primero!=0){
		?>
				</div>
			</div>
		</div>

		<div class="span8">
			<div class="box box-color">
				<div class="box-title">
					<h3>
						<?php echo $datos['nomaudiometria'] ?>
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
							<?php echo $datos['nomaudiometria'] ?>
						</h3>
					</div>
					<div class="box-content" data-height="180">
			<?php

		}

	}


?>
	
	<div class="span12">
		<div class="control-group">
			<label for="textfield" class="control-label"><?php echo $datos['nombre'] ?></label>
			<div class="controls">
				Si
				<input type="radio" value="si" name="<?php echo "aud-".$datos['codigo'] ?>">
				No
				<input type="radio" value="no" checked name="<?php echo "aud-".$datos['codigo'] ?>">


			</div>
		</div>
	</div>

	
	
</td>
	<br>


	
<?php
$nombreaudiometria=$datos['nomaudiometria'];
}

?>
</div>
</div>
</div>

<br>


<div class="span12">
	<div class="box box-color" >
		<div class="box-title">
			<h3>
				
			</h3>
		</div>
		<div class="box-content" data-height="180">
			a. ¿Estuvo expuesto a ruidos antes del examen?
			<br>
			si <input type="radio" name="exposicionruido" value="si">
			No <input type="radio" name="exposicionruido" value="no">
			<br>
			b. ¿Por cual oido escucha mejor?
			<br>
			Izquierdo <input type="radio" name="oidomejor" value="izquierdo">
			Derecho <input type="radio" name="oidomejor" value="derecho">
			Igual <input type="radio" name="oidomejor" value="igual">
		</div>
	</div>	
<table class="table">
	<thead>
		<tr>
			<td>Oido/HZ</td>
			<td>500</td>
			<td>1000</td>
			<td>2000</td>
			<td>3000</td>
			<td>4000</td>
			<td>6000</td>
			<td>8000</td>

		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Derecho</td>
			<td><input type="text" class="input-small" name="ad500" ></td>
			<td><input type="text" class="input-small" name="ad1000"></td>
			<td><input type="text" class="input-small" name="ad2000"></td>
			<td><input type="text" class="input-small" name="ad3000"></td>
			<td><input type="text" class="input-small" name="ad4000"></td>
			<td><input type="text" class="input-small" name="ad6000"></td>
			<td><input type="text" class="input-small" name="ad8000"></td>

		</tr>
		<tr>
			<td>Izquierdo</td>
			<td><input type="text" class="input-small" name="ai500" ></td>
			<td><input type="text" class="input-small" name="ai1000"></td>
			<td><input type="text" class="input-small" name="ai2000"></td>
			<td><input type="text" class="input-small" name="ai3000"></td>
			<td><input type="text" class="input-small" name="ai4000"></td>
			<td><input type="text" class="input-small" name="ai6000"></td>
			<td><input type="text" class="input-small" name="ai8000"></td>

		</tr>
		<tr>

			<td>Hallazgo</td>
			<td colspan="7"><textarea name="hallazgo"></textarea></td>
		</tr>
		<tr>
			<td>
				Equipo
			</td>
			<td colspan="3">
				<input type="text" name="equipo-auio">
			</td>
			<td>
				Fecha de calibración
			</td>
			<td colspan="3">
				<input type="text" name="fechacalibracion" id="fechacalibracion">
			</td>

		</tr>
		<tr>


		</tr>

	</tbody>
	

</table>


</div>




<div class="span12">
	<div class="box box-color" >
		<div class="box-title">
			<h3>
				Interpretación
			</h3>
		</div>
		<div class="box-content" data-height="180">
			<div class="span5">
				Estudio audiométrico normal
			</div>
			<div class="span5">
				<input 
					type="radio" 
					name="interpretacion" 
					value="Estudio audiométrico normal" 
					>
			</div>
			<div class="span5">
				Larsen modificado grado I
			</div>
			<div class="span5">
				<input 
					type="radio" 
					name="interpretacion" 
					value="Larsen modificado grado I" 
					>
			</div>
			<div class="span5">
				Larsen modificado grado II
			</div>
			<div class="span5">
				<input 
					type="radio" 
					name="interpretacion" 
					value="Larsen modificado grado II" 
					>
			</div>
			<div class="span5">
				Larsen modificado grado III
			</div>
			<div class="span5">
				<input 
					type="radio" 
					name="interpretacion" 
					value="Larsen modificado grado III" 
					>
			</div>

		</div>
	</div>
</div>


<div class="span12">
	<div class="box box-color" >
		<div class="box-title">
			<h3>
				Sugerencias
			</h3>
		</div>
		<div class="box-content" data-height="180">
			<?php 
				$cod_sugerencias="";
				foreach ($sugerencias as $data) {
					$cod_sugerencias=$cod_sugerencias.$data['codigo'].",";
					?>
					<div class="span5">
						<?php echo $data['nombre']  ?>
					</div>
					<div class="span5">
						<input 
							type="checkbox" 
							name="audiosuger-<?php echo $data['codigo']  ?>" 
							id="audiosuger-<?php echo $data['codigo']  ?>" 
							value="<?php echo $data['codigo']  ?>" 
							>
							<br>
					 </div> 

					<?php
				}

			 ?>
		</div>
	</div>	

</div>









<input type="hidden" name="cods_audiometria" value="<?php echo $cods_audiometria ?>">
<input type="hidden" name="cod_sugerencias" value="<?php echo $cod_sugerencias ?>">