<style type="text/css" media="screen">
	table tr{
		cursor: pointer;
	}
</style>
<table class="table">
	
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Fecha</th>
			<th>Valor</th>
		</tr>
	</thead>
	<tbody>
	
<?php 
foreach ($facturas as $data) {
?>
<tr onclick="opendialogfactura('<?php echo $data['codigo'] ?>')">
	<td>
		<?php echo $data['codigo'] ?>
	</td>
	<td>
		<?php echo $data['fecha'] ?>
	</td>

	<td>
		<?php echo $data['valortotal'] ?>
	</td>


</tr>
<?php
}


?>
</tbody>
</table>
