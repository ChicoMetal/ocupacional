<style type="text/css" media="screen">
    table tr:hover{
      cursor: pointer;
    }
</style>

<script>
var cli=1;    
    
var oldObj="reset"; cod=0,iden="",nom="",ape="";
function  chooseOption(){

  if(cod!=0){ 
  	
  	$("#codpaciente").val(cod);
    $("#nombres").val(nom+" "+ape);
    $("#paciente").val(iden);
  
   
    changetext();
          
  	 $("#dialog_busueda_pacientes").dialog("close");
     

  }
}
function  selectionTemp(obj,cod1,nit1,Nom1,tel1){
         //alert(cod+" "+cod1);
          // alert( $("#"+id).css("background"));


          if(cod!=0){
              $(oldObj).css("background","#fff");
           
          }
          oldObj=obj;
          cod=cod1;
           nom=Nom1;
           iden=nit1;
          ape=tel1;
          //alert(cod+" "+cod1);
       
          $(obj).css("background","#56AF45" );

         chooseOption();
}



</script>



<div id="reset"></div>
<table  id="tabla_select" class="table">
    <tr>
        <th class="hidden">
            Codigo
        </th>
        <th>
            Identificación
        </th>
        <th>
            Nombres
        </th>
        <th>
           Apellidos
        </th>
    </tr>
<?php
if($empresas!='')
foreach ($empresas as $row){
    
   
        ?>
    <tr id="<?php echo $row['codigo'] ?>"  onDblClick='selectionTemp(this,"<?php echo $row['codigo'] ?>",
                                                                      "<?php echo $row['identificacion'] ?>",
                                                                      "<?php echo $row['nombres'] ?>",
                                                                      "<?php echo $row['apellidos'] ?>"
                                                                      )'>
    <?php
        
    
?>
    
        <td class="hidden"> 
            <?php echo $row['codigo'] ?>
        </td>
        <td>
            <?php echo $row['identificacion'] ?>
        </td>
        <td>
            <?php echo $row['nombres'] ?>
        </td>
        <td>
            <?php echo $row['apellidos'] ?>
        </td>
        
    </tr> 
    
<?php    
}

?>
</table>