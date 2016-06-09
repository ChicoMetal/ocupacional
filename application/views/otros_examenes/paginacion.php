

<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Actividades
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
					<thead>
					
						<tr>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Valor</th>
							
						</tr>
					</thead>
					

					<tbody>
					<?php 
					if($actividades)
					foreach ($actividades as $data) {
						?>
							<tr>
								<td><?php echo $data["codigo"] ?></td>
								<td><?php echo $data["nombre"] ?></td>
								<td><?php echo $data["descripcion"] ?></td>
								<td><?php echo $data["valor"] ?></td>
							

							</tr>


						<?php
					}

					 ?>

					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>