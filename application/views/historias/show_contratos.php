
<?php 
$header=0;
if($contrato!=""){
foreach ($contrato as $data) {

	if($header==0){
		$header=1;
		?>

		<div class="row-fluid">
			<div class="span12">
				<div class="box box-color box-bordered green">
					<div class="box-title">
						<h3>
							<i class="icon-table"></i>
							Actividates Contratadas
						</h3>
					</div>
					<div class="box-content nopadding">
						<!--class="table table-hover table-nomargin dataTable dataTable-tools table-bordered"-->
						<table  class="table table-hover table-nomargin table-striped dataTable-tools dataTable dataTable-reorder">
							<thead>
								<tr>
									<th colspan="9">Actividades Contratadas</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2">
										Nombre o Razón Social:
									</td>
									<td colspan="4">
										 <?php echo $data['razonsocial'] ?>
									</td>
									<td>
										Nit:
									</td>
									<td colspan="3">
										 <?php echo $data['nit'] ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										Domicilio Principal:

									</td>
									<td colspan="3">
										<?php echo $data['direccion'] ?>

									</td>
									<td colspan="2">
										Fecha:
									</td>
									<td colspan="2">
										<?php echo $data['fecha'] ?>
									</td>


								</tr>
								<tr>
									<td>
										Departamento:
									</td>
									<td colspan="2" >
										<?php echo $data['departamento'] ?>
									</td>
									<td>
										Ciudad:
									</td>
									<td colspan="2">
										<?php echo $data['ciudad'] ?>
									</td>

									<td>
										Telefono:
									</td>
									<td colspan="2">
										<?php echo $data['telefono'] ?>.
									</td>


								</tr>
								<tr>
									<td colspan="9"></td>
								</tr>
								<tr>
									<td colspan="9" class="center">
										Actividades Contratadas:
									</td>
								</tr>
								<tr>
									<td colspan="9"></td>
								</tr>




		<?php

	}



?>

	<tr>
		<td colspan="6">
			<?php echo $data['nombre'] ?>.  
			<?php echo $data['descripcion'] ?>
		</td>

		<td colspan="3">
			<?php echo $data['valor'] ?>

		</td>

	</tr>



	
				
<?php
}	
}else{

?>
<div class="row-fluid">
			<div class="span12">
				<div class="box box-color box-bordered green">
					<div class="box-title">
						<h3>
							<i class="icon-table"></i>
							Actividates Contratadas
						</h3>
					</div>
					<div class="box-content nopadding">
						<table  class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
							<thead>
								<tr>
									<th colspan="9">No tiene actividades Contratadas</th>
								</tr>
							</thead>
							<tbody>

<?php

}
	
 ?>
 					</tbody>
 				</table>
			</div>
		</div>
	</div>
</div>



