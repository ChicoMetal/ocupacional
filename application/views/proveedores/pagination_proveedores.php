<style type="text/css" media="screen">
    table tr:hover{
      cursor: pointer;
    }
</style>

<script>
var cli=<?php echo $quien ?>;    
    
var oldObje="reset"; code=0,nite="",nome="",dir="";
function  chooseOptione(){

  if(code!=0){ 
  	
  	$("#codproveedor").val(code);
    $("#codigo").val(code);
 
    $("#nombre").val(nome);
    changetext();
          
  	 $("#dilog_busueda").dialog("close");
     

  }
}
function  selectionTempe(obj,cod1,nit1,Nom1,tel1){
         //alert(cod+" "+cod1);
          // alert( $("#"+id).css("background"));


          if(code!=0){
              $(oldObje).css("background","#fff");
           
          }
          oldObje=obj;
          code=cod1;
           nome=Nom1;
           nite=nit1;
          tel=tel1;
          //alert(cod+" "+cod1);
       
          $(obj).css("background","#56AF45" );

         chooseOptione();
}



</script>



<div id="reset"></div>
<table  id="tabla_select" class="table">
    <tr>
        <th class="hidden">
            Codigo
        </th>
        <th>
            Nombres
        </th>
        <th>
            Direccion
        </th>
        
        <th>
           Dirección
        </th>
    </tr>
<?php
if($proveedores!='')
foreach ($proveedores as $row){
    
   
        ?>
    <tr id="<?php echo $row['codigo'] ?>"  onDblClick='selectionTempe(this,"<?php echo $row['codigo'] ?>",
                                                                      "<?php echo $row['direccion'] ?>",
                                                                      "<?php echo $row['nombre'] ?>",
                                                                      "<?php echo $row['direccion'] ?>"
                                                                      )'>
    <?php
        
    
?>
    
        <td class="hidden"> 
            <?php echo $row['codigo'] ?>
        </td>
        <td>
            <?php echo $row['direccion'] ?>
        </td>
        <td>
            <?php echo $row['nombre'] ?>
        </td>
        <td>
            <?php echo $row['direccion'] ?>
        </td>
        
    </tr> 
    
<?php    
}

?>
</table>