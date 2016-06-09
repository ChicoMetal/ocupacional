<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class otros_examenes extends CI_Controller{

    var $ses;
    var $pacsexo="";
     function __construct() {
        parent::__construct();
        
        $this->load->model('actividades_model');
        $this->load->model('pacientes_model');
        $this->load->model('revision_por_sistema_model');
        $this->load->model('examen_fisico_model');
        $this->load->model('examen_de_alto_riesgo_model');
        $this->load->model('diagnosticos_model');
        $this->load->model('otros_examenes_model');
        $this->load->model('riesgos_model');
        $this->load->model('antecedentes_model');
        $this->load->model('tipo_examenes_model');
        $this->load->model('concepto_actitud_medica_ocupcional_model');
        $this->load->model('recomendaciones_laborales_model');
        $this->load->model('ordenes_model');
        $this->load->model('empresas_model');
        $this->load->model('audiometrias_sugerencias_model');
        
        
        $this->ses=$this->session->all_userdata();
    }

    function nueva(){
    
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="otros_examenes/nueva";
        $codorden=$this->input->post('codorden');
        $codactividad=$this->input->post('codactividad');
     
        if($codorden!=""){

            $data['ses']=$this->ses;
            $data['active']="otros_examenes";
            $data['active2']="";
            $data['codorden']=$codorden;
            $data['codactividad']=$codactividad;

            $data['paciente']=$this->pacientes_model->buscar_paciente_codorden($codorden);
            $this->pacsexo=$data['paciente'][0]['sexo'];
            $existe=$this->pacientes_model->existe_en_historia($data['paciente'][0]['codigo']);
            //por si hay que clonar
            $existe=false;

            if($existe){
                $this->clonar_historia($data['paciente'][0]['codigo'],$codorden);
            }else{

                
                if($data['paciente'][0]['sexo']=="Femenino"){
                    $data['color']="purple";
                }else{
                    $data['color']="lime";
                }
                
                $this->load->view('includes/otros_examenes/tpl_otros_examenes.php',$data);

            }



        }else{
            echo "nada";


        }

       
    }


    function load_data_form(){
        if($this->input->is_ajax_request()){
            $forma_data = $this->uri->segment(3) ;
            if($forma_data=="tipo"){
                $this->_search_tipo_examenes();
            }elseif($forma_data=="examen"){
            	$codactividad=$this->input->post("codactividad");
            	$data['cuestionario']=$this->otros_examenes_model->
            								buscar_custionarios($codactividad);
                $this->load->view('otros_examenes/data/cuestionario',$data);
            }   
        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }



    }

     function _search_tipo_examenes(){
        
        $respuesta= $this->tipo_examenes_model->buscar_tipo_examenes_historia();
        $data['tipo_examenes']=$respuesta;
        $this->load->view('otros_examenes/data/tipo_examenes',$data);
        
    }


    function guardar_inicial(){
        $codhistoria=$this->_guardar_tipo_examen();
        $codroden=$this->input->post("codorden");
        $codactividad=$this->input->post("codactividad");

        $this->ordenes_model->actualizarestado_detalle("llenando",$codroden,$codactividad);

        $this->_guardar_detalle($codhistoria);
        
        $codroden=$this->otros_examenes_model->buscar_codorden($codhistoria);
        $this->ordenes_model->actualizarestado_detalle("finalizada",$codroden,$codactividad);

        redirect('formatos/mostrar_certificado_otro_examen/'.$codhistoria."/".$codactividad);
    }


    function _guardar_tipo_examen(){
        //echo "tipo=".$this->input->post("tipoexamen");
        //exit;
        $data=array(
            "tipo"      =>$this->input->post("tipoexamen"),
            "fecha"     =>date("Y/m/d H:m:s"),
            "codorden"  =>$this->input->post("codorden"),
            "cargo"     =>$this->input->post("cargo"),
            
            );
        return $this->otros_examenes_model->guardar_tipo($data);

    }


    function _guardar_detalle($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $codigos=array_filter(explode(",",$this->input->post("cods_otros_exam")));

        $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";
        
        for($i=0;$i<sizeof($codigos);$i++){
            $campostext="";
            
            //Pregunto si el tipo de campo que viene es de texto
            //y almacen la cantidad que viene en la variable campostext
            $campostext="";
            if(isset($array_post["canti-text-".$codigos[$i]])){
                $campostext=$array_post["canti-text-".$codigos[$i]];
                //echo $campostext;
            $textores="";
            if($campostext!=""){
                
                for ($ti=0;$ti<$campostext;$ti++) {
                    
                    $textores.='<div class="respuestas" >'.$array_post["otrexam-text-".$codigos[$i]."-".$ti]."</div>";                                        
                }
                $observacion="null";
                if(isset($array_post["observacion-".$codigos[$i]])){
                    $observacion="'".$array_post["observacion-".$codigos[$i]]."'";
                }
                //echo $textores;
                 if($textores!=""){
                    $insert_values.=
                    "('$codhistoria','".
                    $codigos[$i]."','".
                    $textores."',".
                    $observacion.")&$";

                 }
                 
            }  
            

            }
            
            
            //echo $insert_values;

            if(isset($array_post["otrexam-radio-".$codigos[$i]])){
                $find=true;
                $observacion="null";
                if(isset($array_post["observacion-".$codigos[$i]])){
                    $observacion="'".$array_post["observacion-".$codigos[$i]]."'";
                }     
                
                $restradio='<div class="respuestas" >'.$array_post["otrexam-radio-".$codigos[$i]]."</div>";
                //echo $array_post["otrexam-radio-".$codigos[$i]];
                $insert_values.=
                    "('$codhistoria','".
                    $codigos[$i]."','".
                    $restradio."',".
                    $observacion.")&$";

            }

            if(isset($array_post["canti-checkbox-".$codigos[$i]])){
                $campocheck=$array_post["canti-checkbox-".$codigos[$i]];
                $checkboxres="";
            if($campocheck!=""){
                
                for ($ti=0;$ti<$campocheck;$ti++) {
                    if(isset($array_post["otrexam-checkbox-".$codigos[$i]."-".$ti])){
                        $checkboxres.='<div class="respuestas" >'.$array_post["otrexam-checkbox-".$codigos[$i]."-".$ti]."</div>";    
                    }
                    
                    
                    
                }
                $observacion="null";
                if(isset($array_post["observacion-".$codigos[$i]])){
                    $observacion="'".$array_post["observacion-".$codigos[$i]]."'";
                }
                 $insert_values.=
                    "('$codhistoria','".
                    $codigos[$i]."','".
                    $checkboxres."',".
                    $observacion.")&$";
                //echo "checkbox:".$insert_values;
            }  
            }
            
            
            
            //echo $insert_values;

            if(isset($array_post["otrexam-select-".$codigos[$i]])){
                $find=true;
                $observacion="null";
                if(isset($array_post["observacion-".$codigos[$i]])){
                    $observacion="'".$array_post["observacion-".$codigos[$i]]."'";
                }     
                
                $restradio='<div class="respuestas" >'.$array_post["otrexam-select-".$codigos[$i]]."</div>";
                //echo $array_post["otrexam-radio-".$codigos[$i]];
                $insert_values.=
                    "('$codhistoria','".
                    $codigos[$i]."','".
                    $restradio."',".
                    $observacion.")&$";

            }


        }
        
        if($find){

            $insert_values=array_filter(explode("&$",$insert_values));
            $insert_values=implode(",",$insert_values);
           // echo $insert_values;
            return $this->otros_examenes_model->
                    guardar_detalle_values($insert_values,"historias_otros_detalles");

        }

       
        

    }

    function vita_previa_inicial(){
        $codhistoria=$historia = $this->uri->segment(3) ;
        $codactividad=$historia = $this->uri->segment(4) ;
        $usuario=$this->ses['nombres'];

        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']=""; 
        $data['codhistoria']=$codhistoria; 
        $data['codactividad']=$codactividad; 
        $data['titulo']="Ultraclinica: ".$usuario;
       
        $data['contenido_principal']="otros_examenes/editar";
        $this->load->view('includes/otros_examenes/tpl_otros_examenes.php',$data);



    }


    function edit_data_form(){
        if($this->input->is_ajax_request()){
            $forma_data = $this->uri->segment(3) ;
            $codhistoria=$this->input->post("codhistoria");
            $codactividad=$this->input->post("codactividad");
            switch($forma_data){
                case "tipo":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre";
                    $this->_search_tipo("historias_tipo_examenes","tipo_examenes","codexamen",$codhistoria,"tipo_examenes",$campos);
                break; 
                case "cuestionario":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre";
                    $this->_search_otros_examenes_edit($codhistoria,$codactividad);
                break;
                case "diagnosticos":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre";
                    $this->_search_disgnosticos_edit($codhistoria,$codactividad);
                break;


            }


        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }



    }

    function _search_tipo($tabla,$tablapadre,$fk,$codhistoria,$vista,$campos){
        $respuesta= $this->otros_examenes_model->
                            buscar_tipo($codhistoria);
        $data['data']=$respuesta;

        $this->load->view('otros_examenes/edit/'.$vista,$data);
        
    }

    function _search_otros_examenes_edit($codhistoria,$codactividad){
        
        $respuesta= $this->otros_examenes_model->
                            buscar_otros_examanes_edit($codhistoria,$codactividad);
        $data['resultado']=$respuesta;

        $this->load->view('otros_examenes/edit/respuestas',$data);
        
    }


    function _search_disgnosticos_edit($codhistoria,$codactividad){
        
        $respuesta= $this->otros_examenes_model->
                            buscar_diagnosticos_edit($codhistoria,$codactividad);
        $data['data']=$respuesta;

        $this->load->view('otros_examenes/edit/diagnosticos',$data);
        
    }


    function update_historia_diagnosticos(){
        if($this->input->is_ajax_request()){
            $codhistoria=$this->input->post("codhistoria");
            $this->_guardar_diagnosticos($codhistoria);

        }

    }


    function _guardar_diagnosticos($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cr=array_filter(explode(",",$this->input->post("cod_diagnosticos")));

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";

        for($i=0;$i<sizeof($cr);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["diag-".$cr[$i]])){
                $find=true;
             $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cr[$i]."',null)$";
              
            }
           

        }
       
        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->otros_examenes_model->
                    guardar_detalle_values($insert_values,"historias_otros_disgnosticos");

        }

       
        

    }

   
    function delete_diagnostico(){
        if($this->input->is_ajax_request()){
            $codhistoria    =$this->input->post("codhistoria");
            $coddiagnostico =$this->input->post("coddiagnostico");
            $tabla          =$this->input->post("tabla");
            $fk             ="coddiagnostico";
  
            $this->otros_examenes_model->delete_from_historias_data($tabla,$codhistoria,$coddiagnostico,$fk);
        }

    }


    function finalizar(){
        $codhistoria=$this->input->post("codhistoria");
        $codactividad=$this->input->post("codactividad");
        $codroden=$this->otros_examenes_model->buscar_codorden($codhistoria);
        $this->ordenes_model->actualizarestado_detalle("finalizada",$codroden,$codactividad);

       
        redirect('formatos/mostrar_certificado_otro_examen/'.$codhistoria."/".$codactividad);
    

    }




}


?>