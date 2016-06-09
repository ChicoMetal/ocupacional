<script>
  $(document).ready(function(){


    $("#btn-antecedentes").click(function(){
      $("#dilog_show").dialog("open");
      
      $("#nombre_edit").text("Cambio de tipo de examen");

      var dataString="codhistoria="+$("#codhistoria").val();
      $.ajax({
        url: '<?php echo base_url() ?>index.php/antecedentes/change_historia/',
        type: 'post',
        data: dataString,
        success: function (data) {
         
          $("#load_edit_datos").html(data);
        },
        error: function(data){
          alert("Error al cargar un formulario "+form);
        }
      });
  

    });

  });

</script>

<h4>..</h4>

<div class="span12">
	<p>
		<H3>
			Antecedentes
	</H3>
	</p>
<button 
	type="button"
	id="btn-antecedentes"
	class="btn btn-magenta"
	>
	Cambiar
</button>

</div>

			<div class="span12">

<?php 
$tipo="";
$primera=0;
if($data!="")
foreach ($data as $datos) {
	if($tipo!=$datos['tipo']){
		if($primera==1){
			echo "</div></div></div></div>";

		}
		$primera=1;			
		?>

			<div class="span10">
				<div class="box box-color" >
					<div class="box-title">
						<h3>
							Antecedentes <?php echo $datos['tipo'] ?>
							
						</h3>
					</div>

					<div class="box-content" >


		<?php
		}
		$tipo=$datos['tipo'];
		
?>
	

<?php


?>
	<div class="span12">
		<div class="span6">
			<?php echo $datos['nombre']?>: 
		</div>
		<div class="span4"><?php echo $datos['observacion']?></div>
	</div>

	



<?php

}

 ?>

 			</div>
		</div>
	</div>
</div>

<div class="span12"></div>