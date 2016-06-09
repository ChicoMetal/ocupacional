
<table class="table">
	
	<thead>
		<tr>
			<th colspan="2">Detalles del examen</th>
		</tr>
	</thead>
	<tbody>
		<tr>
      <td colspan="2">
	
<?php 
$codpadre="";

foreach ($resultado as $data) {

  if($codpadre!=$data['codpadre']){

    echo "</td></tr><tr class='alert alert-success'><td colspan='2'>".$data['nompadre']."</td></tr><tr><td>";
    
   
  }
  $codpadre=$data['codpadre'];


	if($data["tipo"]=="text"){

    echo "</td></tr><tr><td colspan='2'>".$data['pregunta']."</td></tr><tr><td>";
	   $campoval=array_filter(explode('<div class="respuestas" >',$data['campos']));
    $campovalres=array_filter(explode('<div class="respuestas" >',$data['respuestas']));


          $cont=1;
          foreach ($campoval as $campo) {
            $campo=str_replace("</div>", "", $campo);
                
            $campovalres[$cont]=str_replace("</div>", "", $campovalres[$cont]);
            
            ?>
            
              <div class="span4">
                <?php echo $campo ?>
              
                <input 
                  type="text" 
                  readonly
                  name="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                  id="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                  value="<?php echo $campovalres[$cont] ?>">
              
              </div>
            
           

            <?php
            $cont++;
          }


          ?>
          <input type="hidden" name="canti-text-<?php echo $data['codpregunta'] ?>" value="<?php echo $cont ?>" placeholder="">

          <?php


	}else if($data["tipo"]=="radio"){

    
      $cont=1;
      $campovalres=array_filter(explode('<div class="respuestas" >',$data['respuestas']));
      
      $campovalres[$cont]=str_replace("</div>", "", $campovalres[$cont]);
      $campovalres[$cont]=str_replace("</div>", "", $campovalres[$cont]);
        
        ?>
        
          
          </td></tr><tr>

          <td colspan='2'>
            <div class="span6"><?php echo $data['pregunta'] ?></div>
            <div class="span6">
            <input 
                type="text" 
                readonly
                name="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                id="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                value="<?php echo $campovalres[$cont] ?>">
          </div>
        </td></tr><tr><td>
          
            
          
        
       

        <?php
        $cont++;
    

      ?>
      <input type="hidden" name="canti-text-<?php echo $data['codpregunta'] ?>" value="<?php echo $cont ?>" placeholder="">

      <?php
 
  }else if($data["tipo"]=="select"){

    
      $cont=1;
      $campovalres=array_filter(explode('<div class="respuestas" >',$data['respuestas']));
      
      $campovalres[$cont]=str_replace("</div>", "", $campovalres[$cont]);
      $campovalres[$cont]=str_replace("</div>", "", $campovalres[$cont]);
        
        ?>
        
          
          </td></tr><tr>

          <td colspan='2'>
            <div class="span6"><?php echo $data['pregunta'] ?></div>
            <div class="span6">
            <input 
                type="text" 
                readonly
                name="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                id="<?php echo 'otrexam-text-'.$data['codpregunta']."-".$cont ?>"
                value="<?php echo $campovalres[$cont] ?>">
          </div>
        </td></tr><tr><td>
          
            
          
        
       

        <?php
        $cont++;
    

      ?>
      <input type="hidden" name="canti-text-<?php echo $data['codpregunta'] ?>" value="<?php echo $cont ?>" placeholder="">

      <?php
 
  }else if($data["tipo"]=="checkbox"){

    echo "</td></tr><tr><td colspan='2'>".$data['pregunta']."</td></tr><tr><td>";
    $campovalres=array_filter(explode('<div class="respuestas" >',$data['respuestas']));
   

          $cont=1;
          foreach ($campovalres as $campo) {
            $campo=str_replace("</div>", "", $campo);
                
            $campovalres[$cont]=str_replace("</div>", "", $campovalres[$cont]);
            
            ?>
            
              <div class="span4">
               <?php echo $campo ?>
              </div>
            
           

            <?php
            $cont++;
          }


          ?>
          <input type="hidden" name="otrexam-checkboxres-<?php echo $data['codpregunta'] ?>" value="<?php echo $cont ?>" placeholder="">

          <?php


  }
}

 ?>
 </tbody>
</table>