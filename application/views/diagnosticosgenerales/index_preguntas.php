<style type="text/css" media="screen">
	.respuestas{
		background: rgba(86,175,69,1);
		color: #fff;
		
		font-size: 1.1em;

	}
	.respuestas .glyphicon-remove_2{
		color: red;
		font-size: 1.5em;
	}
	.respuestas .glyphicon-remove_2:hover{
		color: #C0C0C0;
		
	}
</style>


<script type="text/javascript">
nombre="";

var estado="";
var cantidad=30;
var contador=0;
$(document).ready(function(){
	


	$("#add_pregunta").click(function(){
		
		boton="<i class='glyphicon-remove_2'> </i> ";
		//boton="";
		pregunta=$("#campos").val();
		texto="";
		if(pregunta!=""){

			texto="<div class='respuestas' onclick='removepregunta(this)'>"+boton+pregunta+"</div>";
			$("#show_preguntas").append(texto);
			$("#campos").val("");
			realizarvistaprevia();
		}
		

	});

   	


	load_actividades_nomformularios_search();
	
	
	$("#form_actividades_nomformularios").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
	          $.ajax({
            	type: "POST",
                url:"<?php echo base_url() ?>index.php/actividades_nomformularios/guardar",
                data: dataString,
                success: function(data){
                
	                $.gritter.add({
										title: 'actividades_nomformularios',
										text: 'La actividades_nomformulario ha sido guardada correctamente!',
										
									});
									$("#form_actividades_nomformularios").each (function(){ this.reset()});
									load_actividades_nomformularios_search();
									
                },
                error: function(data){

                	$.gritter.add({
						title: 'Error',
						text: 'Ocurrio un error al guardar la actividades_nomformulario',
					});

                }

            });
        }
    });


	$("#pregunta").keyup(function(){
		realizarvistaprevia();
	});
	$("#tipo").change(function(){
		realizarvistaprevia();
	});
	$("#campos").keyup(function(){
		
	});
	$("#valorpordefecto").keyup(function(){
		realizarvistaprevia();
	});
	$("#observacion").change(function(){
		realizarvistaprevia();
	});
	$("#orden").keyup(function(){
		realizarvistaprevia();
	});
	
		
	
	 


  });
	

	function cerrarhijo(){
		$("#hijo").html();
		$("#cod_padre").val("");
		$("#padre").show("clip", 100 );
		$("#hijo").effect("drop", 100 );
				
	}

	function load_actividades_nomformularios_search(){

		nombre 		=$("#nombre_search").val();
		
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
	
		$("#load_actividades_nomformularios").children().remove();
			dataString="&nombre="+nombre
						+"&estado="+estado
						+"&cantidad_res="+cantidad;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/actividades_nomformularios/mostrar_ajax",
            data: dataString,
            success: function(data){
        		$("#load_actividades_nomformularios").append(data);
            },
            error: function(data){
            	$("#load_actividades_nomformularios").html(data);
            }

        });


	}


	function removepregunta(ob){
		$(ob).remove();
		realizarvistaprevia();
	}


	function devolvertipo(tipo,respuestas,valorpordefecto){
		var campo="";
		var respuestas= new Array();;
		var cont=0;
		
		$("#show_preguntas").each(function (){
			$(this).find('div').each(function(){
		       respuestas[cont]=$(this).text();
				cont++;
		    });
			 
		});

		//alert(respuestas[0]);
		var length = respuestas.length;
		//alert(respuestas);
		for(var i=0;i< length; i++) {

			if(tipo=="radio"){
				campo=campo+respuestas[i] +" <input type='radio' name='text' value='"+respuestas[i]+"' > ";
			}
			if(tipo=="checkbox"){
				campo=campo+respuestas[i] +" <input type='checkbox' name='text' value='"+respuestas[i]+"'> ";
			}
			if(tipo=="text"){
				campo=campo+respuestas[i] +" <input type='text' name='text' value='"+valorpordefecto+"'> ";
			}
			if(tipo=="select"){
				campo=campo+respuestas[i] +" <option value='"+respuestas[i]+"'>"+respuestas[i]+"</option> ";
			}
		}
		
		if(tipo=="select"){
			campo="<select>"+campo+"</select>";
		}

		return campo;
	}


	function realizarvistaprevia(){
		pregunta 		= $("#pregunta").val();
		tipo 			= $("#tipo").val();
		campos			= "-";
		valorpordefecto	= $("#valorpordefecto").val();
		observacion		= $("#observacion").val();
		orden			= $("#orden").val();

		if(pregunta!="" && tipo!="" && campos!=""){
			campo=devolvertipo(tipo,campos,valorpordefecto);
			vista=pregunta+" "+campo;
			if(observacion=="si"){
				vista+=" Observación <textarea></textarea>"
			}
		}else{
			vista="Reelene mas datos del formulario para la vista previa";

		}



		$("#vistaprevia").html(vista);


	}
	


</script>



<div class="container" >



<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered teal">
			<div class="box-title">
				<h3>
					<i class="icon-list"></i> 
					<div calss="span4">
						<label id="nombre_padre"></label>	
					</div>
					<div calss="span4">
						<label id="nombre_hijo"></label>  	
					</div>
					<div calss="span4">
						
							
					</div>
					
				</h3>
			</div>
			<div class="box-content nopadding">
				<button 
					type="button"
					class="btn btn-red"
					onclick="cerrarhijo()">
					Cancelar
				</button>
				<button 
					type="button"
					class="btn btn-red"
					onclick="desaparecerpadre('3','ANTECEDENTES PERSONALES (ha padecido alguna vez)')">
					Recargar
				</button>

				<form 
					method="POST" 
					class='form-horizontal form-column form-bordered'
					id="form_actividades_nomformularios"
					name="form_actividades_nomformularios"
					>

					<div class="span6">
						
						
						<div class="control-group">
							<label for="textfield" class="control-label">Nombre</label>
							<div class="controls">
								<input 
									type="text" 
									name="pregunta" 
									id="pregunta" 
									placeholder="Pregunta" 
									class="input-xlarge"
									value="<?php echo set_value('nombre') ?>"
									data-rule-required="true"
									data-rule-maxlength="100"
									>
							</div>
						</div>


					</div>


					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">Tipo de pregunta</label>
							<div class="controls">
								<select name="tipo" id="tipo">
									<option value="">Elija el tipo de respuesta</option>
									<option value="radio">Una sola opcion</option>
									<option value="checkbox">Multiples opciones</option>
									<option value="select">Campos de seleccion</option>
									<option value="text">Campo de texto</option>
								</select>
							</div>
						</div>
					</div>

					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">Posibles respuestas</label>
							<div class="controls">

								<textarea 
									name="campos" 
									id="campos"
									class="input-xlarge"
									></textarea>
									<button 
										type="button"
										class="btn btn-teal ok"
										id="add_pregunta"
									>
									+
									</button>
									<label id="show_preguntas">


									</label>
								
							</div>
							<label id="id_preguntas"></label>
						</div>
					</div>


					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">Valor por defecto</label>
							<div class="controls">
								<input type="text" name="valorpordefecto"  id="valorpordefecto" value="" >
								
							</div>
						</div>
					</div>

					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">Obsercacion/comentarios</label>
							<div class="controls">
								<select name="observacion" id="observacion" >
									<option value="no">no</option>
									<option value="si">si</option>
								</select>
								
							</div>
						</div>
					</div>

					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">Orden</label>
							<div class="controls">
								<input type="number" name="orden" id="orden" value="" >
								
							</div>
						</div>
					</div>

					<div class="span12">
						Vista previa de la pregunta.
						<div id="vistaprevia">

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
					actividades_nomformularios
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
		<option value="10">30</option>
		<option value="20">50</option>
		<option value="30">100</option>

	</select>

	<button 
		type="button"
		
		onclick="load_actividades_nomformularios_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_actividades_nomformularios">


				
</div>

</div>
</div>
