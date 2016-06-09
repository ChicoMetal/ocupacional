<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Panel de Administracion</title>
        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/fullcalendar.css" />   
        <link rel="stylesheet" href="<?php echo base_url() ?>css/unicorn.main.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/unicorn.grey.css" class="skin-color" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/colorpicker.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/datepicker.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/uniform.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/select2.css" />   


    <script src="<?php echo base_url() ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery-ui.custom.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.gritter.min.js"></script>
    
    <script src="<?php echo base_url() ?>js/jquery.peity.min.js"></script>
    <script src="<?php echo base_url() ?>js/myscript.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.uniform.js"></script>
    <script src="<?php echo base_url() ?>js/select2.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.validate.js"></script>
    <script src="<?php echo base_url() ?>js/unicorn.form_validation.js"></script>


    </head>
    <body>
        
        
        <div id="header">
            <h2 class="badge">Ultraclínica</h2>       
        </div>
        
        <div id="search">
            <input type="text" placeholder="Search here..."/><button type="submit" class="tip-right" title="Search"><i class="icon-search icon-white"></i></button>
        </div>
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class="btn btn-inverse dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#">new message</a></li>
                        <li><a class="sInbox" title="" href="#">inbox</a></li>
                        <li><a class="sOutbox" title="" href="#">outbox</a></li>
                        <li><a class="sTrash" title="" href="#">trash</a></li>
                    </ul>
                </li>
                <li class="btn btn-inverse"><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
                <li class="btn btn-inverse"><a title="" href="<?php echo base_url() ?>"><i class="icon icon-share-alt"></i> <span class="text">Salir</span></a></li>
            </ul>
        </div>
        
