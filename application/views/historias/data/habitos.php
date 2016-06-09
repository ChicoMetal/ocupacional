



<div class="row-fluid">
  <div class="box">
      <div class="box box-color box-bordered magenta">
        <h3>
          
          Fumador
        </h3>
      </div>
      <div class="box-content">
        <div class="span5">
         <label for="textfield" class="control-label">Fumador</label>
          <div class="controls">
              <select name="fumador" id="fumador"> 
                <option value="no fuma">No fuma</option>
                <option value="fuma">Fuma</option>
                <option value="ex fuma">Exfumador</option>
              </select>
         </div>
        
      </div>
      <div class="span5">  
        
          <label for="textfield" class="control-label">Frecuencia (Cigarrillos/Dia)</label>
          <div class="controls">
             <input type="number" name="fuma_frecuencia" id="fuma_frecuencia">
          </div>
        
      </div>
      <div class="span5"> 
        
          <label for="textfield" class="control-label">Años de consumo</label>
          <div class="controls">
             <input type="text" name="fuma_anios" id="fuma_anios">
          </div>
        
      </div>
      <div class="span5"> 

        
          <label for="textfield" class="control-label">
            Tipo
          </label>
          <div class="controls">
            <select
              name="fuma_tipo" 
              id="fuma_tipo" 
              
              class="input-xlarge"
              value="<?php echo set_value('descripcion') ?>"
              data-rule-required="true"
              data-rule-maxlength="40"
              >
              
              <option  value="diario"> Diario </option>
              <option  value="ocasional"> Ocasional </option>
            </select>

          </div>
       



        </div>
      </div>
</div>

<div class="row-fluid">
  <div class="box">
      <div class="box box-color box-bordered magenta">
        <h3>
          
          Alcohol
        </h3>
      </div>
      <div class="box-content">
        <div class="span5">
         <label for="textfield" class="control-label">Alcohol</label>
          <div class="controls">
              <select name="alcohol" id="alcohol">
                <option value="bebe">Bebe</option>
                <option value="no bebe">No bebe</option>
                <option value="ex bebe">Ex bebedor</option>

              </select>


          </div>
        
      </div>
      <div class="span5">  
        
          <label for="textfield" class="control-label">Frecuencia</label>
          <div class="controls">
              <select name="alcohol_frecuencia" id="alcohol_frecuencia">
              
                <option  value="diario"> Diario </option>
                <option  value="semanal"> Semanal </option>
                <option  value="quincenal"> Quincenal </option>
                <option  value="mensual"> Mensual </option>
                <option  value="ocacional"> Ocacional </option>
            </select>
          </div>
       
      </div>

      <div class="span12"> 
        
      </div>
      |</div>
  </div>
</div>
  
  <div class="row-fluid">
    <div class="box">
        <div class="box box-color box-bordered magenta">
          <h3>
            
            Deportes
          </h3>
        </div>
        <div class="box-content">

          <div class="span5">
            
            
            
              <label for="textfield" class="control-label">Deportes</label>
              <div class="controls">
                  <select name="deportes" id="deportes">
                    <option value="deportista">Deportista</option>
                    <option value="no deportista">no deportista</option>
                    <option value="ex deportista">Ex deportista</option>

                  </select>


              </div>
            
          </div>
          <div class="span5">  
            
              <label for="textfield" class="control-label">Frecuencia </label>
              <div class="controls">
                <select name="deportes_frecuencia" id="deportes_frecuencia">
                  
                  <option  value="diario"> Diario </option>
                  <option  value="semanal"> Semanal </option>
                  <option  value="quincenal"> Quincenal </option>
                  <option  value="mensual"> Mensual </option>
                  <option  value="ocacional"> Ocacional </option>
                </select>
              </div>
           
          </div>


          <div class="span5"> 
            
              <label for="textfield" class="control-label">Lesiones</label>
              <div class="controls">
                <select name="lesiones" id="lesiones">
                  
                  <option  value="si"> Si </option>
                  <option  value="no"> no </option>
               
                </select>
              </div>
            
          </div>
          <div class="span5"> 
           
              <label for="textfield" class="control-label">Observaciones</label>
              <div class="controls">
                <textarea name="hab-observaciones" id="hab-observaciones"></textarea>
              </div>
          
          </div>


        </div>
      </div>
  </div>
</div>
