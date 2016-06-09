<?php 
$codnombre="";
$primero=0;
$cods_otros_exam="";
//var_dump($cuestionario);

foreach ($cuestionario as $data) {
  $cods_otros_exam=$cods_otros_exam.$data['codpregunta'].",";
  //echo " a=".$codnombre." db:".$data['codnombre']."<br>";
  if($codnombre!=$data['codnombre']){

    if($primero!=0){
      
      ?>
      </tbody>
      </table>
      <table>
        <thead>
          <th colspan="3"><?php echo $data['nombre'] ?></th>
        </thead>
        <tbody>
      <?php

    }else{
      //echo "primero";
     //$primero++;
      ?>

      </tbody>
      </table>
      <table  class="table">
        <thead>
          <th colspan="3"><?php echo $data['nombre'] ?></th>
        </thead>
        <tbody>

        


      <?php
    }

  }

  ?>
    <tr>
      <td><?php echo $data['pregunta'] ?></td>
      <td>
        <?php 
        if($data['tipo']=="text"){
          //echo "<br>campos:".$data['campos']; 
          $campoval=array_filter(explode('<div class="respuestas" >',$data['campos']));
                      
          $cont=0;
          foreach ($campoval as $campo) {
            $campo=str_replace("</div>", "", $campo);
            //echo "<br>campos:".$campo;    

            
            ?>
              <div class="span6">
                <label for="textfield" class="control-label">
                  <?php echo $campo ?>
                </label>
                <div class="controls">
              
              
              <input 
                type="text" 
                name="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                id="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                value="<?php echo $data['valorpordefecto'] ?>"

              >
              </div>
            </div>

            <?php
            $cont++;
          }


          ?>
          <div class="span12">
            <input type="hidden" name="canti-text-<?php echo $data['codpregunta'] ?>" value="<?php echo $cont ?>" placeholder="">
          </div>
          <?php


        }else if($data['tipo']=="radio"){
          $campoval=array_filter(explode('<div class="respuestas" >',$data['campos']));
          
          
          foreach ($campoval as $campo) {
            $campo=str_replace("</div>", "", $campo);
            $pos = strpos($campo, '&lt;=');
            $campo=str_replace("&lt;=", "", $campo);
           
            $selected="";

            if ($pos !== false) {
              $selected="checked";
              //echo "wwiiiii";
            }else{
              //echo "wooo";
              $selected="";
            }
            ?>
                 <?php echo $campo ?>
              
              
           
              <input 
                type="radio" 
                name="<?php echo 'otrexam-radio-'.$data['codpregunta'] ?>"
                id="<?php echo 'otrexam-radio-'.$data['codpregunta'] ?>"
                value="<?php echo trim($campo) ?>"
                <?php echo $selected ?>
                >
                
            <?php
          }
        }else if($data['tipo']=="checkbox"){
          //echo "<br>campos:".$data['campos']; 
          $campoval=array_filter(explode('<div class="respuestas" >',$data['campos']));
                      
          $cont=0;
          foreach ($campoval as $campo) {
            $campo=str_replace("</div>", "", $campo);
            $pos = strpos($campo, '&lt;=');
            $campo=str_replace("&lt;=", "", $campo);
           
            $selected="";

            if ($pos !== false) {
              $selected="checked";
              //echo "wwiiiii";
            }else{
              //echo "wooo";
              $selected="";
            }
            
            ?>
              <div class="span6">
                <label for="textfield" class="control-label">
                <?php echo $campo ?>
                </label>
                <div class="controls">
              
              <input 
                type="checkbox" 
                name="<?php echo 'otrexam-checkbox-'.$data['codpregunta']."-".$cont ?>"
                id="<?php echo 'otrexam-checkbox-'.$data['codpregunta']."-".$cont ?>"
                value="<?php echo trim($campo) ?>"
                <?php echo $selected ?>
                >
           </div>
           </div>

            <?php
            $cont++;
          }


          ?>
          <input type="hidden" name="canti-checkbox-<?php echo $data['codpregunta'] ?>" value="<?php echo $cont ?>" placeholder="">

          <?php


        }else if($data['tipo']=="select"){
          $campoval=array_filter(explode('<div class="respuestas" >',$data['campos']));
          
          $primero=0;
          foreach ($campoval as $campo) {
            $campo=str_replace("</div>", "", $campo);
            $pos = strpos($campo, '&lt;=');
            $campo=str_replace("&lt;=", "", $campo);
           
            $selected="";

            if($primero==0){
              $primero=1;
              ?>

              <select 
                
                name="<?php echo 'otrexam-select-'.$data['codpregunta'] ?>"
                id="<?php echo 'otrexam-select-'.$data['codpregunta'] ?>"
              >
              <?php

            }

            if ($pos !== false) {
              $selected="selected";
              //echo "wwiiiii";
            }else{
              //echo "wooo";
              $selected="";
            }
            ?>
              
              
              <option 
                value="<?php echo trim($campo) ?>"
                <?php echo $selected ?>
                ><?php echo trim($campo) ?></option>

            <?php
          }
          echo "</select>";
        }

         ?>
      </td>
      <td>
        <?php 
          if($data['observacion']=="si"){
            ?>
            Observación
            <textarea name="observacion-<?php echo $data['codpregunta'] ?>"></textarea>
            <?php
          }
         ?>
      </td>
    </tr>

<?php

$codnombre=$data['codnombre'];
}



 ?>
<input type="hidden" name="cods_otros_exam" value="<?php echo $cods_otros_exam ?>">

<!--
<div class="tabs-container">

      <ul class="tabs tabs-inline tabs-left">
        
        <li id="tab_antecedentes">
          <a href="#antecedentes" data-toggle='tab'>
            <label>Antecedentes</label>
          </a>
        </li>
      </ul>
    </div>

    <div class="tab-content padding tab-content-inline">

      <div class="tab-pane" id="informacion">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('informacion_ocupacional','load_informacion');"
          >
          Recargar este formulario
        </button>
   
      <div id="load_informacion"></div>


      </div>



    </div>
    
   
    <br><br><br><br><br><br>

  </div>
  -->