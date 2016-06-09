<div class="widget-box">
    <div class="widget-title">

        <h5>Lista de pacientes</h5>

    </div>
        
   
    <h6> </h6>
    <div class="widget-content nopadding">
        <table class="table table-bordered table-striped table-hover data-table">
            <thead>
            <tr>
                
                <th>Identificacion</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha y Hora</th>
                
                <th>Acción </th>
                
                
               
            </tr>
            </thead>
            <tbody>
<?php 
    
if($pacientes!="")
foreach ($pacientes as  $dato) {
  ?>
    <tr>
        
        <td><?php echo $dato['pac_identificacion'] ?></td>
        <td><?php echo $dato['pac_apellido1'] ?> <?php echo $dato['pac_apellido2'] ?></td>
        
        <td><?php echo $dato['pac_nombre1'] ?> <?php echo $dato['pac_nombre2'] ?></td>
        <td><?php echo $dato['con_fecha'] ?> </td>
        <td>
             <div class="btn-group">
                  <button class="btn btn-info">Accion</button>
                  <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>index.php/medicos/atencion/<?php echo $dato['pac_codigo'] ?>">Atender</a></li>
                    <li><a href="">Suspender</a></li>
                    <li><a href="">Posponer</a></li>
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




