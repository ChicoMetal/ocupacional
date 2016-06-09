<div class="container">
<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered green">
            <div class="box-title">
                <h3>
                    <div class="center">
                    CERTIFICADO INTEGRAL DE APTITUD MEDICA OCUPACIONAL
                    </div>
                </h3>
            </div>

            <div class="box-content nopadding">
                    
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tipo de examen:</td>
                                            <td><?php echo $tipoexamen['nombre'] ?> </td></td>
                                        </tr>
                                        <tr>
                                            <td>Lugar y fecha:</td>
                                            <td>Sincelejo - Sucre <?php echo $historia['fecha'] ?> </td></td>
                                             
                                        <tr>
                                            <td>Empresa</td>
                                            <td><?php echo $empresa['razonsocial'] ?></td>
                                            <td>Nit</td>
                                            <td><?php echo $empresa['nit'] ?></td>
                                            <td>#</td>
                                            <td><?php echo $empresa['codigo'] ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <strong>DATOS TRABAJADOR / ASPIRANTE</strong>
                                            </td>   
                                        </tr>
                                        <tr>
                                            <td>Nombres</td>
                                            <td colspan="2"><?php echo $paciente['nombres'] ?></td>
                                            <td>Apellidos</td>
                                            <td colspan="2"><?php echo $paciente['apellidos'] ?></td>

                                        </tr>
                                        <tr>
                                            <td>Fecha nacimiento</td>
                                            <td><?php echo $paciente['fechanacimiento'] ?></td>
                                            <td>Cargo actual / Aspira </td>
                                            <td colspan="4"><?php echo $paciente['cargo_atual'] ?></td>
                                        </tr>

                                    </tbody>
                                </table>

                  
                <br>
                <h5><strong>EXAMENES REALIZADOS</strong></h5>
                <div class="span12">
                <?php  
                   
                    foreach ($actividades as $datos) {
                        ?>
                            <div class="span2">
                                <?php echo $datos['nombre'] ?>.           
                            </div>
                        <?php
                    }
                ?>
                </div>
               
                <br>
                <h5><strong>CONCEPTO DE ACTITUD MEDICA OCUPACIONAL</strong></h5>
                <div class="span12">
                <?php  
                   
                    foreach ($concepto as $datos) {
                        ?>
                            <div class="span5">
                                <?php echo $datos['nombre'] ?>.           
                            </div>
                        <?php
                    }
                ?>
                </div>
               


            </div>
        </div>
    </div>
</div>




</div>

