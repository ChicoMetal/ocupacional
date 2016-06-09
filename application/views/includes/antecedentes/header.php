<!doctype html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <title>FLAT - Extended forms</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css">
    <!-- Bootstrap responsive -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-responsive.min.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
    <!-- PageGuide -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/pageguide/pageguide.css">
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Tagsinput -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/tagsinput/jquery.tagsinput.css">
    <!-- chosen -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/chosen/chosen.css">
    <!-- multi select -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/multiselect/multi-select.css">
    <!-- timepicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- colorpicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/colorpicker/colorpicker.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/datepicker/datepicker.css">
    <!-- Plupload -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/plupload/jquery.plupload.queue.css">
    <!-- select2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/select2/select2.css">
    <!-- icheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/icheck/all.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/style.css">
    <!-- Color CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/themes.css">
    <!-- Notify -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/plugins/gritter/jquery.gritter.css">


    <!-- jQuery -->
    <script src="<?php echo base_url() ?>js/jquery.min.js"></script>
    
    <!-- Nice Scroll -->
    <script src="<?php echo base_url() ?>js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- imagesLoaded -->
    <script src="<?php echo base_url() ?>js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?php echo base_url() ?>js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/jquery-ui/jquery.ui.slider.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <!-- Bootbox -->
    <script src="<?php echo base_url() ?>js/plugins/bootbox/jquery.bootbox.js"></script>
    <!-- Masked inputs -->
    <script src="<?php echo base_url() ?>js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
    <!-- TagsInput -->
    <script src="<?php echo base_url() ?>js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <!-- Datepicker -->
    <script src="<?php echo base_url() ?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Timepicker -->
    <script src="<?php echo base_url() ?>js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- Colorpicker -->
    <script src="<?php echo base_url() ?>js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
    <!-- Chosen -->
    <script src="<?php echo base_url() ?>js/plugins/chosen/chosen.jquery.min.js"></script>
    <!-- MultiSelect -->
    <script src="<?php echo base_url() ?>js/plugins/multiselect/jquery.multi-select.js"></script>
    <!-- CKEditor -->
    <script src="<?php echo base_url() ?>js/plugins/ckeditor/ckeditor.js"></script>
    <!-- PLUpload -->
    <script src="<?php echo base_url() ?>js/plugins/plupload/plupload.full.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/plupload/jquery.plupload.queue.js"></script>
    <!-- Custom file upload -->
    <script src="<?php echo base_url() ?>js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/mockjax/jquery.mockjax.js"></script>
    <!-- select2 -->
    <script src="<?php echo base_url() ?>js/plugins/select2/select2.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo base_url() ?>js/plugins/icheck/jquery.icheck.min.js"></script>
    <!-- complexify -->
    <script src="<?php echo base_url() ?>js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
    <script src="<?php echo base_url() ?>js/plugins/complexify/jquery.complexify.min.js"></script>
    <script src="<?php echo base_url() ?>js/lenguaje_validacion.js"></script>

   




    <!--[if lte IE 9]>
        <script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input, textarea').placeholder();
            });
        </script>
    <![endif]-->
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!-- Apple devices Homescreen icon -->
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url() ?>img/apple-touch-icon-precomposed.png" />

</head>
<body>
    

