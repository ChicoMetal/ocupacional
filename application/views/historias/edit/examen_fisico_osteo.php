<strong>Examen fisico Osteo muscular</strong>
    
<?php 
//var_dump($data);
foreach ($data as $datos) {
  
?>
<table>
  <thead>
    <tr>
      <th>TEST ORTOPÉDICOS</th>
      <td>Derecho</td>
      <td>Izquierdo</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>PRUEBA EPICONDILITIS</td>
      <td><?php echo $datos['epicondilitisd']?></td>
      <td><?php echo $datos['epicondilitisi']?></td>
    </tr>

    <tr>
      <td>FINKELSTEIN</td>
      <td><?php echo $datos['finkelsteind']?></td>
      <td><?php echo $datos['finkelsteini']?></td>
    </tr>

    <tr>
      <td>TINEL</td>
      <td><?php echo $datos['tineld']?></td>
      <td><?php echo $datos['tineli']?></td>
    </tr>

    <tr>
      <td>PHALEN</td>
      <td><?php echo $datos['phalemd']?></td>
      <td><?php echo $datos['phalemi']?></td>
    </tr>
  </tbody>
</table>


<table class="table table-hover table-nomargin table-bordered">
    <thead>
      <tr>
        <th></th>
        <th>DEDOS MANOS</th>
        <th>MUÑECA</th>
        <th>ANTEBRAZO</th>
        <th>CODOS</th>
        <th>BRAZO</th>
        <th>HOMBROS</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <td>INSPECCION</td>
        <td>
          <?php echo $datos['dedosmanosi']?>  
        </td>
        <td>
          <?php echo $datos['munecai']?>  
        </td>
        <td>
          <?php echo $datos['antebrazoi']?>  
        </td>
        <td>
          <?php echo $datos['codosi']?> 
        </td>
        <td>
          <?php echo $datos['brazoi']?> 
        </td>
        <td>
          <?php echo $datos['hombrosi']?> 
        </td>
        
      </tr>
      <tr>
        <td>PALPACION</td>
        <td>
          <?php echo $datos['dedosmanosp']?>
        </td>
        <td>
          <?php echo $datos['munecap']?>
        </td>
        <td>
          <?php echo $datos['antebrazop']?>
        </td>
        <td>
          <?php echo $datos['codosp']?>
        </td>
        <td>
          <?php echo $datos['brazop']?>
        </td>
        <td>
          <?php echo $datos['hombrosp']?>
        </td>
      </tr>
      <tr>
        <td>MOVILIDAD</td>
        <td>
          <?php echo $datos['dedosmanosm']?>
        </td>
        <td>
          <?php echo $datos['munecam']?>
        </td>
        <td>
          <?php echo $datos['antebrazom']?>
        </td>
        <td>
          <?php echo $datos['codosm']?>
        </td>
        <td>
          <?php echo $datos['brazom']?>
        </td>
        <td>
          <?php echo $datos['hombrosm']?>
        </td>
        
 
      </tr>
    </tbody>
  </table>

<table class="table table-hover table-nomargin table-bordered">
    <tbody>
      <tr>
        <td>TEST DE WELL</td>
        <td> <?php echo $datos['testdewell']?></td>
      </tr>
      <tr>
        <td>TEST DE  SHOBER</td>
        <td><?php echo $datos['testdeshober']?></td>
      </tr>
      <tr>
        <td colspan="2">TEST NEUROLÓGICO</td>
        
      </tr>
      <tr>
        <td colspan="1">LASSEGUE DERECHO</td>
        <td><?php echo $datos['lassegued']?></td>
      </tr>
        <td colspan="1">LASSEGUE IZQUIERDO</td>
        <td><?php echo $datos['lasseguei']?></td>
      </tr>
     
    </tbody>
  </table>




<?php

}

 ?>
