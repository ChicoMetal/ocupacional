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
var cantipreguntas=0;
$(document).ready(function(){
	


	$("#add_pregunta").click(function(){
		
		boton="<i class='glyphicon-remove_2'></i> ";
		//boton="";
		pregunta=$("#campos").val();
		texto="";
		if(pregunta!=""){
			cantipreguntas++;
			texto="<div class='respuestas' onclick='removepregunta(this)'>"+boton+pregunta+"</div>";
			$("#show_preguntas").append(texto);
			$("#campos").val("");
			realizarvistaprevia();
		}
		

	});

   	


	load_actividades_pnomformularios_search();
	
	
	$("#form_preguntas_formularios").validate({
		submitHandler: function(form){
	
			var dataString = $(form).serialize();
			dataString=dataString+"&cod_padre="+$("#cod_padre").val();
			
			if(cantipreguntas>0){
				
				$.ajax({
	            	type: "POST",
	                url:"<?php echo base_url() ?>index.php/actividades_nomformularios/guardar_pregunta",
	                data: dataString,
	                success: function(data){
	                
						$.gritter.add({
							title: 'actividades_nomformularios',
							text: 'La actividades_nomformulario ha sido guardada correctamente!',
							
						});
						$("#form_preguntas_formularios").each (function(){ this.reset()});
						$("#show_preguntas").text("");
						load_actividades_pnomformularios_search();
										
	                },
	                error: function(data){

	                	$.gritter.add({
							title: 'Error',
							text: 'Ocurrio un error al guardar la actividades_nomformulario',
						});

	                }

	            });

	        }else{
				
        	$.gritter.add({
				title: 'Error',
				text: 'Debe ingresar almenos una respuesta',
			});	        	

	        }
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

	function load_actividades_pnomformularios_search(){

		nombre 		=$("#nombre_search").val();
		
		estado 		=$("#estado_search").val();
		cantidad 	=$("#cantidad_res").val();
		cod_padre	=$("#cod_padre").val();

		$("#load_actividades_nomformularios_preguntas").children().remove();
			dataString="&nombre="+nombre
						+"&estado="+estado
						+"&cantidad_res="+cantidad
						+"&cod_padre="+cod_padre;
          $.ajax({
        	type: "POST",
            url:"<?php echo base_url() ?>index.php/actividades_nomformularios/mostrar_ajax_preguntas",
            data: dataString,
            success: function(data){
        		$("#load_actividades_nomformularios_preguntas").append(data);
            },
            error: function(data){
            	$("#load_actividades_nomformularios_preguntas").html(data);
            }

        });


	}


	function removepregunta(ob){
		$(ob).remove();
		cantipreguntas--;
		realizarvistaprevia();
	}

	function remplazar(str){
		//alert(str);
		var str=replaceAll(str,'onclick="removepregunta(this)"',"");
		var str=replaceAll(str,'<i class="glyphicon-remove_2"></i>',"");
		var str=$.trim(str);
		return str;
	}

	function replaceAll( text, busca, reemplaza ){
		
		while (text.toString().indexOf(busca) != -1)
			text = text.toString().replace(busca,reemplaza);
		return text;
	}

	function devolvertipo(tipo,respuestas,valorpordefecto){
		var campo="";
		var respuestas= new Array();;
		var cont=0;
		$("#pregunras_code").val(remplazar($("#show_preguntas").html()));
		
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
					id="form_preguntas_formularios"
					name="form_preguntas_formularios"
					>
					<input type="hidden" name="codnombreformulario" id="codnombreformulario" value="">
					<div class="span6">
						
						
						<div class="control-group">
							<label for="textfield" class="control-label">Preguna¿?</label>
							<div class="controls">
								<input 
									type="text" 
									name="pregunta" 
									id="pregunta" 
									placeholder="Pregunta" 
									class="input-xlarge"
									value="<?php echo set_value('nombre') ?>"
									data-rule-required="true"
									data-rule-maxlength="500"
									>
							</div>
						</div>


					</div>


					<div class="span6">
						<div class="control-group">
							<label for="textfield" class="control-label">Tipo de pregunta</label>
							<div class="controls">
								<select name="tipo" id="tipo"  data-rule-required="true">
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
									<input type="text" class="span1" readonly id="pregunras_code" name="pregunras_code" data-rule-required="true">
								
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
		
		onclick="load_actividades_pnomformularios_search()"
		class="btn btn-orange">
		Buscar
	</button>

	</div>
</div>

<div id="load_actividades_nomformularios_preguntas">


				
</div>

</div>
</div>
