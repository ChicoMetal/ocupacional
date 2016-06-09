<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">Ocupacional</a>
			
			<ul class='main-nav'>
				<li class='active'> 
					<a href="<?php echo base_url() ?>admintracion">
						<span>Administracion</span>
					</a>
				</li>
				<li>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Empresas</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url() ?>indes.php/empresas">Administrar empresas</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>indes.php/empresas">Comtratar actividades</a>
						</li>
						<li>
							<a href="forms-extended.html">Consultas..</a>
						</li>
						
					</ul>
				</li>
				<li>
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Actividades</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="components-timeline.html">Adminitrar Actividades</a>
						</li>
					</ul>
				</li>
				
			</ul>






			<div class="user">
				<ul class="icon-nav">
					
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $ses['nombres'] ?> <img src="<?php echo base_url() ?>img/demo/user-avatar.jpg" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="">Editar perfil</a>
						</li>
						<li>
							<a href="">Configuracion de la cuenta</a>
						</li>
						<li>
							<a href="">Salir</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>