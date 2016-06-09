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
  	
  	$("#codempresa").val(code);
    $("#empresa").val(nite);
 
    $("#razonsocial").val(nome);
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
           if(nite=="") {
            nite="."
           }
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
            Nit
        </th>
        <th>
            Nombres
        </th>
        <th>
           Dirección
        </th>
    </tr>
<?php
if($empresas!='')
foreach ($empresas as $row){
    
   
        ?>
    <tr id="<?php echo $row['codigo'] ?>"  onDblClick='selectionTempe(this,"<?php echo $row['codigo'] ?>",
                                                                      "<?php echo $row['nit'] ?>",
                                                                      "<?php echo $row['nombre'] ?>",
                                                                      "<?php echo $row['direccion'] ?>"
                                                                      )'>
    <?php
        
    
?>
    
        <td class="hidden"> 
            <?php echo $row['codigo'] ?>
        </td>
        <td>
            <?php echo $row['nit'] ?>
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