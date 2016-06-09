<script type="text/javascript">

    function fn_agregar(){
        guardar_ajax();
    }

    function guardar_ajax(){
       
        datos=$("#form_citas").serialize();
        
        $.ajax({
          url: '<?php echo base_url() ?>index.php/citas/guardar_citas',
          type: 'POST',
          data: datos,
            success: function (msg){
               if(msg=="si"){
                   val_form=1;
                    alert("Guardado correctamente");
                   $("#form_citas").each (function(){ this.reset()});
               }else{
                   val_form=0;
               }
            }

        });
        
    }
</script>


<?php 

if($paciente!=""){
foreach ($paciente as  $dato) {

 ?>
<div class="row-fluid">

  


    <div class="span6">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>                                  
                </span>
                <h5>Nuevo Cita</h5>
               
            </div>



            <div class="widget-content nopadding">
                <form class="form-horizontal" 
                        method="post" 
                        action='javascript: fn_agregar();' 
                        name="form_citas" 
                        id="form_citas" 
                        novalidate="novalidate"
                >
                    <input type="hidden" name="cod_paciente" value="<?php echo $dato['pac_codigo'] ?>">
                    <div class="control-group">
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th colspan="2">Datos del paciente</th>
                              
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Identificacion</td>
                                <td><?php echo $dato['pac_identificacion'] ?></td>
                              </tr>
                              <tr>
                                <td>Nombres</td>
                                <td>
                                    <?php echo $dato['pac_nombre1'] ?>
                                    <?php echo $dato['pac_nombre2'] ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Apellidos</td>
                                <td>
                                    <?php echo $dato['pac_apellido1'] ?>
                                    <?php echo $dato['pac_apellido2'] ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Fecha</label>
                        <div class="controls">
                            <input type="date" class="required" name="feha" id="fecha">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Hora</label>
                        <div class="controls">
                            <input type="time" class="required" name="hora" id="hora">
                        </div>
                    </div>

                     <div class="control-group">
                        <label class="control-label">Medico</label>
                        <div class="controls">
                            <input type="text" class="required" value="1" readonly name="medico" id="medico">
                        </div>
                    </div>

                     <div class="control-group">
                        <label class="control-label">Motivo</label>
                        <div class="controls">
                            <textarea name="motivo" id="motivo" > </textarea>
                        </div>
                    </div>

                     <div class="control-group">
                        <label class="control-label">Observaciones</label>
                        <div class="controls">
                           <textarea name="observacion" id="observacion" > </textarea>
                            
                        </div>
                    </div>
                     

                    <div class="form-actions">
                        <input type="submit" value="Guardar" id="regpacientes" class="btn btn-primary">
                    
                        <input type="reset" value="limpiar"  class="btn">
                    </div>
                </form>
            </div>
        </div>          
    </div>
</div>


<?php 

    # code...
}

} ?>