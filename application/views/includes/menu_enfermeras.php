<?php 
	switch ($active) {
    case "administracion":
    	?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#administracion").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
    case "empresas":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#empresas").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
      
   case "actividades":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#actividades").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

    case "pacientes":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#pacientes").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
      
    case "formularios":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#formularios").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

    case "audiometrias":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#audiometrias").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

  

    case "historias":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#historias").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

        
    case 2:
        echo "i es igual a 2";
        break;
	}

//*******************************************
	switch ($active2) {
    case "admempresas":
    	?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admempresas").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
       
    case "contratarac":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#contratarac").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
       
   case "acontratadas":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#acontratadas").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

    case "admactividades":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admactividades").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
        

    case "admpacientes":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admpacientes").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
    case "orden_atencion":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#orden_atencion").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
    
    case "buscar_orden":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#buscar_orden").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

        
    case "buscar_ordenes_pendientes":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#buscar_ordenes_pendientes").addClass("active");
	    		});	
    		</script>
    	<?php
        break;


    case "admantecedentes":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admantecedentes").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
        
    	case "admhistoria":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admhistoria").addClass("active");
	    		});	
    		</script>
    	<?php
        break;
        
      	case "admriesgos":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admriesgos").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

      	case "admriesgos":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admriesgos").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

      	case "admaudiometrias":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admaudiometrias").addClass("active");
	    		});	
    		</script>
    	<?php
        break;


      	case "admtipo_examenes":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admtipo_examenes").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

      	case "admconcepto_actitud_medica_ocupcional":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admconcepto_actitud_medica_ocupcional").addClass("active");
	    		});	
    		</script>
    	<?php
        break;


      	case "admrecomendaciones_laborales":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admrecomendaciones_laborales").addClass("active");
	    		});	
    		</script>
    	<?php
        break;


      	case "hisenproceso":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#hisenproceso").addClass("active");
	    		});	
    		</script>
    	<?php
        break;

      	case "admaudiometrias_sugerencias":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admaudiometrias_sugerencias").addClass("active");
	    		});	
    		</script>
    	<?php
        break;


      	case "admactividades_nomformularios":
        ?>	
    		<script>
	    		$(document).ready(function(){
	    			$("#admactividades_nomformularios").addClass("active");
	    		});	
    		</script>
    	<?php
        break;



        
        
    
	}




 ?>


<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">Ocupacional</a>
			
			<ul class='main-nav'>
				<li id="administracion" > 
					<a href="<?php echo base_url() ?>index.php/administracion">
						<span>Administracion</span>
					</a>
				</li>

				
				<li id="pacientes">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Pacientes</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li id="admpacientes">
							<a href="<?php echo base_url() ?>index.php/pacientes">Administrar pacientes</a>
						</li>
						<li id="orden_atencion">
							<a href="<?php echo base_url() ?>index.php/pacientes/orden">Orden de atención</a>
						</li>
						<li id="buscar_orden">
							<a href="<?php echo base_url() ?>index.php/ordenes/buscar">Buscar orden</a>
						</li>
						<li id="buscar_ordenes_pendientes">
							<a href="<?php echo base_url() ?>index.php/ordenes/buscar_ordenes_pendientes">Listar ordenes pendientes</a>
						</li>
						

						<li id="admhistoria">
							<a href="<?php echo base_url() ?>index.php/historias/nueva">Nueva historia</a>
						</li>
						
					</ul>
				</li>
				

				
				<li id="empresas">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Empresas</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li id="admempresas">
							<a href="<?php echo base_url() ?>index.php/empresas">Administrar empresas</a>
						</li>
						<!--
						<li id="contratarac">
							<a href="<?php echo base_url() ?>index.php/empresas/contratar">Contratar actividades</a>
						</li>
						<li id="acontratadas">
							<a href="<?php echo base_url() ?>index.php/actividades/contratadas">Actividades contratadas</a>
						</li>
						<li>
							<a href="forms-extended.html">Consultas..</a>
						</li>-->
						
					</ul>
				</li>
				<!--
				<li  id="actividades">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Actividades</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li id="admactividades">
							<a href="<?php echo base_url() ?>index.php/actividades">Adminitrar Actividades</a>
						</li>
					</ul>
				</li>

				<li id="audiometrias">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Audiometrias</span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li id="admaudiometrias_sugerencias">
							<a href="<?php echo base_url() ?>index.php/audiometrias_sugerencias">Administrar sugerencias de audiometria</a>
						</li>
						<li id="admaudiometrias">
							<a href="<?php echo base_url() ?>index.php/audiometrias">Administrar audiometrias</a>
						</li>
						
					</ul>
				</li>
				
				
				<li id="formularios">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Formularios</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li id="admactividades_nomformularios">
							<a href="<?php echo base_url() ?>index.php/actividades_nomformularios">Administrar nombre de formularios</a>
						</li>
						

						<li id="admantecedentes">
							<a href="<?php echo base_url() ?>index.php/antecedentes">Administrar antecedentes</a>
						</li>
						<li id="admriesgos">
							<a href="<?php echo base_url() ?>index.php/riesgos">Administrar riesgos</a>
						</li>
						<li id="admtipo_examenes">
							<a href="<?php echo base_url() ?>index.php/tipo_examenes">Tipo de examen</a>
						</li>
						<li id="admconcepto_actitud_medica_ocupcional">
							<a href="<?php echo base_url() ?>index.php/concepto_actitud_medica_ocupcional">Concepto de actitud medica ocupcional</a>
						</li>
						<li id="admrecomendaciones_laborales">
							<a href="<?php echo base_url() ?>index.php/recomendaciones_laborales">Recomendaciones laborales</a>
						</li>

						
					</ul>
				</li>
				-->
				<li id="historias">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Historias</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li id="hisenproceso">
							<a href="<?php echo base_url() ?>index.php/historias/enproceso">Historias en proceso</a>
						</li>
						
						
					</ul>
				</li>

				
			</ul>






			<div class="user">
				<ul class="icon-nav">
					
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $ses['nombres'] ?> 
						<img width="20" src="<?php echo base_url() ?>fotos/usuarios/<?php echo $ses['avatar'] ?>" alt="">
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="">Editar perfil</a>
						</li>
						<li>
							<a href="">Configuracion de la cuenta</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>index.php/usuarios/logout">Salir</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>