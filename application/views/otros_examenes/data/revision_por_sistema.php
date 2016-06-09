<table class="table table-hover table-nomargin table-bordered">
    <thead>
      <tr>
        <th>SISTEMA</th>
        <th>OBSERVACION</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $cods_sistemas="";
      foreach ($sistema as  $data) {
        $cods_sistemas=$cods_sistemas.$data['codigo'].",";
        ?>

        <tr>
          <td><?php echo $data['nombre'] ?></td>
          <td>
            <input type="text" name="<?php echo 'rsis-'.$data['codigo']  ?>" id="<?php echo 'rsis-'.$data['codigo']  ?>" value="Sin datos de importancia">
          </td>
        </tr>
        <?php
      }
     ?>
     <input type="hidden" name="cods_sistemas" value="<?php echo $cods_sistemas ?>">
    </tbody>
</table>






