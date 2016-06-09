
<div class="box-content nopadding">
	<table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
		<thead>
		
			<tr>
				<th>Empresa</th>
				<th>Usuario</th>
				
				<th>Contraseña</th>
			

				
			</tr>
		</thead>
		

		<tbody>
		<?php 
		if($empresas)
		foreach ($empresas as $data) {
			?>
				<tr >
					<td><?php echo $data["razonsocial"] ?></td>
					<td><?php echo $data["nit"] ?></td>
					
					<td><?php echo $data["clave"] ?></td>
					
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