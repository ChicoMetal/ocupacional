<!--
  10-> Audiometria tamiz
  12-> Visiometria tamiz
  13-> Espirometria
  16-> Prueba de esfuerzo
-->

<script>
var soloexamenes='<?php echo $soloexamenes ?>';

$(document).ready(function() {
  $("#tabs").tabs();
  //mostrar_datos();
  //cualmostrar();
  
      load_data_form('informacion_ocupacional','load_informacion');
      load_data_form('habitos','load_habitos');
      load_data_form('antecedentes','load_antecedentes');
      load_data_form('factores','load_factores');
      load_data_form('revision_por_sistema','load_revision_por_sistema');
      load_data_form('examen_fisico','load_examen_fisico');
      load_data_form('examen_fisico_osteo','load_examen_fisico_osteo');
      load_data_form('examen_de_alto_riesgo','load_examen_de_alto_riesgo');
      load_data_form('tipo_examenes','load_tipo_examenes');
      load_data_form('concepto_actitud_medica_ocupcional','load_concepto_actitud_medica_ocupcional');
      load_data_form('recomendaciones_laborales','load_recomendaciones_laborales');

      load_data_form('audiometria','load_audiometria');
      load_data_form('visiometria','load_visiometria');

});

 function ocultarhistoria(){
  /*
    $("#tab_paciente").hide();
    $("#tab_informacion").hide();
    $("#tab_habitos").hide();
    $("#tab_antecedentes").hide();
    $("#tab_factores").hide();
    $("#tab_revision").hide();
    $("#tab_examenfisico").hide();
    $("#tab_examenfisicoosteo").hide();
    $("#tab_examen_de_alto_riesgo").hide();
    */
    
 }

  function mostrar_datos(){
    load_data_form('tipo','load_tipo');
    if(soloexamenes=="si"){
      
       ocultarhistoria();
    }else{
        
        
      
       
      

    }


  }
  

  function cualmostrar(){

      <?php 
        $visiometria=false;
        $audiometria=false;
        $espirometria=false;
        $esfuerzo=false;
        //Recorro codigos de los examenes para ver cual es se va
        //a hacer

        foreach ($cualesexamenes as $datos) {
          if($datos['codactividad']=="10" ){
            $audiometria=true;
           
          }else if($datos['codactividad']=="12"){
            $visiometria=true;
            
          }else if($datos['codactividad']=="13"){
            $espirometria=true;
            
          }else if($datos['codactividad']=="16"){
            $esfuerzo=true;
            
          }
        }

        if($audiometria){
        
           ?>
           
              $("#tab_audiometria label").text("Audiometria");
              load_data_form('audiometria','load_audiometria');
            <?php
        }else{
          
          ?>
          
            $("#tab_audiometria").hide();
            $("#audiometria").hide();
          <?php
        }
        if($visiometria){
          ?>
            $("#tab_visiometria label").text("Visiometria");
            load_data_form('visiometria','load_visiometria');
          <?php
        }else{
          ?>
            $("#tab_visiometria").hide();
          <?php
        }
        if($espirometria){
          ?>
            $("#tab_espirometria label").text("Espirometria");
            load_data_form('espirometria','load_espirometria');
          <?php
        }else{
          ?>
            $("#tab_espirometria").hide();
          <?php
        }


       ?>


    <?php 
        $cod_cualesexamenes="";
        foreach ($cualesexamenes as $datos) {
          $cod_cualesexamenes=$cod_cualesexamenes.$datos['codactividad'].",";
          if($datos['codactividad']=="10" ){
            ?>
             
              
            <?php
          }else if($datos['codactividad']=="12"){
            ?>
              
             //

            <?php
          }else if($datos['codactividad']=="16"){
            ?>
              $("#tab_examenfisicoosteo").hide();
              $("#tab_examen_de_alto_riesgo").hide();
            
             //load_data_form('visiometria','load_visiometria');

            <?php
          }
        }

       ?>

      load_data_form('informacion_ocupacional','load_informacion');
      load_data_form('habitos','load_habitos');
      load_data_form('antecedentes','load_antecedentes');
      load_data_form('factores','load_factores');
      load_data_form('revision_por_sistema','load_revision_por_sistema');
      load_data_form('examen_fisico','load_examen_fisico');
      load_data_form('examen_fisico_osteo','load_examen_fisico_osteo');
      load_data_form('examen_de_alto_riesgo','load_examen_de_alto_riesgo');
      load_data_form('tipo_examenes','load_tipo_examenes');
      load_data_form('concepto_actitud_medica_ocupcional','load_concepto_actitud_medica_ocupcional');
      load_data_form('recomendaciones_laborales','load_recomendaciones_laborales');

      load_data_form('audiometria','load_audiometria');
      load_data_form('visiometria','load_visiometria');

  }

  function load_data_form(form,div){
    $.ajax({
      url: '<?php echo base_url() ?>index.php/historias/load_data_form/'+form,
      type: 'post',
      data: {},
      success: function (data) {
        $("#"+div).html(data);
      },
      error: function(data){
        alert("Error al cargar un formulario "+form);
      }
    });
  
  }


</script>

<div class="container">

<form 
  id="historia_clinica" 
  class='form-horizontal form-column form-bordered'
  action="<?php echo base_url() ?>index.php/historias/guardar"
  method="post"
  >

<input type="hidden" name="codorden" value="<?php echo $codorden ?>">
<input type="hidden" name="soloexamenes" value="<?php echo $soloexamenes ?>">
<input type="hidden" name="cod_cualesexamenes" value="<?php echo  $cod_cualesexamenes ?>">


<div class="box box-bordered box-color <?php echo $color ?>">
  <div class="box-title">
    <h3>HISTORIA CLINICA OCUPACIONAL     <button type="submit" class="btn btn-darkblue right">Guardar</button></h3>
  </div>
  <div class="box-content nopadding">

    <div class="tabs-container">

      <ul class="tabs tabs-inline tabs-left">
        <li id="tab_tipo">
          <a href="#tipo" data-toggle='tab'>
            <label>Tipo de examen</label>
            
          </a>
        </li>
        <li id="tab_paciente">
          <a href="#paciente"  data-toggle='tab'>
             <label>Datos personales</label>
            
      
          </a>
        </li>
        <li id="tab_informacion">
          <a href="#informacion" data-toggle='tab'>
             <label>Información ocupacional</label>
             
          </a>
        </li>
        <li id="tab_habitos">
          <a href="#habitos" data-toggle='tab'>
            <label>Hábitos</label>
            
       
          </a>
        </li>
        <li id="tab_antecedentes">
          <a href="#antecedentes" data-toggle='tab'>
             
            <label>Antecedentes personales</label>

          </a>
        </li>
        <li id="tab_factores">
          <a href="#factores" data-toggle='tab'>
            
       
            <label>Factores de riesgo</label>
          </a>
        </li>
        <li id="tab_revision">
          <a href="#revision" data-toggle='tab'>
            
            <label>Revision por sistema</label>

          </a>
        </li>
        
        <li id="tab_examenfisicoosteo">
          <a href="#examenfisicoosteo" data-toggle='tab'>
            
            <label>Examen físico osteo muscular</label>

          </a>
        </li>
        <li id="tab_examen_de_alto_riesgo">
          <a href="#examen_de_alto_riesgo" data-toggle='tab'>
            
            <label>Examen de alto riesgo</label>
          </a>
        </li>

        <li id="tab_examenfisico">
          <a href="#examenfisico" data-toggle='tab'>
         
            <label>Examen físico</label>
          </a>
        </li>

        <li id="tab_audiometria">
          <a href="#audiometria" data-toggle='tab'>
            
            <label>Audiometria</label>
          </a>
        </li>
       
        <li id="tab_visiometria">
          <a href="#visiometria" data-toggle='tab'>
            
           <label >Visiometria</label>
          </a>
        </li>
    
        <li id="tab_espirometria">
          <a href="#espirometria" data-toggle='tab'>
            
           <label >Espirometria</label>
          </a>
        </li>
    

      </ul>
    </div>

    <div class="tab-content padding tab-content-inline">
      <div class="tab-pane active" id="tipo">
          <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('tipo','load_tipo');"
          >
          Recargar este formulario
        </button>
          <div id="load_tipo"><div problemas></div></div>       
       
      </div>

      <div class="tab-pane" id="paciente">
        
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
                    class="input-medium"
                    >
              </td>

            </tr>
            <tr>
              <td>Nombres</td>
              <td colspan="3">

                <?php echo $data['nombres'] ?>
              </td>
              <td>Apellidos</td>
              <td colspan="3"><?php echo $data['apellidos'] ?></td>
            </tr>
            <tr>
              <td>Cédula</td>
              <td>
                <?php echo $data['identificacion']; ?>
                <input  type="hidden" name="idpaciente" value="<?php echo $data['codigo']; ?>">

              </td>
              <td>Edad</td>
              <td><?php echo $edad; ?> años</td>
              <td>Sexo</td>
              <td><?php echo $data['sexo']; ?></td>
              <td>No de hijos</td>
              <td>
                <input type="hidden" name="pac_numhijos" value=" <?php echo $data['numhijos']; ?>">
                <?php echo $data['numhijos']; ?>
              </td>

            </tr>
            <tr>
              <td>
                Estado civil
              </td>
              <td>
                <input type="hidden" name="pac_estadocivil" value=" <?php echo $data['estadocivil']; ?>">
                <?php echo $data['estadocivil']; ?>
              </td>
              <td>
                Escolaridad
              </td>
              <td>
                <input type="hidden" name="pac_escolaridad" value=" <?php echo $data['escolaridad']; ?>">
                <?php echo $data['escolaridad']; ?>
              </td>
              <td>
                Completa
              </td>
              <td colspan ="3">
                <input type="hidden" name="pac_escolaridad_completa" value=" <?php echo $data['escolaridad_completa']; ?>">
                <?php echo $data['escolaridad_completa']; ?>
              </td>
            </tr>
            <tr>
              <td>
                EPS
              </td>
              <td>
                <input type="text" value="<?php echo $data['eps']; ?>" name="eps" class="input-medium">
              </td>
              <td>
                AFP
              </td>
              <td>
                <input type="text" name="afp" value="<?php echo $data['afp']; ?>" class="input-medium">
              </td>
              <td>
                ARP
              </td>
              <td colspan="3">
                <input type="text" name="arp" value="<?php echo $data['arp']; ?>" class="input-medium">
              </td>
            </tr>

            <input 
              type="hidden" 
              name="pac_telefono" 
              value=" <?php echo $data['telefono']; ?>">
            <input 
              type="hidden" 
              name="pac_celular" 
              value=" <?php echo $data['celular']; ?>">

            <input 
              type="hidden" 
              name="pac_estadocivil" 
              value=" <?php echo $data['estadocivil']; ?>">


            <input 
              type="hidden" 
              name="pac_email" 
              value=" <?php echo $data['email']; ?>">


            <?php
          }
         ?>
       </tbody>
      </table>
    


      </div>

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
      <div class="tab-pane" id="habitos">
         <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('habitos','load_habitos');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
       
        <div id="load_habitos">
          <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
        </div>

      </div>
      <div class="tab-pane" id="antecedentes">
         <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('antecedentes','load_antecedentes');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
 
        <div id="load_antecedentes">
          <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
        </div>
      </div>
      <div class="tab-pane" id="factores">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('factores','load_factores');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
       
        <div id="load_factores">
          <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
        </div>
      </div>
     
      <div class="tab-pane" id="revision">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('revision_por_sistema','load_revision_por_sistema');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
       
        <div id="load_revision_por_sistema">
          <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
        </div>
        
      </div>

       <div class="tab-pane" id="examenfisico">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('examen_fisico','load_examen_fisico');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
       
          <div id="load_examen_fisico">
            <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
          </div>
      </div>

      <div  class="tab-pane" id="examenfisicoosteo">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('examen_fisico_osteo','load_examen_fisico_osteo');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
       
        <div id="load_examen_fisico_osteo">
          <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
        </div>

      </div><!--End examen fisico osteo-->

      <div class="tab-pane" id="examen_de_alto_riesgo">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('examen_de_alto_riesgo','load_examen_de_alto_riesgo');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
      
          <div id="load_examen_de_alto_riesgo">
            <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
          </div>

      </div>


      <div class="tab-pane" id="visiometria">
         <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('visiometria','load_visiometria');"
          >
          Recargar este formulario
        </button>
    
          
        <div id="load_visiometria">
          Hubo  problemas al cargar este formulario porfavor presione el boton de recargar 
        </div>


      </div>



      <div class="tab-pane" id="audiometria">
         <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('audiometria','load_audiometria');"
          >
          Recargar este formulario
        </button>
    
          
        <div id="load_audiometria">
          Hubo  problemas al cargar este formulario porfavor presione el boton de recargar 
        </div>


      </div>
      
      <div class="tab-pane" id="espirometria">
         <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('espirometria','load_espirometria');"
          >
          Recargar este formulario
        </button>
    
          
        <div id="load_espirometria">
          Hubo  problemas al cargar este formulario porfavor presione el boton de recargar 
        </div>


      </div>










    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
  </div>
</div>

</form>
