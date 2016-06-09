<script>
$(document).ready(function() {
	$("#cancelar_orden").validate({
		submitHandler: function(form){
			cancelar_orden()
		}
    });


});

function cancelar_orden(){
	var codigo=$("#codigo").val()
	if(codigo==""){
		$.gritter.add({
			title: 'Error',
			text: 'Debe digitar un codigo',
		});
	}else{
		dataString="codigo="+codigo;

		$.ajax({
			type: "POST",
			url:"<?php echo base_url() ?>index.php/ordenes/cancelar_orden",
			data: dataString,
			success: function(data){
				$.gritter.add({
					title: 'Orden',
					text: 'Cancelada correctamente',
				});	
				$("#codigo").val("");
			},
			error: function(data){
			
			}

		});
	}
}
</script>



<div class="container">
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3>
					<i class="icon-bar-chart"></i>
					Cancelar orden
				</h3>
			</div>
			<div class="box-content">

				<div class="span12">
					<label for="texto">
						Digite el numero de la orden que desea cancelar

					</label>
					<form  method="post" id="cancelar_orden">
					
						<input 
							type="text" 
							name="codigo" 
							id="codigo" 
							value="" 
							data-rule-number="true"
							data-rule-required="true"
							placeholder="">
							<br>
							<button 
								type="submit"
								
								class="btn btn-info"
								>
								Cancelar
							</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>