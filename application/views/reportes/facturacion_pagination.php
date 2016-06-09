<style>
    .glyphicon-delete{
        float: right;
    }

</style>


<table class="table table-striped">
	
	<thead>
		<tr>
			<th>Identificación</th>
			<th>Nombres y apellidos</th>
			<th>Fecha</th>
			<th>Examenes</th>
			<th>Valor</th>
		</tr>
	</thead>
	<tbody id="tbody_input">

<?php 

$codpaciente="";
$primero=0;
$subtotal=0;
$grantotal=0;
$cods_orden="";
$cods_act="";

$canti=0;
 //var_dump($contratos);

if($contratos!=""){
	foreach ($contratos as $data) {

		echo "<tr class='tr_".$data['codpaciente']."'>";
		if($codpaciente!=$data['codpaciente']){
			$cods_orden.=$data['codorden'].",";
			if($primero!=0){

				echo "<tr  class='tr_".$data['codpaciente']."' ><td></td><td></td>";
				echo "<td></td><td></td><td></td></tr>";
				//echo "<td>Subtotal</td>";
				//echo "<td>".$subtotal."</td></tr>";

			}else{
				$primero=1;
			}
			$subtotal=0;
			echo " <td  class='tr_".$data['codpaciente']."'>".$data['identificacion']."</td>";
			echo "<td  class='tr_".$data['codpaciente']."'>".$data['nombres']." ".$data['apellidos']."</td>";
			echo "<td  class='tr_".$data['codpaciente']."'></td><td colspan='2'  class='tr_".$data['codpaciente']."'>  <i class='glyphicon-delete' num='".$data['codpaciente']."'> Eliminar</i>  </td>";


			echo "<tr  class='tr_".$data['codpaciente']."' ><td></td><td></td>";
			echo "<td>".$data['fecha']."</td>";
			echo "<td>".$data['nomexamen']."</td>";
			echo "<td> <input class='edit_value' name='actividad".$canti."_".$data['codactividad']."_".$data['codorden']."' id='' value='".$data['valor']."' ></td></tr>";
			$subtotal=$subtotal+$data['valor'];
			$grantotal=$grantotal+$data['valor'];
            $cods_act.=$data['codactividad'].",";

		}else{
			echo "<td></td><td></td>";	
			echo "<td>".$data['fecha']."</td>";
			echo "<td>".$data['nomexamen']."</td>";
			echo "<td><input class='edit_value'  name='actividad".$canti."_".$data['codactividad']."_".$data['codorden']."' id='' value='".$data['valor']."' ></td>";
			$subtotal=$subtotal+$data['valor'];
			$grantotal=$grantotal+$data['valor'];
            $cods_act.=$data['codactividad'].",";
		}
		
		
		$codpaciente=$data['codpaciente'];
		echo "</tr>";

        $canti++;
	}

	echo "<tr class='tr_".$data['codpaciente']."'><td></td><td></td>";
	echo "<td></td></tr>";
	//echo "<td>Subtotal</td>";
    //echo "<td>".$subtotal."</td></tr>";
	///////////////////////////////////
	echo "<tr><td></td><td></td>";
	echo "<td></td>";
	echo "<td> Total</td>";
	echo "<td><strong><label id='lbl_total'>".$grantotal."</label></strong></td></tr>";


}else{
echo "No hay datos";

}
 ?>
 </tbody>
</table>

<input type="hidden"  name="total" value="<?php echo  $grantotal ?>">
<input type="hidden"  name="cod_orden" value="<?php echo  $cods_orden ?>">
<input type="hidden"  name="cods_act" value="<?php echo  $cods_act ?>">

<input type="hidden"  name="canti_actividades" value="<?php echo  $canti ?>">


<script>
 var total=0;
$(document).ready( function () {
    $('#example').dataTable( {
        "sDom": 'T<"clear">lfrtip',
        "oTableTools": {
            "sSwfPath": "<?php echo base_url() ?>tablepfd/copy_csv_xls_pdf.swf"
        }
    } );

    $(".edit_value").keyup(function(){
        update_total()
    })

    function update_total(){
        total=0;
        $("#tbody_input").find("input").each(function(){
            total+=parseInt($(this).val());

        })
        $("#lbl_total").text(total);
    }

    $(".glyphicon-delete").click(function(){

        $(".tr_"+$(this).attr("num")).remove();
        update_total()

    })

} );
</script>
