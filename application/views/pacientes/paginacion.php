

<div class="row-fluid">
					<div class="span12">
						<div class="box box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									Empresas
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
									<thead>
									
										<tr>
											<th>Codigo</th>
											<th>Nit</th>
											<th>Razon Social</th>
											<th>Dirección</th>
											<th>Teléfono</th>
										</tr>
									</thead>
									

<tbody>
<?php 
if($empresas)
foreach ($empresas as $data) {
	?>
		<tr>
			<td><?php echo $data["codigo"] ?></td>
			<td><?php echo $data["nit"] ?></td>
			<td><?php echo $data["razonsocial"] ?></td>
			<td><?php echo $data["direccion"] ?></td>
			<td><?php echo $data["telefono"] ?></td>

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