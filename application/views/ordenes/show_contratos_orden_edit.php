<script type="text/javascript">
$("#agregar_actividad").click(function(){
		$("#dilog_actividades").dialog("open");
		
});

function desabilitar(boton){
	$(boton).attr("diseable");

}
function habilitar_text(campo){
	

	
	if($("#ch-"+campo).is(":checked")){
		$("#ca-"+campo).removeAttr("disabled");
			
		contcontratos++;
	}else{
		
		$("#codigo-act-"+campo).attr("disabled","");
		$("#ca-"+campo).closest("tr").css("background","#fff");
		contcontratos--;
	}

	obligatoria=$("#historia_obligatoria-"+campo).val();
	
	if(obligatoria=="si" && $("#soloexamenes").val()=="si"){
		
		$("#ch-"+campo).attr('checked', false);	
		contcontratos--;
		$.gritter.add({
			title: 'Historia obligatoria',
			text: 'Con este examen es obligatoria la historia! <br>Si desea seleccionarla cambie a Realizar toda la historia',
			
		});
	}
	//);
	



}




</script>


<?php 
$header=0;
$cods_acts="";
if($contrato!=""){
foreach ($contrato as $data) {
$cods_acts=$cods_acts.$data["codactividad"].",";
	if($header==0){
		$header=1;
		?>

		<input 
			type="hidden" 
			value="<?php echo $data['codcontrato']  ?>" 
			id="codcontrato"
			>
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
		<td colspan="8">
			<?php echo $data['nombre'] ?>.  
			<?php echo $data['descripcion'] ?>
		</td>

		
		<td>
			<input 
				type="hidden" 
				name="ca-<?php echo $data["codactividad"] ?>" 
				id="ca-<?php echo $data["codactividad"] ?>" 
				value="<?php echo $data["codactividad"] ?>"
				disabled="disabled"
			> 

			<input 
				type="checkbox" 
				name="ch-<?php echo $data["codactividad"] ?>" 
				id="ch-<?php echo $data["codactividad"] ?>" 
				onclick="habilitar_text('<?php echo $data["codactividad"] ?>')"
			> 

			<input 
				type="hidden" 
				name="historia_obligatoria-<?php echo $data["codactividad"] ?>" 
				id="historia_obligatoria-<?php echo $data["codactividad"] ?>" 
				value="<?php echo $data["historia_obligatoria"] ?>"
				class="input-medium"
			>

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
<br>
<input type="hidden" name="cods_acts" id="cods_acts" value="<?php echo $cods_acts ?>">

<button type="submit"  class="btn  btn-satgreen" id="guardar_orden"  onclick="desabilitar(this)">Actualizar orden</button>
<br>




