
<script type="text/javascript">
nombre="";
estado="";
cantidad=30;
$(document).ready(function(){
	buscaractividadesdelaempresa();
function buscaractividadesdelaempresa(){
	dataString="";
	$.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/diagnosticos/buscar_actividadesdelaempresa",
            data: dataString,
            dataType: 'json',
            success: function(data){
            	var select="<select name='codactdelaempresa'  id='codactdelaempresa' onchange='load_diagnosticos_search()' class='input-xxlarge'>"
				select+="<option value=''>Elija un examen </option>";
				$.each(data, function(index){
					select+="<option value='"+data[index].codigo+"'>";
					select+=data[index].nombre;
					select+="</option>";

				});

				select+="</select>";
				$("#load_examenes").html(select);

				load_diagnosticos_search();
            },
            error: function(data){
            	
            }

        });

}


	$("#dilog_show").dialog({

   	 		modal: true,
            autoOpen: false,
            height: 460,
            width: 800,
             resizable: false 
    });

   	



	
	
	
	$("#form_diagnosticos").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/diagnosticos/guardar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
						title: 'diagnosticos',
						text: 'La diagnostico ha sido guardado correctamente!',
						
					});
					//$("#form_diagnosticos").each (function(){ this.reset()});
					$("#nombre").val("");
					$("#codigo_internacional").val("");
					load_diagnosticos_search();
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al guardar la diagnostico',
					});

                }

            });
        }
    });

	 


  });

	function load_diagnosticos_search(){

		nombre 		=$("#nombre_search").val();
		codactividad=$("#codactdelaempresa").val();
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
	
		$("#load_diagnosticos").children().remove();
			dataString="&nombre="+nombre
						+"&codactividad="+codactividad
						+"&estado="+estado
						+"&cantidad_res="+cantidad;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/diagnosticos/mostrar_ajax",
            data: dataString,
            success: function(data){
        		$("#load_diagnosticos").append(data);
            },
            error: function(data){
            	$("#load_diagnosticos").html(data);
            }

        });


	}



</script>



<div class="container" >


  



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered green">
			<div class="box-title">
				<h3><i class="icon-list"></i> Administracion de diagnosticos</h3>
			</div>
			<div class="box-content nopadding">
				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_diagnosticos"
					name="form_diagnosticos"
					>

					<div class="span12">
						<div class="control-group">
							<label for="textfield" class="control-label">Examen</label>
							<div class="controls">
								<div id="load_examenes">
								</div>	


							</div>
						</div>


					</div>
					<div class="span6">
						
						
						<div class="control-group">
							<label for="textfield" class="control-label">Nombre</label>
							<div class="controls">
								<input 
									type="text" 
									name="nombre" 
									id="nombre" 
									placeholder="Nombre del diagnostico" 
									class="input-xlarge"
									value="<?php echo set_value('nombre') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>


		
					</div>

					
						<div class="control-group">
							<label for="textfield" class="control-label">Codigo internacional</label>
							<div class="controls">
								<input 
									type="text" 
									name="codigo_internacional" 
									id="codigo_internacional" 
									placeholder="Codigo internacional" 
									class="input-xlarge"
									value="<?php echo set_value('codigo_internacional') ?>"
									
									data-rule-maxlength="20"
									>
							</div>
						</div>

					
					<div class="span12">
						<div class="form-actions">
							<input  
								type="submit" 
								class="btn btn-satblue" 
								id="guardar"  value="Guardar">
							<button type="reset" class="btn">Limpiar</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>




<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered lightred">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					diagnosticos
				</h3>

			</div>
			<br>
	<div class="control-group">
	Nombre
	<input 
		type="text" 
		name="nombre_search" 
		id="nombre_search"
		class="input-small"

	>
	
	Estado
	<select
		name="estado_search" 
		id="estado_search"
		class="input-medium"
		>
		
		<option  value="activo"> Activo </option>
		<option  value="inactivo"> Inactivo </option>
		<option  value=""> Todos </option>
	</select>
	Mostrar
	<select 
		id="cantidad_res"
		class="select2-container input-medium"
	>
		<option value="30">30</option>
		<option value="50">50</option>
		<option value="100">100</option>

	</select>

	<button 
		type="button"
		
		onclick="load_diagnosticos_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_diagnosticos">


				
</div>

</div>
</div>

<div id="dilog_show" title="Editar diagnosticos">
	<div class="box box-bordered">
		<div class="box-title">
			<h3>
	
			</h3>
			
		</div>
		<div class="box-content">
			<div class="tab-content">
				
				<div id="load_edit_diagnosticos">
				</div>

			</div>
		</div>
	</div>


</div>



