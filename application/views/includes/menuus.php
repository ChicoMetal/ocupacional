<?php
	$data_session=$this->session->all_userdata();
     $numedeiden=$data_session['numedeiden'];
     $codempresa=$data_session['codempresa'];

 ?>

<ul id="menu">
	<li><?php echo anchor('venta/menu','Inicio') ?></li>
    <li><?php echo anchor('venta/facturacion','Venta') ?></li>
    <li><?php echo anchor('contratos/','Contratos') ?>></li>
    <li><?php echo anchor('clientes/','Clientes') ?>></li>
    <li><?php echo anchor('cotizaciones/','cotizaciones') ?>></li>


    <!--<li> <a href="<?php echo base_url() ?>cotizacionesmotokob/index.php?codempresa=<?php echo $codempresa ?>&numedeiden=<?php echo $numedeiden ?>" target="_blank">Cotizaciones</a> </li>-->

    <li><a href="#">Codeudores</a></li>
    <li> <?php echo anchor('usuarios/logout','Salir') ?>  </li>
</ul>