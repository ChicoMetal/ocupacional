<script>
	var contcontratos=0;
	$(document).ready(function(){

	$("#form_contratar_nuevo").validate({
		submitHandler: function(form){
			
			
			if(contcontratos>0){
				var codcontrato=$("#codcontrato").val();
				var anio=$("#fecha").val();
				var dataString = $(form).serialize();
					dataString=dataString+"&codcontrato="+codcontrato;
		          $.ajax({
	            	type: "POST",
	                url:"<?php echo base_url() ?>index.php/actividades/contratar_nueva",
	                data: dataString,
	                success: function(data){
	              		if(data=="no"){

	              		}else{
	              			$("#dilog_actividades").dialog("close");
	              			
	              			changetext();
	              			
	              		}
	                },
	                error: function(data){

	             
	                }

	            });

			}else{
				alert("debe elegir al menos una actividad a contratar");

			}
			
        }
    });

	 



	});


	function habilitar_text(campo){
		if($("#ch-"+campo).is(":checked")){
			if(!validar_atividad(campo)){
				$("#tx-"+campo).removeAttr("disabled");
				$("#codigo-act-"+campo).removeAttr("disabled");
				$("#ch-"+campo).closest("tr").css("background","#D3E9D3" );
				contcontratos++;

			}else{
				$.gritter.add({
					title: 'Error',
					text: 'La actidad ya existe no puede elegirla',
				});
				$("#ch-"+campo).removeAttr("checked");

				
			}
			
		}else{
			
			$("#codigo-act-"+campo).attr("disabled","");
			$("#ch-"+campo).closest("tr").css("background","#fff");
			contcontratos--;
		}


	}

	function validar_atividad(campo){

		var codempresa=$("#codempresa").val();
		var dataString="codactividad="+campo+"&codempresa="+codempresa;
		var existe=false;
		$.ajax({
				url: '<?php echo base_url() ?>index.php/actividades/existe_actividad_ajax/',
				type: 'post',
				data: dataString,
				async: false,
				success: function (data) {
					
					if(data=="si"){
						existe=true;
					}
				}
			});
		return existe;

	}
</script>


<form id="form_contratar_nuevo">


<div class="row-fluid">
	<div class="span12">
	
		
	</div>

	<div class="span12">

	


		<table class="table bordered">
			<caption>Seleccione Actividades a contratar</caption>
			<thead>
				<tr>
					<th>Contrarar</th>
					<th>Nombre/Descripción</th>
					<th>Valor</th>
				</tr>
			</thead>
			<tbody>



<?php 
$cods_acts="";

if($actividades)
foreach ($actividades as $data) {
$cods_acts=$cods_acts. $data["codigo"].",";
	?>

			
		<input 
			type="hidden" 
			name="codigo-act-<?php echo $data["codigo"] ?>"  
			id="codigo-act-<?php echo $data["codigo"] ?>"  
			value="<?php echo $data["codigo"] ?>" 
			disabled=""
			>
			<tr class="trchange">
				
				<td> 
					<input 
						type="checkbox" 
						name="ch-<?php echo $data["codigo"] ?>" 
						id="ch-<?php echo $data["codigo"] ?>" 
						onclick="habilitar_text('<?php echo $data["codigo"] ?>')"
					> 
				</td>
				<td class="span8">
					<?php echo $data["nombre"] ?>
					<?php echo $data["descripcion"] ?>
				</td>
				<td class="span4">
					
					
						<input 
							type="text" 
							id="<?php echo 'tx-'.$data["codigo"] ?>"  
							name="<?php echo 'tx-'.$data["codigo"] ?>"  
							value="<?php echo $data["valor"] ?>" 
							data-rule-required="true"
							data-rule-number="true"
							disabled=""
						>	

						
					
				</td>
			</tr>
		
		

		

	<?php
}



 ?>
<input type="hidden" name="cods_acts" value="<?php echo $cods_acts ?>" >
		</tbody>
		</table>

	</div>
</div>



</form>



