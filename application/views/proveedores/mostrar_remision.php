<div>


<div class="row-fluid">
  <div class="span12">
    <div class="box box-color box-bordered yellow_smal">
      <div class="box-title">
        <h3>
          <i class="icon-table"></i>
          remision
        </h3>
      </div>
      <div class="box-content nopadding">
        <table class="table table-hover table-nomargin table-striped dataTable dataTable-reorder">
          
          

          <tbody>
          <?php 
          if($remision!=""){
            $head=0;
            $codremision=null;
          foreach ($remision as $data) {

            if($head==0  && $codremision!=$data['codremision']){
              $head==1;
              $codremision=$data['codremision'];
              ?>
                <thead>
                
                  <tr>
                    <th colspan>Codigo: <?php echo $data['codremision'] ?></th>
                    <th>Fecha:  <?php echo $data['fecha'] ?></th>
                    <th>
                      <form 
                        method="post" 
                        action="<?php echo base_url() ?>index.php/formatos/remision/<?php echo $data['codremision'] ?>"
                      >
     
                        <input type="hidden" name="codremision"value="<?php echo $data['codremision'] ?>">
                        <button type="submit" class="btn btn-teal">Mostrar pdf</button>
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

