<?php

$this->load->view('includes/'. $ses['permisos'].'/header');
$this->load->view('includes/menu_'. $ses['permisos']);
$this->load->view($contenido_principal);
$this->load->view('includes/'. $ses['permisos'].'/footer');

?>