<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url() ?>bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url() ?>bootstrap/css/font-awesome.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url() ?>resource/css/style.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url() ?>bootstrap/css/prettify.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url() ?>resource/wysi/css/bootstrap-wysihtml5.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>resource/calendar/css/doc.css">

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
            background-image: url("<?php echo base_url() ?>resource/img/bg.png");
        }

        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="<?php echo base_url() ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>bootstrap/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>bootstrap/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url() ?>bootstrap/ico/bootstrap-apple-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url() ?>bootstrap/ico/bootstrap-apple-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url() ?>bootstrap/ico/bootstrap-apple-72x72.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url() ?>bootstrap/ico/bootstrap-apple-57x57.png">

    <script type="text/javascript" src="<?php echo base_url() ?>bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/calendar/js/ui.js"></script>

        
    <script type="text/javascript" src="<?php echo base_url() ?>resource/chart/chart.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/chart/highcharts.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/chart/exporting.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/wysi/js/wysihtml5-0.3.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/wysi/js/prettify.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resource/wysi/js/bootstrap-wysihtml5.js"></script>
    <script>
        $('.textarea').wysihtml5();
    </script>

    <script type="text/javascript" charset="utf-8">
        $(prettyPrint);
    </script>


    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-30181385-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>



</head>


