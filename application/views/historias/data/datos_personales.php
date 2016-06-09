
        <table class="table table-hover table-nomargin table-bordered">
          <thead>
            <tr>
              <th colspan="8"></th>
            </tr>
          </thead>
          <tbody>
        <?php 

          foreach ($paciente as $data) {
            ?>
            <tr>
              <td>Fecha</td>
              <td><?php echo $data['ord_fecha'] ?></td>
              <td>Empresa</td>
              <td colspan="3"><?php echo $data['razonsocial'] ?></td>
              <td>En misión</td>
              <td>
                  <input 
                    type="text" 
                    name="enmision"
                    id="enmision"
                    >
              </td>

            </tr>
            <tr>
              <td>Nombres</td>
              <td colspan="3"><?php echo $data['nombres'] ?></td>
              <td>Apellidos</td>
              <td colspan="3"><?php echo $data['apellidos'] ?></td>
            </tr>
            <tr>
              <td>Cédula</td>
              <td><?php echo $data['identificacion']; ?></td>
              <td>Edad</td>
              <td><?php echo $edad; ?> años</td>
              <td>Sexo</td>
              <td><?php echo $data['sexo']; ?></td>
              <td>No de hijos</td>
              <td><?php echo $data['numhijos']; ?></td>

            </tr>
            <tr>
              <td>
                Estado civil
              </td>
              <td>
                <?php echo $data['estadocivil']; ?>
              </td>
              <td>
                Escolaridad
              </td>
              <td>
                <?php echo $data['escolaridad']; ?>
              </td>
              <td>
                Completa
              </td>
              <td colspan ="3">
                <?php echo $data['escolaridad_completa']; ?>
              </td>
            </tr>
            <tr>
              <td>
                EPS
              </td>
              <td>
                <?php echo $data['eps']; ?>
              </td>
              <td>
                AFP
              </td>
              <td>
                <?php echo $data['afp']; ?>
              </td>
              <td>
                ARP
              </td>
              <td colspan="3">
                <?php echo $data['arp']; ?>
              </td>
            </tr>



            <?php
          }
         ?>
       </tbody>
      </table>
    
