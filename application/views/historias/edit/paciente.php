<table class="table table-hover table-nomargin table-bordered">
  <thead>
    <tr>
      <th colspan="8">Datos del paciente</th>
    </tr>
  </thead>
  <tbody>
<?php 
foreach ($data as $datos) {
	
?>
<tr>
              
            <tr>
              <td>Nombres</td>
              <td colspan="3">

                <?php echo $datos['nombres'] ?>
              </td>
              <td>Apellidos</td>
              <td colspan="3"><?php echo $datos['apellidos'] ?></td>
            </tr>
            <tr>
              <td>Cédula</td>
              <td>
                <?php echo $datos['identificacion']; ?>
                <input  type="hidden" name="idpaciente" value="<?php echo $datos['identificacion']; ?>">

              </td>
              
              <td>No de hijos</td>
              <td>
                <input type="hidden" name="pac_numhijos" value=" <?php echo $datos['numhijos']; ?>">
                <?php echo $datos['numhijos']; ?>
              </td>

            </tr>
            <tr>
              <td>
                Estado civil
              </td>
              <td>
                <input type="hidden" name="pac_estadocivil" value=" <?php echo $datos['estadocivil']; ?>">
                <?php echo $datos['estadocivil']; ?>
              </td>
              <td>
                Escolaridad
              </td>
              <td>
                <input type="hidden" name="pac_escolaridad" value=" <?php echo $datos['escolaridad']; ?>">
                <?php echo $datos['escolaridad']; ?>
              </td>
              <td>
                Completa
              </td>
              <td colspan ="3">
                <input type="hidden" name="pac_escolaridad_completa" value=" <?php echo $datos['escolaridad_completa']; ?>">
                <?php echo $datos['escolaridad_completa']; ?>
              </td>
            </tr>
            

<?php


}


        

 ?>
</tbody>
</table>