<div class="container">
	
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Vista de impresion
				</h3>
			</div>
			<div class="box-content nopadding">


				<?php 

				foreach ($paciente as $data) {
					echo "Nombre :".$data['nombres']." ".$data['apellidos'];
				}

				echo "<br><br><br>";
				echo "Examenes realizados";
				foreach ($examenes_realizados as $data) {
					echo "".$data['nombre'].", ";
				}

				echo "<br><br><br>";
				echo "Concepto de actitud medica";
				foreach ($concepto_actitud_medica as $data) {
					echo "".$data['nombre'].", ";
				}


				 ?>


			</div>
		</div>
	</div>
</div>



</div>