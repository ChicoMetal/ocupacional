<table border="1" >
  
  <thead>
    <tr>
      <th colspan="6">Información Ocupacional</th>
    </tr>
  </thead>
  <tbody>
    
      

<?php 
if($data)
foreach ($data as $datos) {


 ?>

<tr>
<td>
Cargo actual
</td>
<td>
<?php echo $datos['cargo_atual']  ?>
</td>
</tr>

<tr>
  <td>Horario laboral (Hs)</td>
  <td><?php echo $datos['holario_laboral']  ?></td>
</tr>
<tr>
<td>Turno</td>
<td><?php echo $datos['turno']  ?></td>
</tr>
<tr>
  <td>Funciones</td>
  <td><?php echo $datos['funciones']  ?></td>
</tr>

<tr>
<td>Antiguedad</td>
<td><?php echo $datos['antiguedad']  ?></td>
</tr>


<?php 

  }# code...

 ?>

</tbody>
</table>
