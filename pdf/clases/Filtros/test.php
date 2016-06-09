<?php

require_once 'Filtros_web.php';

 echo "Prueba Filtros web";

 $test="<script>alert('ha pasado todo')</script>";

 echo  "<br> ".$test;

//$nvar=FB::antijs($test);

 $test="alert(1)";

echo "<br> <script>alert('".$test."');</<script>";

?>