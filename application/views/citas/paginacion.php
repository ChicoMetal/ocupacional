
<div class="widget-box">
    <div class="widget-title">

        <h5>Lista de pacientes</h5>

    </div>
    <h6>Total  <?php echo $cantidad ?> </h6>
    <div class="widget-content nopadding">
        <table class="table table-bordered table-striped table-hover data-table">
            <thead>
            <tr>
                <th>Tipo de id</th>
                <th>Identificacion</th>
                <th>1er Apellido</th>
                <th>2do Apellido</th>
                <th>1er nombre</th>
                <th>2do nombre</th>
                <th>Sexo </th>
                <th>Ver </th>
                
                
               
            </tr>
            </thead>
            <tbody>
<?php 
    
if($pacientes!="")
foreach ($pacientes as  $dato) {
  ?>
    <tr>
        <td><?php echo $dato['pac_tipo_de_identificacion'] ?></td>
        <td><?php echo $dato['pac_identificacion'] ?></td>
        <td><?php echo $dato['pac_apellido1'] ?></td>
        <td><?php echo $dato['pac_apellido2'] ?></td>
        <td><?php echo $dato['pac_nombre1'] ?></td>
        <td><?php echo $dato['pac_nombre2'] ?></td>
        <td><?php echo $dato['pac_sexo'] ?></td>
        <td>
            <div class="btn-group">
                  <button class="btn btn-info">Accion</button>
                  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="">Mostrar</a></li>
                    <li><a href="">Editar</a></li>
                    <li><a href="<?php echo base_url().'index.php/citas/nueva/'.$dato['pac_codigo'] ?>">Programar consulta</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Ver estado financiero</a></li>
                  </ul>
                </div><!-- /btn-group -->
            </div>
        </td>
        
   </tr>

  <?php
}


 ?>
        </tbody>
    </table>  
    </div>
</div>
