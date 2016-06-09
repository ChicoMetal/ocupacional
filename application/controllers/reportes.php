<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reportes extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('reportes_model');
        $this->ses=$this->session->all_userdata();
    }


    function index(){
        /*$usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="reportes/nuevo";
        $data['ses']=$this->ses;
        $data['active']="audiometrias";
        $data['active2']="admreportes";
        $this->load->view('includes/reportes/tpl_reportes.php',$data);*/
    }

    

    function facturacion(){
        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
            $data['contenido_principal']="reportes/facturacion";
        $data['ses']=$this->ses;
        $data['active']="reportes";
        $data['active2']="admreportes_facturacion";
        $this->load->view('includes/reportes/tpl_reportes.php',$data);
    }

    function historial_facturas(){
        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="reportes/historial_facturas";
        $data['ses']=$this->ses;
        $data['active']="reportes";
        $data['active2']="admreportes_historial_facturas";
        $this->load->view('includes/reportes/tpl_reportes.php',$data);
    }


    function usuarios_empresas(){
        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="reportes/empresas_usr";
        $data['ses']=$this->ses;
        $data['active']="reportes";
        $data['active2']="admreportes_empresas";
        $data['empresas']=$this->reportes_model->buscar_empresas();

        $this->load->view('includes/reportes/tpl_reportes.php',$data);
    }


    function buscarcontratos(){
        $fechainicio=$this->input->post("fechainicio");
        $fechacorte=$this->input->post("fechacorte");
        $codempresa=$this->input->post("codempresa");
        $respuesta= $this->reportes_model->buscar_contratos($fechainicio,$fechacorte,$codempresa);
        $data['contratos']=$respuesta;
        
        $this->load->view('reportes/facturacion_pagination',$data);

    }
    
    function buscar_facturas(){
        $fechainicio=$this->input->post("fechainicio");
        $fechacorte=$this->input->post("fechacorte");
        $codempresa=$this->input->post("codempresa");
        $respuesta= $this->reportes_model->buscar_facturas($fechainicio,$fechacorte,$codempresa);
        $data['facturas']=$respuesta;
        
        $this->load->view('reportes/facturacion_history_pagination',$data);

    }
    


    function guardar_facturas(){
        if(true){
            $data=array(
                "codempresa"        =>$this->input->post('codempresa'),
                "fechainicio"         =>$this->input->post('fechainicio')." ".$this->input->post('hora'),
                "fechacorte"           =>$this->input->post('fechacorte'),
              );
       $codfactura=$this->reportes_model->guardar_facturas($data);
       $this->guardar_detalle($codfactura);
       redirect('formatos/facturacion/'.$codfactura);
            echo "si";
        }else{
            echo "no";
        }

    }   


    function guardar_detalle($codfactura){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */

        //actividad_11_384

       $ca=array_filter(explode(",",$this->input->post("cod_orden")));

        $cods_act=array_filter(explode(",",$this->input->post("cods_act")));



       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";

        for($i=0;$i<sizeof($ca);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            $find=true;
            $canti=0;
            for($j=0;$j<sizeof($cods_act);$j++){
                $act_val=$this->input->post("actividad".$canti."_".$cods_act[$j]."_".$ca[$i]);
                if($act_val!=""){
                    $insert_values=
                        $insert_values.
                        "('$codfactura','".
                        $ca[$i]."','".
                        $cods_act[$j]."','".
                        $act_val."')$";

                }

                $canti++;

            }




        }
        
        if($find){
            //echo "encontro y guardando";
            //echo $insert_values;
            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);

            return $this->reportes_model->
                    guardar_detalle_values($insert_values,"facturas_detalles");

        }

       

    }

    function formatosempresas(){ 
        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="reportes/formatosempresas";
        $data['ses']=$this->ses;
        $data['active']="audiometrias";
        $data['active2']="admreportes";
        $this->load->view('includes/reportes/tpl_reportes.php',$data);

    }



    function rips(){ 
        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="reportes/formatosrips";
        $data['ses']=$this->ses;
        $data['active']="reportes";
        $data['active2']="admreportes_formatosrips";
        $this->load->view('includes/reportes/tpl_reportes.php',$data);

    }


    function generarexcel_empresas(){
        $codempresa=$this->input->post("codempresa");
        $fechainicio=$this->input->post("fechainicio");
        $fechacorte=$this->input->post("fechacorte");
        $razonsocial=$this->input->post("razonsocial");

        $respuesta= $this->reportes_model->buscar_contratos_excel($fechainicio,$fechacorte,$codempresa);
      
        //var_dump($respuesta);
        //exit;
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Informe de atención');
        
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);

        //Titulos de las columnas
        $this->excel->getActiveSheet()->setCellValue('A2', 'FECHA');
        $this->excel->getActiveSheet()->setCellValue('B2', 'CEDULA');
        $this->excel->getActiveSheet()->setCellValue('C2', 'NOMBRES');
        $this->excel->getActiveSheet()->setCellValue('D2', 'APELLIDOS');
        $this->excel->getActiveSheet()->setCellValue('E2', 'EDAD');
        $this->excel->getActiveSheet()->setCellValue('F2', 'SEXO');
        $this->excel->getActiveSheet()->setCellValue('G2', 'ESTADO CIVIL');
        $this->excel->getActiveSheet()->setCellValue('H2', 'N° DE HIJOS');
        $this->excel->getActiveSheet()->setCellValue('I2', 'ESCOLARIDAD');
        $this->excel->getActiveSheet()->setCellValue('J2', 'ESCORALIDAD COMPLETA');
        $this->excel->getActiveSheet()->setCellValue('K2', 'CARGO');
        $this->excel->getActiveSheet()->setCellValue('L2', 'ANTECEDENTES FAMILIARES');
        $this->excel->getActiveSheet()->setCellValue('M2', 'ANTECEDENTES PERSONALES');
        $this->excel->getActiveSheet()->setCellValue('N2', 'ACCIDENTES DE TRABAJO');
        $this->excel->getActiveSheet()->setCellValue('O2', 'REVISION POR SISTEMA');
        $this->excel->getActiveSheet()->setCellValue('P2', 'EXAMEN FISICO');
        $this->excel->getActiveSheet()->setCellValue('Q2', 'TALLA');
        $this->excel->getActiveSheet()->setCellValue('R2', 'PESO');
        $this->excel->getActiveSheet()->setCellValue('S2', 'IMC');//imc
        $this->excel->getActiveSheet()->setCellValue('T2', 'TA');
        $this->excel->getActiveSheet()->setCellValue('U2', 'FC');
        $this->excel->getActiveSheet()->setCellValue('V2', 'FR');
        $this->excel->getActiveSheet()->setCellValue('W2', 'DOMINANCIA');
        $this->excel->getActiveSheet()->setCellValue('X2', 'AUDIOMETRIA');
        $this->excel->getActiveSheet()->setCellValue('Y2', 'VISIOMETRIA');
        $this->excel->getActiveSheet()->setCellValue('Z2', 'ESPIROMETRIA');
        $this->excel->getActiveSheet()->setCellValue('AA2', 'DIAGNOSTICOS');
        $this->excel->getActiveSheet()->setCellValue('AB2', 'CONCEPTO DE ACTITUD');
        $this->excel->getActiveSheet()->setCellValue('AC2', 'RECOMENDACIONES');
        $i=3;

        if($respuesta!=null)
        foreach ($respuesta as $data) {


            $this->excel->getActiveSheet()->setCellValue('A'.$i, $data["fechahistoria"]);
            $this->excel->getActiveSheet()->setCellValue('B'.$i, $data["identificacion"]);
            $this->excel->getActiveSheet()->setCellValue('C'.$i, $data["nombres"]);
            $this->excel->getActiveSheet()->setCellValue('D'.$i, $data["apellidos"]);
            $this->excel->getActiveSheet()->setCellValue('E'.$i, $data["edad"]);
            $this->excel->getActiveSheet()->setCellValue('F'.$i, $data["sexo"]);
            $this->excel->getActiveSheet()->setCellValue('G'.$i, $data["estadocivil"]);
            $this->excel->getActiveSheet()->setCellValue('H'.$i, $data["numhijos"]);
            $this->excel->getActiveSheet()->setCellValue('I'.$i, $data["escolaridad"]);
            $this->excel->getActiveSheet()->setCellValue('J'.$i, $data["escolaridadc"]);
            $this->excel->getActiveSheet()->setCellValue('K'.$i, $data["cargo_atual"]);
            
            if($data["antecedentes"]!=null){
                foreach ($data["antecedentes"] as $adata) {
                    if( $adata['tipo']=="familiares"){
                        $this->excel->getActiveSheet()->setCellValue('L'.$i, $adata['antecedentes']);                        
                    }
                    if( $adata['tipo']=="personales"){
                        $this->excel->getActiveSheet()->setCellValue('M'.$i, $adata['antecedentes']);                        
                    }
                    
                }
                
                
            }
            if($data["accidentes"]!=null){
                foreach ($data["accidentes"] as $adata) {
                    $this->excel->getActiveSheet()->setCellValue('N'.$i, $adata['accidentes']);
                }
                
            }
            if($data["revision"]!=null){
                foreach ($data["revision"] as $adata) {
                    $this->excel->getActiveSheet()->setCellValue('O'.$i, $adata['revision']);
                }
                
            }
            if($data["examen_fisico"]!=null){
                foreach ($data["examen_fisico"] as $adata) {
                    $this->excel->getActiveSheet()->setCellValue('P'.$i, $adata['examen_fisico']);
                }
                
            }

            $this->excel->getActiveSheet()->setCellValue('Q'.$i, $data["talla"]);
            $this->excel->getActiveSheet()->setCellValue('R'.$i, $data["peso"]);
            $this->excel->getActiveSheet()->setCellValue('S'.$i, $data["imc"]);
            $this->excel->getActiveSheet()->setCellValue('T'.$i, $data["ta"]);
            $this->excel->getActiveSheet()->setCellValue('U'.$i, $data["fc"]);
            $this->excel->getActiveSheet()->setCellValue('V'.$i, $data["fr"]);
            $this->excel->getActiveSheet()->setCellValue('W'.$i, $data["brazo"]);
            
            if($data["interpretacion"]!=null){
                foreach ($data["interpretacion"] as $adata) {
                    $res=str_replace('<div class="respuestas" >','',$adata['respuestas']);
                    $res=str_replace('</div>','',$res);
                    if( $adata['nombre']=="Audiometria tamiz"){
                        $this->excel->getActiveSheet()->setCellValue('X'.$i, $res);                        
                    }
                    if( $adata['nombre']=="Visiometria tamiz"){
                        $this->excel->getActiveSheet()->setCellValue('Y'.$i, $res);                        
                    }
                    if( $adata['nombre']=="Espirometria"){
                        $this->excel->getActiveSheet()->setCellValue('Z'.$i, $res);                        
                    }
                    
                }
                
                
            }

            if($data["diagnosticos"]!=null){
                foreach ($data["diagnosticos"] as $adata) {
                    $this->excel->getActiveSheet()->setCellValue('AA'.$i, $adata['diagnosticos']);
                }
                
            }


            if($data["conceptos"]!=null){
                foreach ($data["conceptos"] as $adata) {
                    $this->excel->getActiveSheet()->setCellValue('AB'.$i, $adata['conceptos']);
                }
                
            }

            $recjoin="";
            $recnombre="";
            if($data["recomendaciones"]!=null){
                foreach ($data["recomendaciones"] as $adata) {

                    if($recnombre!=$adata['nombre']){
                        $recjoin.=" --[".$adata['nombre']."]: ";     
                    }
                    $recjoin.=$adata['recomendacion'].", ";   
                    $recnombre=$adata['nombre'] ;
                }
              $this->excel->getActiveSheet()->setCellValue('AC'.$i, $recjoin);  
            }
           // echo  $recjoin;
            //var_dump($data["recomendaciones"]);
            



             $i++;  
        }

        //exit;
       
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $filename=$razonsocial.$fechainicio.$fechacorte.'.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
         
    }



    function generarexcel_rips(){
        
        $fechainicio=$this->input->post("fechainicio");
        $fechacorte=$this->input->post("fechacorte");
        

        $respuesta= $this->reportes_model->buscar_rips_excel($fechainicio,$fechacorte);


        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('RIPS');
        
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);

        //Titulos de las columnas
        $this->excel->getActiveSheet()->setCellValue('A2', 'FECHA');
        $this->excel->getActiveSheet()->setCellValue('B2', 'CEDULA');
        $this->excel->getActiveSheet()->setCellValue('C2', 'NOMBRES');
        $this->excel->getActiveSheet()->setCellValue('D2', 'APELLIDOS');
        $this->excel->getActiveSheet()->setCellValue('E2', 'EDAD');
        $this->excel->getActiveSheet()->setCellValue('F2', 'SEXO');
        $this->excel->getActiveSheet()->setCellValue('G2', 'EMPRESA');
        $this->excel->getActiveSheet()->setCellValue('H2', 'DIAGNOSTICOS');
        $this->excel->getActiveSheet()->setCellValue('I2', 'REMISION');
        $i=3;

        if($respuesta!=null)
        foreach ($respuesta as $data) {


            $this->excel->getActiveSheet()->setCellValue('A'.$i, $data["fechahistoria"]);
            $this->excel->getActiveSheet()->setCellValue('B'.$i, $data["identificacion"]);
            $this->excel->getActiveSheet()->setCellValue('C'.$i, $data["nombres"]);
            $this->excel->getActiveSheet()->setCellValue('D'.$i, $data["apellidos"]);
            $this->excel->getActiveSheet()->setCellValue('E'.$i, $data["edad"]);
            $this->excel->getActiveSheet()->setCellValue('F'.$i, $data["sexo"]);
            $this->excel->getActiveSheet()->setCellValue('G'.$i, $data["razonsocial"]);
            
            if($data["diagnosticos"]!=null){
                foreach ($data["diagnosticos"] as $adata) {
                    $this->excel->getActiveSheet()->setCellValue('H'.$i, $adata['diagnosticos']);
                }
                
            }
            
            if($data["remision"]!=null){
                foreach ($data["remision"] as $adata) {
                    if($adata['remision']==null){
                        $this->excel->getActiveSheet()->setCellValue('I'.$i, "no");
                    }else{
                        $this->excel->getActiveSheet()->setCellValue('I'.$i, $adata['remision']);
                    }
                    
                }
                
            }

            

             $i++;  
        }


       
        //change the font size
        //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        //$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $filename="RIPS ".$fechainicio." - ".$fechacorte.'.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
         
    }




}


?>