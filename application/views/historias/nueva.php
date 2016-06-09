<!--
  10-> Audiometria tamiz
  12-> Visiometria tamiz
  13-> Espirometria
  16-> Prueba de esfuerzo
-->

<script>
var soloexamenes='<?php echo $soloexamenes ?>';
var codorden='<?php echo $codorden ?>';
$(document).ready(function() {

  $("#historia_clinica").validate();

  $("#tabs").tabs();
  load_data_form('tipo','load_tipo');
  load_data_form('informacion_ocupacional','load_informacion');
  load_data_form('habitos','load_habitos');
  load_data_form('antecedentes','load_antecedentes');
 
});

 

  function load_data_form(form,div){
    dataString="codorden="+codorden;
    $.ajax({
      url: '<?php echo base_url() ?>index.php/historias/load_data_form/'+form,
      type: 'post',
      data: dataString,
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
  action="<?php echo base_url() ?>index.php/historias/guardar_inicial"
  method="post"
  >

<input type="hidden" name="codorden" value="<?php echo $codorden ?>">
<input type="hidden" name="soloexamenes" value="<?php echo $soloexamenes ?>">


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
             
            <label>Antecedentes</label>

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





    </div>
    
   
    <br><br><br><br><br><br><br><br><br><br><br><br>
  </div>
</div>

</form>
