<?php 

foreach ($audiometria_grafica as $data) {
	
 ?>
<div class="span12">
	<div class="box box-color" >
		<div class="box-title">
			<h3>
				
			</h3>
		</div>
		<div class="box-content" data-height="180">
			a. ¿Estuvo expuesto a ruidos antes del examen?
			<br>
				<?php echo $data["exposicionruido"] ?>
			<br>
			b. ¿Por cual oido escucha mejor?
			<br>
				<?php echo $data["oidomejor"] ?>
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
			<td><input type="text" class="input-small" name="ad500" value="<?php echo $data['ad500'] ?>" readonly ></td>
			<td><input type="text" class="input-small" name="ad1000" value="<?php echo $data['ad1000'] ?>" readonly></td>
			<td><input type="text" class="input-small" name="ad2000" value="<?php echo $data['ad2000'] ?>" readonly></td>
			<td><input type="text" class="input-small" name="ad3000" value="<?php echo $data['ad3000'] ?>" readonly></td>
			<td><input type="text" class="input-small" name="ad4000" value="<?php echo $data['ad4000'] ?>" readonly></td>
			<td><input type="text" class="input-small" name="ad6000" value="<?php echo $data['ad6000'] ?>" readonly></td>
			<td><input type="text" class="input-small" name="ad8000" value="<?php echo $data['ad8000'] ?>" readonly></td>

		</tr>
		<tr>
			<td>Izquierdo</td>
			<td><input type="text" class="input-small" name="ai500" value="<?php echo $data['ai500'] ?>" ></td>
			<td><input type="text" class="input-small" name="ai1000" value="<?php echo $data['ai1000'] ?>"></td>
			<td><input type="text" class="input-small" name="ai2000" value="<?php echo $data['ai2000'] ?>"></td>
			<td><input type="text" class="input-small" name="ai3000" value="<?php echo $data['ai3000'] ?>"></td>
			<td><input type="text" class="input-small" name="ai4000" value="<?php echo $data['ai4000'] ?>"></td>
			<td><input type="text" class="input-small" name="ai6000" value="<?php echo $data['ai6000'] ?>"></td>
			<td><input type="text" class="input-small" name="ai8000" value="<?php echo $data['ai8000'] ?>"></td>

		</tr>
		<tr>

			<td>Hallazgo</td>
			<td colspan="7"><textarea name="hallazgo" readonly><?php echo $data['hallazgo'] ?></textarea></td>
		</tr>
		<tr>
			<td colspan="1" rowspan="" headers="">
				Interpretacion 
			</td>
			<td colspan="7" rowspan="" headers="">
				<?php echo $data['interpretacion'] ?>
			</td>
		</tr>
		
		<tr>
			<td>
				Equipo
			</td>
			<td colspan="3">
				<input type="text" name="equipo-auio" value="<?php echo $data['equipo'] ?>" readonly>
			</td>
			<td>
				Fecha de calibración
			</td>
			<td colspan="3">
				<input type="text" name="fechacalibracion" id="fechacalibracion" value="<?php echo $data['fechacalibracion'] ?>" readonly>
			</td>

		</tr>
		<tr>


		</tr>

	</tbody>
	

</table>


<?php 

}
 ?>

