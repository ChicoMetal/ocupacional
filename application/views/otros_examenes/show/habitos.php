
 
<?php 
if($data!="")
foreach ($data as $datos) {

 ?>
 <table class="table table-hover table-nomargin table-bordered">

  <tr>
    <td>    
      <?php echo $datos['fumador'] ?></td>
    <td>
      <?php 
        if($datos['fumador']!="No fuma"){
          echo "Frecuencia:  ".$datos['fuma_frecuencia']."";
          echo " Años de consumo:  ".$datos['fuma_anios']."";
          echo " Tipo:  ".$datos['fuma_tipo']."";
         

        }
         ?>
    </td>

  </tr>
    <tr>

      <td>
    <?php echo $datos['alcohol'] ?>
      </td>
      <td>
        <?php 
          if($datos['alcohol']!="No bebe"){
            echo " Frecuencia:  ".$datos['alcohol_frecuencia']."";
           
          }
           ?>
      </td>
  </tr>
  <tr>
    <td>
    <?php echo $datos['deportes'] ?>
    </td>
    <td>
      <?php 
      if($datos['deportes']!="No deportista"){
        echo " Frecuencia:  ".$datos['deportes_frecuencia']."";
        echo "     Lesiones:  ".$datos['lesiones']."";
               }
       ?>
     </td>
  </tr>
  
     Observaciones
    
      <?php echo $datos['observaciones'] ?>

</table>

<?php 


}

 ?>

