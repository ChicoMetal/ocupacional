<script type="text/javascript">
$("#agregar_actividad").click(function(){
		$("#dilog_actividades").dialog("open");
		
});

function editar_valor(actividad,valor){
		
	var codcontrato= $("#codcontrato").val();
	$("#nuevo_valor").val(valor);
	$("#cod_actividad").val(actividad);
	
	$("#dilog_edit_valores").dialog("open");
//alert($("#nuevo_valor").val());
}

function eliminar_detalle(actividad){
	var codcontrato= $("#codcontrato").val();
	if(confirm("Desea eliminar esta actividad?")){
		dataString="codcontrato="+codcontrato+"&actividad="+actividad;
		$.ajax({
			type: "POST",
		    url:"<?php echo base_url() ?>index.php/actividades/eliminar_actividad_contratada",
		    data: dataString,
		    success: function(data){

                search_contratos();
		  			
		  		
		    },
		    error: function(data){

		 
		    }

		});


	}
	
	

}


</script>


<?php 
$header=0;
if($contrato!=""){
foreach ($contrato as $data) {

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
										Fecha Final: <input class="input-medium"  type="text" value="<?php echo $data['fecha'] ?>" />
									</td>
									<td colspan="2">
                                        Finaliza: <input class="input-medium" type="text" value="<?php echo $data['fechafinal'] ?>" name="fecha_contrato" id="fecha_contrato" />

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

		<td>
			<?php echo $data['valor'] ?>

		</td>

		<td>
			<button 
				class="btn btn-small btn-warning"
				onClick="editar_valor('<?php echo $data['codactividad'];  ?>','<?php echo $data['valor'] ?>')"
				>
				<i class="icon-edit"></i> 
				Editar
			</button>
			
		</td>

		<td>
			<button 
				class="btn btn-small btn-inverse"
				onClick="eliminar_detalle('<?php echo $data['codactividad'];  ?>')"
				>
				<i class="icon-trash"></i>Eliminar
			</button>
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
<button class="btn  btn-satgreen" id="agregar_actividad">+ Agregar actividad</button>
<br>




<script>
    var fecha = new Date();
    var anio = fecha.getFullYear()+50;

    $(document).ready(function(){

        $("#fecha_contrato" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:"+anio,
            dateFormat: "yy/mm/dd"
        });



        $("#fecha_contrato").change(function(){
           actualizarFehcaContrato();
        })

    })

    function actualizarFehcaContrato(){
        fecha= $("#fecha_contrato").val();
        contrato=$("#codcontrato").val();
        dataString="fecha="+fecha+"&contrato="+contrato;
        $.ajax({
            type: "POST",
            url:"<?php echo base_url() ?>index.php/actividades/actualizar_fecha_contrato",
            data: dataString,
            async: false,
            success: function(data){

                if(data=="si"){



                }else if(data=="no"){

                }

            },
            error: function(data){

                $.gritter.add({
                    title: 'Error',
                    text: 'Ocurrio un error en la actualizacion',
                });

            }

        });


    }

</script>



