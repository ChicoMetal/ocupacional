<!--
  10-> Audiometria tamiz
  12-> Visiometria tamiz
  13-> Espirometria
  16-> Prueba de esfuerzo
-->

<script>


$(document).ready(function() {
$("#dilog_show").dialog({
    modal: true,
    autoOpen: false,
    height: 460,
    width: 800,
    resizable: false 
    });


  $("#tabs").tabs();

  load_data_form_edit('tipo','load_tipo');
  load_data_form_edit('datos_paciente','load_datos_paciente');
  load_data_form_edit('informacion_ocupacional','load_informacion');
  load_data_form_edit('habitos','load_habitos');
  load_data_form_edit('antecedentes','load_antecedentes');
  

  
  load_data_form('factores','load_factores');
  load_data_form('revision_por_sistema','load_revision_por_sistema');
  load_data_form('examen_fisico','load_examen_fisico');
  load_data_form('antecedentes_laborales','load_antecedentes_laborales');
  load_data_form('accidentes_de_trabajo','load_accidentes_de_trabajo');
  
  load_data_form('diagnostico','load_diagnostico');

});



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


  function load_data_form_edit(form,div){
    var dataString="codhistoria=<?php echo $codhistoria ?>";
    $.ajax({
      url: '<?php echo base_url() ?>index.php/historias/edit_data_form/'+form,
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
  action="<?php echo base_url() ?>index.php/historias/guardar_examenfisico"
  method="post"
  >

<input type="hidden" name="codhistoria" value="<?php echo $codhistoria ?>">
<input type="hidden" name="codorden" value="<?php echo $codorden ?>">

<div class="box box-bordered box-color <?php echo $color ?>">
  <div class="box-title">
    <h3>HISTORIA CLINICA OCUPACIONAL     <button type="submit" class="btn btn-darkblue right">Guardar</button></h3>
  </div>
  <div class="box-content nopadding">

    <div class="tabs-container">

      <ul class="tabs tabs-inline tabs-left">

        <li id="tab_historia">
          <a href="#historia_show" data-toggle='tab'>Datos básicos</a>
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
        
      
        <li id="tab_examenfisico">
          <a href="#examenfisico" data-toggle='tab'>
         
            <label>Examen físico</label>
          </a>
        </li>

        <li id="tab_antecedentes_laborales">
          <a href="#antecedentes_laborales" data-toggle='tab'>
         
            <label>Antecedentes laborales</label>
          </a>
        </li>


        <li id="tab_accidentes_de_trabajo">
          <a href="#accidentes_de_trabajo" data-toggle='tab'>
         
            <label>Accidentes de trabajo</label>
          </a>
        </li>


        <li id="tab_diagnostico">
          <a href="#diagnostico" data-toggle='tab'>
         
            <label>Diagnostico</label>
          </a>
        </li>

        

      </ul>
    </div>

    <div class="tab-content padding tab-content-inline">
      <div class="tab-pane active" id="historia_show">
          <button 
          type="button"
          class="btn btn-primary"
          onclick="load_historia();"
          >
          Recargar este formulario
        </button>
          
          <div id="load_tipo" ></div>
          <div id="load_datos_paciente" ></div>
          <div id="load_informacion" ></div>
          <div id="load_habitos" ></div>
          <div id="load_antecedentes" ></div>
      
      
       
      </div>
      <div class="tab-pane" id="factores">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('factores','load_factores');"
          >
          Recargar este formulario
        </button>
    
                
       
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

      <div class="tab-pane" id="antecedentes_laborales">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('antecedentes_laborales','load_antecedentes_laborales');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
       
          <div id="load_antecedentes_laborales">
            <div problemas>Hubo  problemas al cargar este formulario porfavor presione el boton de recargar </div>
          </div>
      </div>

      <div class="tab-pane" id="accidentes_de_trabajo">
        <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('accidentes_de_trabajo','load_accidentes_de_trabajo');"
          >
          Recargar este formulario
        </button>
    
          <div id="load_tipo"></div>       
       
          <div id="load_accidentes_de_trabajo">
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


      <div class="tab-pane" id="diagnostico">
         <button 
          type="button"
          class="btn btn-primary"
          onclick="load_data_form('diagnostico','load_diagnostico');"
          >
          Recargar este formulario
        </button>
    
          
        <div id="load_diagnostico">
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





<div id="dilog_show" title="Cambios">
  <div class="box box-bordered">
    <div class="box-title">
      <h3>
      <label for="nombre_edit" id="nombre_edit"></label>
      
      </h3>
      
    </div>
    <div class="box-content">
      <div class="tab-content">
        
        <div id="load_edit_datos">
        </div>

      </div>
    </div>
  </div>


</div>