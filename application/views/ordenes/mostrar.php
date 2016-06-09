<div>


<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered yellow_smal">
      <div class="box-title">
        <h3>
          <i class="icon-table"></i>
          Ordenes
        </h3>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
          
          

          <tbody>
          <?php 
          if($ordenes!=""){
            $head=0;
            $codorden=null;
          foreach ($ordenes as $data) {

            if($head==0  && $codorden!=$data['codorden']){
              $head==1;
              $codorden=$data['codorden'];
              ?>
                <thead>
                
                  <tr>
                    <th colspan>Codigo: <?php echo $data['codorden'] ?></th>
                    <th>Fecha:  <?php echo $data['fecha'] ?></th>
                    <th>
                      <form 
                        method="post" 
                        action="<?php echo base_url() ?>index.php/historias/nueva"
                      >
     
                        <input type="hidden" name="codorden"value="<?php echo $data['codorden'] ?>">
                        <button type="submit" class="btn btn-teal">Realizar historia</button>
                      </form>

                       <form 
                        method="post" 
                        action="<?php echo base_url() ?>index.php/historias/solofacturar"
                      >
     
                        <input type="hidden" name="codorden"value="<?php echo $data['codorden'] ?>">
                        <button type="submit" class="btn btn-teal">Solo facturar</button>
                      </form>

                        <form action="<?php echo base_url() ?>index.php/formatos/consentimiento/<?php echo $data['codorden'] ?>">
                            
                          <button id="buscar_generar"  class="btn btn-blue" >
                            <i class=""></i>Generar consentimiento informado
                          </button>                            
                          
                        </form>

                    </th>
                    
                  </tr>
                </thead>
              <?php
            }
            ?>


              <tr>
               
                <td colspan="3"><?php echo $data["nombre"] ?> - <?php echo $data["descripcion"] ?></td>
               

              </tr>


            <?php
          
          }//fin foreach 
          }//fin if


           ?>

          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>






</div>

