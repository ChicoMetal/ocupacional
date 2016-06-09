
  <script>
  
      $(document).ready(function () {
            $("#load_pacientes").load("<?php echo base_url() ?>index.php/pacientes/nuevo");
            
        });
  </script>

        
    <script  type="text/javascript" >
           
      </script>

<div id="breadcrumb">
    <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Inicio</a>
    <a href="#" class="current">Dashboard</a>
</div>



<div class="container-fluid">
<div class="row-fluid">
<div class="span12 center" style="text-align: center;">             

<!--
    <div class="alert alert-info">
        Bienbenido <strong><?php echo $ses['usr_nombre'] ?></strong>.
        <a href="#" data-dismiss="alert" class="close">×</a>
    </div>
-->
<div class="row-fluid">
    <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-signal"></i>
                </span>
                <h5>Menu</h5>
               
            </div>
            <div class="widget-content">
                
               <div class="row-fluid">
                    <div class="span12 center" style="text-align: center;">                 
                        <ul class="quick-actions">
                            

                            
                        </ul>
                    </div>  
                </div>

            </div>  
        </div>                          
    </div>
        </div>                  
</div>







</div>
</div>
</div>




<div id="myModal" class="modal hide">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3>Registro de nuevo paciente</h3>
    </div>
    <div class="modal-body">
        <div id="load_pacientes">
                
        </div>


    </div>
</div>