<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class historias extends CI_Controller{

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
        $this->load->model('historias_model');
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
        $data['contenido_principal']="historias/nueva";
        $codorden=$this->input->post('codorden');
     
        if($codorden!=""){

            $data['ses']=$this->ses;
            $data['active']="historias";
            $data['active2']="";
            $data['codorden']=$codorden;
            $data['soloexamenes']=$this->ordenes_model->buscar_soloexamenes($codorden)[0]['soloexamenes'];
            $data['cualesexamenes']=$this->ordenes_model->buscar_emamenes($codorden);

            $data['paciente']=$this->pacientes_model->buscar_paciente_codorden($codorden);
            $data['edad']=$this->_calculaedad($data['paciente'][0]['fechanacimiento']);
            $this->pacsexo=$data['paciente'][0]['sexo'];
             $existe=$this->pacientes_model->existe_en_historia($data['paciente'][0]['codigo']);
            if($existe){
                $this->clonar_historia($data['paciente'][0]['codigo'],$codorden);
            }else{

                
                if($data['paciente'][0]['sexo']=="Femenino"){
                    $data['color']="purple";
                }else{
                    $data['color']="lime";
                }
                
                
                $this->load->view('includes/historias/tpl_historias.php',$data);

            }



        }else{
            echo "nada";


        }

       
    }

    function clonar_historia($paciente,$orden){
        $codhistoria=$this->historias_model->clonar_historias1($paciente,$orden);
            // echo "porr aqui";
            // //$codhistoria=$this->historias_model->returnclon($paciente,$orden)['0']['codigo'];
            //var_dump($codhistoria);
            //echo "codhistoria=".$codhistoria;
            //exit;
        redirect('historias/vita_previa_concepto/'.$codhistoria);
        
    }

    function examen_fisico(){

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="historias/examen_fisico";
        $codorden=$this->input->post('codorden');
     
        if($codorden!=""){

            $data['ses']=$this->ses;
            $data['active']="historias";
            $data['active2']="";
            $data['codhistoria']=$this->historias_model->buscar_historias_codorden($codorden)['0']['codigo'];
            $data['soloexamenes']=$this->ordenes_model->buscar_soloexamenes($codorden)[0]['soloexamenes'];
            $data['cualesexamenes']=$this->ordenes_model->buscar_emamenes($codorden);
            $data['codorden']=$codorden;
            $data['paciente']=$this->pacientes_model->buscar_paciente_codorden($codorden);
            $data['edad']=$this->_calculaedad($data['paciente'][0]['fechanacimiento']);
            if($data['paciente'][0]['sexo']=="Femenino"){
                $data['color']="purple";
            }else{
                $data['color']="lime";
            }
            
            
            $this->load->view('includes/historias/tpl_historias.php',$data);


        }else{
            echo "nada";


        }


    }


    function load_data_form(){
        if($this->input->is_ajax_request()){
            $forma_data = $this->uri->segment(3) ;
            if($forma_data=="tipo"){
                $this->_search_tipo_examenes();
            }else if($forma_data=="informacion_ocupacional"){
                $this->load->view('historias/data/informacion_ocupacional');
            }else if($forma_data=="habitos"){
                $this->load->view('historias/data/habitos');
            }else if($forma_data=="antecedentes_personales"){
                $this->load->view('historias/data/antecedentes_personales');
            }else if($forma_data=="revision_por_sistema"){
                 $this->_search_sistema();
            }else if($forma_data=="examen_fisico"){
                $this->_search_examen_fisico();
            }else if($forma_data=="examen_fisico_osteo"){
                $this->load->view('historias/data/examen_fisico_osteo');
            }else if($forma_data=="examen_de_alto_riesgo"){
                $this->_search_examen_de_alto_riesgo(); 
            }else if($forma_data=="diagnostico"){
                $this->_search_diagnostico();
            }else if($forma_data=="antecedentes"){
                $this->_search_antecedentes();
            }else if($forma_data=="factores"){
                $this->_search_factores();
            }else if($forma_data=="concepto_actitud_medica_ocupcional"){
                $this->_search_concepto_actitud_medica_ocupcional();

            }else if($forma_data=="recomendaciones_laborales"){
                $this->_search_recomendaciones_laborales();

            }else if($forma_data=="accidentes_de_trabajo"){
                $this->_search_accidentes_de_trabajo();
            }else if($forma_data=="antecedentes_laborales"){
                $this->_search_antecedentes_laborales();
            }

                
        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }



    }

    function _search_sistema(){
        $data['sistema']=$this->revision_por_sistema_model->buscar_revision_por_sistema();
        $this->load->view('historias/data/revision_por_sistema',$data);
        
    }

    function _search_factores(){
        $respuesta= $this->riesgos_model->buscar_riesgos_historia();
        $data['riesgos']=$respuesta;
        $this->load->view('riesgos/show_historia',$data);
        
    }

    function _search_accidentes_de_trabajo(){
        $this->load->view('historias/data/accidentes_de_trabajo');
        
    }

    function _search_antecedentes_laborales(){
        $this->load->view('historias/data/antecedentes_laborales');
        
    }


    function _search_antecedentes(){
        $respuesta= $this->antecedentes_model->buscar_antecedentes_historia();
        $data['antecedentes']=$respuesta;
        $codorden=$this->input->post("codorden");
        $data['sexo']=$this->pacientes_model->buscar_paciente_codorden($codorden)['0']['sexo'];
        
        $this->load->view('antecedentes/show_historia',$data);
        
    }

    function _search_examen_fisico(){
        $data['examen']=$this->examen_fisico_model->buscar_examen_fisico();

        $this->load->view('historias/data/examen_fisico',$data);
        
    }

    function _search_examen_de_alto_riesgo(){
        $data['examen']=$this->examen_de_alto_riesgo_model->buscar_examen_de_alto_riesgo();

        $this->load->view('historias/data/examen_de_alto_riesgo',$data);
        
    }

    function _search_diagnostico(){
        
        $respuesta= $this->diagnosticos_model->buscar_diagnosticos_historia();
        $data['diagnosticos']=$respuesta;
       
        $this->load->view('historias/data/diagnosticos',$data);
        
    }

    function _search_tipo_examenes(){
        
        $respuesta= $this->tipo_examenes_model->buscar_tipo_examenes_historia();
        $data['tipo_examenes']=$respuesta;
        $this->load->view('historias/data/tipo_examenes',$data);
        
    }

    function _search_concepto_actitud_medica_ocupcional(){
        
        $respuesta= $this->concepto_actitud_medica_ocupcional_model->buscar_concepto_actitud_medica_ocupcional_historia();
        $data['concepto_actitud_medica_ocupcional']=$respuesta;
        $this->load->view('historias/data/concepto_actitud_medica_ocupcional',$data);
        
    }


    function _search_recomendaciones_laborales(){
        $respuesta= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_historia();
        $data['recomendaciones_laborales']=$respuesta;
        $this->load->view('historias/data/recomendaciones_laborales',$data);
        
    }




    function _calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
        return $ano_diferencia;
    }

    function guardar_inicial(){
        $codhistoria=$this->_guardar_tipo_examen();
        $codroden=$this->input->post("codorden");

        $this->ordenes_model->actualizarestado("llenando",$codroden);

        $this->_guardar_tipo_examenes($codhistoria);
        /*echo "<br>inf ocu ".*/
        $this->_guardar_paciente($codhistoria);/*echo "<br>inf ocu ".*/
        $this->_guardar_informacion_ocupacional($codhistoria);
        /*echo "<br>hab     ".*/
        $this->_guardar_habitos($codhistoria);
        /*echo "<br>ap      ".*/
        $this->_guardar_antecedentes_personales($codhistoria);

       
        redirect('historias/vita_previa_inicial/'.$codhistoria);
    }

    
    
    function solofacturar(){
        $codroden=$this->input->post("codorden");
        $codhistoria=$this->_guardar_solo_historia($codroden);
        $this->ordenes_model->actualizarestado("finalizada",$codroden);
        $this->ordenes_model->actualizarestado_detalle_all("finalizada",$codroden);
        $this->historias_model->actualizarestado("finalizada",$codhistoria);
        redirect('historias/save_sf/');
    }

    function save_sf(){
                $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="historias/save_sf";
        $data['ses']=$this->ses;
        $data['active']="actividades";
        $data['active2']="admactividades";

        $this->load->view('includes/historias/tpl_historias.php',$data);
    }

    function vita_previa_inicial(){
        $codhistoria=$historia = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']=""; 
        $data['codhistoria']=$codhistoria; 
        $data['titulo']="Ultraclinica: ".$usuario;
       
        $data['contenido_principal']="historias/editar";
        $this->load->view('includes/historias/tpl_historias.php',$data);


    }

    function guardar_examenfisico(){
        $codhistoria=$this->input->post("codhistoria");
        $codroden=$this->input->post("codorden");

        $this->ordenes_model->actualizarestado("concepto",$codroden);
        /*echo "<br>inf ocu ".*/
        $this->_guardar_riesgos($codhistoria);
        /*echo "<br>rev sis ".*/
        $this->_guardar_revision_por_sistema($codhistoria);
        /*echo "<br>IMc     ".*/
        $this->_guardar_examen_fisico_imc($codhistoria);
        /*echo "<br>IMc     ".*/
        $this->_guardar_examen_fisico_organo($codhistoria);
        /*echo "<br>IMc     ".*/
        $this->_guardar_diagnosticos($codhistoria);
        /*echo "<br>rev sis ".*/
        $this->_guardar_antedentes_laborales($codhistoria);
        /*echo "<br>rev sis ".*/
        $this->_guardar_accidentes($codhistoria);


        redirect('historias/vita_previa_concepto/'.$codhistoria);
    }

    function vita_previa_concepto(){

        $codhistoria=$historia = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']=""; 
        $data['codhistoria']=$codhistoria; 
        $data['titulo']="Ultraclinica: ".$usuario;
        if($this->historias_model->eseditable($codhistoria)){

            $data['contenido_principal']="historias/editar_total";
            $this->load->view('includes/historias/tpl_historias.php',$data);
        }else{
            $data['contenido_principal']="historias/finalizada";
            $this->load->view('includes/historias/tpl_historias.php',$data);

        }

    }

    function finalizar_historia(){
        $codhistoria=$this->input->post("codhistoria");
        $codroden=$this->historias_model->buscar_codorden($codhistoria);
        //echo "codroden".$codroden;

        //exit;
        $this->ordenes_model->actualizarestado("finalizada",$codroden);
        $this->historias_model->actualizarestado("finalizada",$codhistoria);
        $this->historias_model->actualizarcampo("fechasalida",date("Y/m/d H:m:s"),$codhistoria);

        $this->_guardar_concepto_actitud_medica_ocupcional($codhistoria);
        /*echo "<br>exa_al  ".*/
        $this->_guardar_recomendaciones_laborales($codhistoria);
        $this->_guardar_remision($codhistoria);

        redirect('formatos/mostrar_certificado_historia/'.$codhistoria);
    

    }



    function guardar(){
        $codhistoria=$this->_guardar_tipo_examen();
        $codroden=$this->input->post("codorden");

        $this->ordenes_model->actualizarestado("llenando",$codroden);
        /*echo "<br>inf ocu ".*/
        $this->_guardar_paciente($codhistoria);/*echo "<br>inf ocu ".*/
        $this->_guardar_informacion_ocupacional($codhistoria);
        /*echo "<br>hab     ".*/
        $this->_guardar_habitos($codhistoria);
        /*echo "<br>ap      ".*/
        $this->_guardar_antecedentes_personales($codhistoria);
        /*echo "<br>ries    ".*/
        $this->_guardar_riesgos($codhistoria);
        /*echo "<br>rev sis ".*/
        $this->_guardar_revision_por_sistema($codhistoria);
        /*echo "<br>IMc     ".*/
        $this->_guardar_examen_fisico_imc($codhistoria);
        /*echo "<br>IMc     ".*/
        $this->_guardar_examen_fisico_organo($codhistoria);
        /*echo "<br>ost     ".*/
        $this->_guardar_examen_fisico_osteo($codhistoria);
        /*echo "<br>exa_al  ".*/
        $this->_guardar_examen_de_alto_riesgo($codhistoria);
        /*echo "<br>exa_al  ".*/
        $this->_guardar_audiometria($codhistoria);
        /*echo "<br>exa_al  ".*/
        $this->_guardar_audiometria_grafica($codhistoria);
        /*echo "<br>exa_al  ".*/
        $this->_guardar_tipo_examenes($codhistoria);
        /*echo "<br>exa_al  ".*/
        $this->_guardar_concepto_actitud_medica_ocupcional($codhistoria);
        /*echo "<br>exa_al  ".*/
        $this->_guardar_recomendaciones_laborales($codhistoria);

        
        

    }

    function _guardar_tipo_examen(){
        $data=array(
            "tipo"      =>$this->input->post("tipoextamen"),
            "fecha"     =>date("Y/m/d H:m:s"),
            "paciente"  =>$this->input->post("idpaciente"),
            "enmision"  =>$this->input->post("enmision"),
            "codempresa"=>$this->_buscar_codempresa(),
            "codorden"  =>$this->input->post("codorden"),
            "eps"       =>$this->input->post("eps"),
            "afp"       =>$this->input->post("afp"),
            "arp"       =>$this->input->post("arp")
            );
        return $this->historias_model->guardar_tipo($data);

    }

    function _buscar_codempresa(){
        return  $this->ordenes_model->buscar_codempresa($this->input->post("codorden"));
    }

    function _guardar_solo_historia($codorden){
        $data=array(
            "tipo"      =>"1",
            "fecha"     =>date("Y/m/d H:m:s"),
            "paciente"  =>"",
            "enmision"  =>"",
            "codempresa"=>"1",
            "codorden"  =>$codorden,
            "eps"       =>"",
            "afp"       =>"",
            "arp"       =>""
            );
        return $this->historias_model->guardar_tipo($data);

    }

    function _guardar_paciente($codhistoria){
        $data=array(
            "codhistoria"   =>$codhistoria,
            "codpaciente"   =>$this->input->post("idpaciente"),
            "direccion"     =>$this->input->post("pac_direccion"),
            "telefono"      =>$this->input->post("pac_telefono"),
            "celular"       =>$this->input->post("pac_celular"),
            "estadocivil"   =>$this->input->post("pac_estadocivil"),
            "numhijos"      =>$this->input->post("pac_numhijos"),
            "escolaridad"   =>$this->input->post("pac_escolaridad"),
            "escolaridad_completa"  =>$this->input->post("pac_escolaridad_completa"),
            "email"   =>$this->input->post("pac_email")
            
            );
        return $this->historias_model->guardar_detalle($data,"historias_paciente");
    }


    function _guardar_informacion_ocupacional($codhistoria){
        $data=array(
            "codhistoria"       =>$codhistoria,
            "cargo_atual"       =>$this->input->post("cargoactual"),
            "holario_laboral"   =>$this->input->post("horaciolaboral"),
            "turno"             =>$this->input->post("turno"),
            "funciones"         =>$this->input->post("funciones"),
            "antiguedad"        =>$this->input->post("antiguedad")
            );
        //var_dump($data);
        return $this->historias_model->guardar_detalle($data,"historias_informacion_ocupacional");

    }



    function _guardar_antedentes_laborales($codhistoria){
        $data=array(
            "codhistoria"               =>$codhistoria,
            "empresaantecedente"        =>$this->input->post("empresaantecedente"),
            "empresaantecedente1"       =>$this->input->post("empresaantecedente1"),
            "cargoanttecedente"         =>$this->input->post("cargoanttecedente"),
            "cargoanttecedente1"        =>$this->input->post("cargoanttecedente1"),
            "tiempoantecedente"         =>$this->input->post("tiempoantecedente"),
            "tiempoantecedente1"        =>$this->input->post("tiempoantecedente1"),
            "incapacidadantecedente"    =>$this->input->post("incapacidadantecedente"),
            "incapacidadantecedente1"   =>$this->input->post("incapacidadantecedente1"),
            "riesgosantecdentes"        =>$this->input->post("riesgosantecdentes"),
            "riesgosantecdentes1"       =>$this->input->post("riesgosantecdentes1")
            );
        //var_dump($data);
        return $this->historias_model->guardar_detalle($data,"historias_antecedentes_laborales");

    }


    function _guardar_accidentes($codhistoria){
        $data=array(
            "codhistoria"               =>$codhistoria,
            "accidentes"        =>$this->input->post("accidentes"),
            "accidentes1"       =>$this->input->post("accidentes1"),
            "enfermedad"         =>$this->input->post("enfermedad"),
            "enfermedad1"        =>$this->input->post("enfermedad1"),
            "fechaaccidente"         =>$this->input->post("fechaaccidente"),
            "fechaaccidente1"        =>$this->input->post("fechaaccidente1"),
            "empresaaccidente"    =>$this->input->post("empresaaccidente"),
            "empresaaccidente1"   =>$this->input->post("empresaaccidente1"),
            "tipodelesion"        =>$this->input->post("tipodelesion"),
            "tipodelesion1"       =>$this->input->post("tipodelesion1"),
            "sitiodelesion"         =>$this->input->post("sitiodelesion"),
            "sitiodelesion1"        =>$this->input->post("sitiodelesion1"),
            "incapacidad"    =>$this->input->post("incapacidad"),
            "incapacidad1"   =>$this->input->post("incapacidad1"),
            "secuelas"        =>$this->input->post("secuelas"),
            "secuelas1"       =>$this->input->post("secuelas1")
            );
        //var_dump($data);
        return $this->historias_model->guardar_detalle($data,"historias_accidentes");

    }


    function _guardar_habitos($codhistoria){
        $data=array(
            "codhistoria"           =>$codhistoria,
            "fumador"               =>$this->input->post("fumador"),
            "fuma_frecuencia"       =>$this->input->post("fuma_frecuencia"),
            "fuma_anios"            =>$this->input->post("fuma_anios"),
            "fuma_tipo"             =>$this->input->post("fuma_tipo"),
            "alcohol"               =>$this->input->post("alcohol"),
            "alcohol_frecuencia"    =>$this->input->post("alcohol_frecuencia"),
            "deportes"              =>$this->input->post("deportes"),
            "deportes_frecuencia"   =>$this->input->post("deportes_frecuencia"),
            "lesiones"              =>$this->input->post("lesiones"),
            "observaciones"         =>$this->input->post("hab-observaciones")
           );
        return $this->historias_model->guardar_detalle($data,"historias_habitos");

    }

    function _guardar_antecedentes_personales($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $ca=array_filter(explode(",",$this->input->post("cod_antecedentes")));

       //var_dump($ca);

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";

        for($i=0;$i<sizeof($ca);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["ant-".$ca[$i]])){

                $find=true;
                $txt="niega";
                if($array_post["txtant-".$ca[$i]]!=""){
                    
                   $txt=$array_post["txtant-".$ca[$i]];
                   $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $ca[$i]."','".
                    $txt.
                    "')$";
                }else{
                    
                    $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $ca[$i]."',null)$";
                }
                
              
            }
           

        }
        
        if($find){
            //echo "encontro y guardando";
            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);

            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_antecedentes_personales");

        }

       
        

    }


    function _guardar_riesgos($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cr=array_filter(explode(",",$this->input->post("cod_riesgos")));

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";

        for($i=0;$i<sizeof($cr);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["rie-".$cr[$i]])){
                $find=true;
             $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cr[$i]."')$";
              
            }
           

        }
       
        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_factores_deriesgo");

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
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_diagnosticos");

        }

       
        

    }



    function _guardar_revision_por_sistema($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cs=array_filter(explode(",",$this->input->post("cods_sistemas")));

        $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";
        
        for($i=0;$i<sizeof($cs);$i++){

            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["rsis-".$cs[$i]])){
                
                
                if($array_post["rsis-".$cs[$i]]!=""){
                    $find=true;
                   $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cs[$i]."','".
                    $array_post["rsis-".$cs[$i]].
                    "')$"; 
                }else{
                    /*$insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cs[$i]."',null)$"; 
                    */
                }
               
              
            }
           

        }
       
        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_revision_por_sistema");

        }

       
        

    }


    function _guardar_examen_fisico_imc($codhistoria){
        $obs=$this->input->post("exaf-observaciones");
        if($obs==""){
            $obs=null;
        }
         $data=array(
            "codhistoria"   =>$codhistoria,
            "talla"         =>$this->input->post("talla"),
            "peso"          =>$this->input->post("peso"),
            "ta"            =>$this->input->post("ta"),
            "fc"            =>$this->input->post("fc"),
            "fr"            =>$this->input->post("fr"),
            "brazo"         =>$this->input->post("brazo"),
            "imc"           =>$this->input->post("imc"),
            "temperatura"          =>$this->input->post("temp"),
            "observacion"   =>$obs
            );
        return $this->historias_model->guardar_detalle($data,"historias_examen_fisico_imc");

       
    }


    function _guardar_examen_fisico_organo($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cef=array_filter(explode(",",$this->input->post("cods_exaf")));

        $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";
        
        for($i=0;$i<sizeof($cef);$i++){

            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["exaf-".$cef[$i]])){
                $find=true;
               
                if($array_post["exaf-".$cef[$i]]!=""){

                   $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cef[$i]."','".
                    $array_post["exaf-".$cef[$i]].
                    "')$"; 
                }else{
                    $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cef[$i]."',null)$";
                }
               
              
            }
           

        }
       
        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_examen_fisico");

        }

       
        

    }


    function _guardar_examen_fisico_osteo($codhistoria){
       
         $data=array(
            "codhistoria"       =>$codhistoria,
            "epicondilitisd"    =>$this->input->post("epicondilitisder"),
            "epicondilitisi"    =>$this->input->post("epicondilitisi"),
            "finkelsteind"      =>$this->input->post("finkelsteind"),
            "finkelsteini"      =>$this->input->post("finkelsteini"),
            "tineld"            =>$this->input->post("tineld"),
            "tineli"            =>$this->input->post("tineli"),
            "phalemd"           =>$this->input->post("phalemd"),
            "dedosmanosi"       =>$this->input->post("dedosmanosi"),
            "dedosmanosp"       =>$this->input->post("dedosmanosp"),
            "dedosmanosm"       =>$this->input->post("dedosmanosm"),
            "munecai"           =>$this->input->post("munecai"),
            "munecap"           =>$this->input->post("munecap"),
            "munecam"           =>$this->input->post("munecam"),
            "antebrazoi"        =>$this->input->post("antebrazoi"),
            "antebrazop"        =>$this->input->post("antebrazop"),
            "antebrazom"        =>$this->input->post("antebrazom"),
            "codosi"            =>$this->input->post("codosi"),
            "codosp"            =>$this->input->post("codosp"),
            "codosm"            =>$this->input->post("codosm"),
            "brazoi"            =>$this->input->post("brazoi"),
            "brazop"            =>$this->input->post("brazop"),
            "brazom"            =>$this->input->post("brazom"),
            "hombrosi"          =>$this->input->post("hombrosi"),
            "hombrosp"          =>$this->input->post("hombrosp"),
            "hombrosm"          =>$this->input->post("hombrosm"),
            "testdewell"        =>$this->input->post("testdewell"),
            "testdeshober"      =>$this->input->post("testdeshober"),
            "lassegued"         =>$this->input->post("lassegued"),
            "lasseguei"         =>$this->input->post("lasseguei")
            
            );
        return $this->historias_model->guardar_detalle($data,"historias_examenfisico_osteo");

       
    }

    function _guardar_examen_de_alto_riesgo($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cef=array_filter(explode(",",$this->input->post("cods_exasm_alto")));

        $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";
        
        for($i=0;$i<sizeof($cef);$i++){

            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["examar-".$cef[$i]])){
                $find=true;
               
                if($array_post["examar-".$cef[$i]]!=""){
                   $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cef[$i]."','".
                    $array_post["examar-".$cef[$i]].
                    "')$"; 
                }else{
                    $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cef[$i]."',null)$"; 

                }
               
              
            }
           

        }
       
        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_examen_de_alto_riesgo");

        }

       
        

    }


    function _guardar_audiometria($codhistoria){

        $cef=array_filter(explode(",",$this->input->post("cods_audiometria")));

        $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";
        
        for($i=0;$i<sizeof($cef);$i++){

            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["aud-".$cef[$i]])){
                $find=true;
                $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cef[$i]."','".
                    $array_post["aud-".$cef[$i]].
                    "')$"; 
              
            }
           

        }
       
        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_audiometria");

        }

       
        

    }



    function _guardar_audiometria_grafica($codhistoria){
       
         $data=array(
            "codhistoria"       =>$codhistoria,
            "exposicionruido"   =>$this->input->post("exposicionruido"),
            "oidomejor"         =>$this->input->post("oidomejor"),
            "ad500"             =>$this->input->post("ad500"),
            "ad1000"            =>$this->input->post("ad1000"),
            "ad2000"            =>$this->input->post("ad2000"),
            "ad3000"            =>$this->input->post("ad3000"),
            "ad4000"            =>$this->input->post("ad4000"),
            "ad6000"            =>$this->input->post("ad6000"),
            "ad8000"            =>$this->input->post("ad8000"),
            "ai500"             =>$this->input->post("ai500"),
            "ai1000"            =>$this->input->post("ai1000"),
            "ai2000"            =>$this->input->post("ai2000"),
            "ai3000"            =>$this->input->post("ai3000"),
            "ai4000"            =>$this->input->post("ai4000"),
            "ai6000"            =>$this->input->post("ai6000"),
            "ai8000"            =>$this->input->post("ai8000"),
            "hallazgo"          =>$this->input->post("hallazgo"),
            "interpretacion"    =>$this->input->post("interpretacion"),
            "equipo"            =>$this->input->post("equipo-auio"),
            "fechacalibracion"  =>$this->input->post("fechacalibracion"),
            
            );
        return $this->historias_model->guardar_detalle($data,"historias_audiometria_grafica");

       
    }


    function _guardar_tipo_examenes($codhistoria){

         $data=array(
            "codhistoria"   =>$codhistoria,
            "codexamen"     =>$this->input->post("tipoexamen")
            );
       
        return $this->historias_model->guardar_detalle($data,"historias_tipo_examenes");
       
    }

    function _guardar_concepto_actitud_medica_ocupcional($codhistoria){
       
       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cr=array_filter(explode(",",$this->input->post("cods_conceptoactitud")));

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";

        for($i=0;$i<sizeof($cr);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["concepto-".$cr[$i]])){
                $find=true;
             $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cr[$i]."')$";
              
            }
           

        }
       
        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_concepto_actitud_medica_ocupcional");

        }

        
    }


    function _guardar_recomendaciones_laborales($codhistoria){
       
       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cr=array_filter(explode(",",$this->input->post("cod_recomendaciones")));

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";


       
        for($i=0;$i<sizeof($cr);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["recomlab-".$cr[$i]])){
                $find=true;
             $insert_values=
                    $insert_values.
                    "('$codhistoria','".
                    $cr[$i]."')$";
              
            }
           

        }
       

        if($find){

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            return $this->historias_model->
                    guardar_detalle_values($insert_values,"historias_recomendaciones_laborales");

        }

        
    }

    function  _guardar_remision($codhistoria){
        $data=array(
            "codhistoria"       =>$codhistoria,
            "remision"          =>$this->input->post("remision"),
            "motivo"            =>$this->input->post("motivo_remision")
            );
        return $this->historias_model->guardar_detalle($data,"historias_remision");
    }


     function enproceso(){
      
            $cantidad_res=$this->input->post("cantidad_res");
            $nombre=$this->input->post("nombre");
           
            $estado=$this->input->post("estado");
            //echo  $cantidad_res.$nombre.$tipo.$estado;
            $data['titulo']="Ultraclinica: ";
            
            $data['ses']=$this->ses;
            $data['contenido_principal']="historias/mostrar_pendientes";
            $data['active']="historias";
            $data['active2']="hisenproceso";
            $respuesta= $this->historias_model->buscar_historias_pendientes_proceso();
            //$cantidad= $this->riesgos_model->count_riesgos();
            $data['historias']=$respuesta;
            
            $this->load->view('includes/historias/tpl_historias.php',$data);


      

        
    }


    function _actualizar_antecedentes_personales($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       
       $ca=array_filter(explode(",",$this->input->post("cod_antecedentes")));

       //var_dump($ca);

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";

        for($i=0;$i<sizeof($ca);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["ant-".$ca[$i]])){

                $find=true;
                $txt="niega";
                if($array_post["txtant-".$ca[$i]]!=""){
                    
                   $txt=$array_post["txtant-".$ca[$i]];
                   $insert_values=
                    
                    "UPDATE historias_antecedentes_personales set observacion ='".$txt."' 
                    where 
                        codantecedentes='".$ca[$i]."' and 
                        codhistoria=$codhistoria ";
                }else{
                    
                    $insert_values=
                    
                    "update historias_antecedentes_personales set observacion =null 
                    where 
                        codantecedentes='".$ca[$i]."' and 
                        codhistoria='$codhistoria' ";
                }
                 $this->historias_model->
                    actualizar_detalle_values($insert_values);
              
            }
           

        }
        
        
       
        

    }



    function _actualizar_revision_por_sistema($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cs=array_filter(explode(",",$this->input->post("cods_sistemas")));

        $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";
        
        for($i=0;$i<sizeof($cs);$i++){

            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["rsis-".$cs[$i]])){
                
                $txt=$array_post["rsis-".$cs[$i]];
                if($array_post["rsis-".$cs[$i]]!=""){
                    $find=true;
                   $insert_values=
                    "UPDATE historias_revision_por_sistema set observacion ='".$txt."' 
                    where 
                        codrevision='".$cs[$i]."' and 
                        codhistoria=$codhistoria "; 
                }else{
                    $insert_values=
                    "UPDATE historias_revision_por_sistema set observacion ='null' 
                    where 
                        codrevision='".$cs[$i]."' and 
                        codhistoria=$codhistoria "; 
                }
               
              
            }
           
            $this->historias_model->
                    actualizar_detalle_values($insert_values);
        }
       
        
        

    }

    
    function _actualizar_examen_fisico_organo($codhistoria){

       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $cs=array_filter(explode(",",$this->input->post("cods_exaf")));

        $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";
        
        for($i=0;$i<sizeof($cs);$i++){

            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["exaf-".$cs[$i]])){
                
                $txt=$array_post["exaf-".$cs[$i]];
                if($array_post["exaf-".$cs[$i]]!=""){
                    $find=true;
                   $insert_values=
                    "UPDATE historias_examen_fisico set observacion ='".$txt."' 
                    where 
                        codexamen='".$cs[$i]."' and 
                        codhistoria=$codhistoria "; 
                }else{
                    $insert_values=
                    "UPDATE historias_examen_fisico set observacion ='null' 
                    where 
                        codexamen='".$cs[$i]."' and 
                        codhistoria=$codhistoria "; 
                }
               
              
            }
           
            $this->historias_model->
                    actualizar_detalle_values($insert_values);
        }
       
        
        

    }

    


    function mostrar_imprimir(){
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="historias/imprimir_historia";
        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']="";
        $historia = $this->uri->segment(3) ;
        
        $datoshistoria=$this->historias_model->buscar_historias_imprimir($historia);
        $data['datoshistoria']=$datoshistoria;
        
        $tipo_examenes=$this->historias_model->buscar_tipo_examenes_imprimir($historia);
        $data['tipo_examenes']=$tipo_examenes;
        
        $concepto_actitud_medica=$this->historias_model->buscar_concepto_actitud_medica_imprimir($historia);
        $data['concepto_actitud_medica']=$concepto_actitud_medica;
        
        //var_dump($datoshistoria);
        $data['paciente']=$this->pacientes_model->buscar_pacientes_imprimir($datoshistoria['0']['paciente']);

        $this->load->view('includes/historias/tpl_historias.php',$data);

    }


    function index(){
       
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="historias/nueva";
        $data['ses']=$this->ses;
        $data['active']="actividades";
        $data['active2']="admactividades";

        $this->load->view('includes/historias/tpl_historias.php',$data);
    }

    

    function edit_data_form(){
        if($this->input->is_ajax_request()){
            $forma_data = $this->uri->segment(3) ;
            $codhistoria=$this->input->post("codhistoria");
            switch($forma_data){
                case "tipo":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre";
                    $this->_search_historias_edit("historias_tipo_examenes","tipo_examenes","codexamen",$codhistoria,"tipo_examenes",$campos);
                break;
                case "datos_paciente":
                    $this->
                        _search_historias_paciente_edit($codhistoria);
                break;
                case "informacion_ocupacional":
                
                    $this->_search_historias_informacion_ocupacional_edit($codhistoria);
                break;
                case "habitos":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre";
                    $this->_search_historias_habitos_edit($codhistoria);
                break;
                case "antecedentes":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre, t.observacion,tp.tipo";
                    $this->_search_historias_edit("historias_antecedentes_personales","antecedentes","codantecedentes",$codhistoria,"antecedentes_personales",$campos);
                break;
                case "factores":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre";
                    $this->_search_historias_edit("historias_factores_deriesgo","detallesderiesgos","codfactor",$codhistoria,"factores",$campos);
                break;
                case "revision_por_sistema":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre, t.observacion";
                    $this->_search_historias_edit("historias_revision_por_sistema","revision_por_sistema","codrevision",$codhistoria,"revision_por_sistema",$campos);
                break;
                case "examen_fisico":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre, t.observacion";
                    $this->_search_historias_edit("historias_examen_fisico","examen_fisico","codexamen",$codhistoria,"examen_fisico",$campos);
                break;
                
                case "examen_fisico_imc":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
               $this->_search_historias_examen_fisico_imc_edit($codhistoria);
                break;
                
                case "examen_fisico_osteo":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $this->_search_historias_examen_fisico_osteo_edit($codhistoria);
                break;

                case "examen_fisico":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre, t.observacion";
                    $this->_search_historias_edit("historias_examen_de_alto_riesgo","examen_fisico","codexamen",$codhistoria,"examen_de_alto_riesgo",$campos);
                break;

                case "examen_de_alto_riesgo":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre,tp.pregunta, tp.tipo, t.valor";
                    $this->_search_historias_edit("historias_examen_de_alto_riesgo","examen_de_alto_riesgo","codexamen",$codhistoria,"examen_de_alto_riesgo",$campos);
                break;

                case "audiometria":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                    $campos="tp.codigo, tp.nombre, t.valor";
                    $this->_search_historias_edit("historias_audiometria","detallesdeaudiometrias","codaudiometria",$codhistoria,"audiometria",$campos);
                    
                break;
                case "diagnosticos":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $campos="tp.codigo, tp.nombre";
                    $this->_search_historias_edit("historias_diagnosticos","diagnosticos","coddiagnostico",$codhistoria,"diagnosticos",$campos);
                break;
                
                case "otros_diagnosticos":
                //$tabla,$tablapadre,$fk,$codhistoria,$vista,$campos
                $this->_search_otrosdiagnosticos_edit($codhistoria);
                break;
                
                case "antecedentes_laborales":
                
                    $this->_search_historias_antecedentes_laborales_edit($codhistoria);
                    
                break;
                case "accidentes":
                
                    $this->_search_historias_accidentes_edit($codhistoria);
                    
                break;

                case "ayudasdiasgnosticas":
                
                    $this->_search_historias_ayudasdiasgnosticas($codhistoria);
                    
                break;

                

                

            }


        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }



    }


    function _search_historias_edit($tabla,$tablapadre,$fk,$codhistoria,$vista,$campos){
        
        $respuesta= $this->historias_model->
                            buscar_historia_edit($tabla,$tablapadre,$fk,$codhistoria,$campos);
        $data['data']=$respuesta;

        $this->load->view('historias/edit/'.$vista,$data);
        
    }


    function _search_historias_paciente_edit($codhistoria){
        
        $respuesta= $this->historias_model->
                        buscar_historia_paciente_edit($codhistoria);
        $data['data']=$respuesta;
        $this->load->view('historias/edit/paciente',$data);
        
    }


    function _search_historias_informacion_ocupacional_edit($codhistoria){
        
        $respuesta= $this->historias_model->
                        buscar_historia_informacion_ocupacional_edit($codhistoria);
        $data['data']=$respuesta;
        $this->load->view('historias/edit/informacion_ocupacional',$data);
        
    }


    function _search_historias_examen_fisico_imc_edit($codhistoria){
        
        $respuesta= $this->historias_model->
                        buscar_historia_examen_fisico_imc_edit($codhistoria);
        $data['data']=$respuesta;
        $this->load->view('historias/edit/examen_fisico_imc',$data);
        
    }

    function _search_otrosdiagnosticos_edit($codhistoria){
        
        $respuesta= $this->historias_model->
                        buscar_historia_otros_diagnosticos($codhistoria);
        $data['data']=$respuesta;
        $this->load->view('historias/edit/otros_diagnosticos',$data);
        
    }



    function _search_historias_habitos_edit($codhistoria){
        
        $respuesta= $this->historias_model->
                        buscar_historias_habitos_edit($codhistoria);
        $data['data']=$respuesta;
        //var_dump($respuesta);
        $this->load->view('historias/edit/habitos',$data);
        
    }



    function _search_historias_examen_fisico_osteo_edit($codhistoria){
        
        $respuesta= $this->historias_model->
                        buscar_historias_examen_fisico_osteo_edit($codhistoria);
        $data['data']=$respuesta;
        //var_dump($respuesta);
        $this->load->view('historias/edit/examen_fisico_osteo',$data);
        
    }

    function mostrar_certificado(){

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="historias/certificado";
        $data['ses']=$this->ses;
        $codhistoria = $this->uri->segment(3) ;

        $data['paciente']=$this->pacientes_model->
                            pacientes_certificado($codhistoria)[0];
        $data['actividades']=$this->actividades_model->
                            actividades_certificado($codhistoria);
        $data['historia']=$this->historias_model->
                            historia_certificado($codhistoria)[0];
        $data['empresa']=$this->empresas_model->
                            empresa_certificado($data['historia']['codempresa'])[0];
        $data['concepto']=$this->concepto_actitud_medica_ocupcional_model->
                            concepto_certificado($codhistoria);
        $data['recomendaciones']=$this->recomendaciones_laborales_model->
                            recomendaciones_certificado($codhistoria);
        $data['tipoexamen']=$this->tipo_examenes_model->
                            tipo_certificado($codhistoria)[0];
        
        $data['active']="historias";

        $data['active2']="certificado";

        $this->load->view('includes/historias/tpl_historias.php',$data);

    }

   function _search_historias_antecedentes_laborales_edit($codhistoria){
    $respuesta= $this->historias_model->
                            buscar_antecedentes_laborales_edit($codhistoria);
        $data['antecedentes_laborales']=$respuesta;

        $this->load->view('historias/edit/antecedentes_laborales',$data);

   }

   function _search_historias_accidentes_edit($codhistoria){
    $respuesta= $this->historias_model->
                            buscar_accidentes_edit($codhistoria);
        $data['accidentes']=$respuesta;

        $this->load->view('historias/edit/accidentes',$data);

   }

   function _search_historias_ayudasdiasgnosticas($codhistoria){
        $respuesta= $this->historias_model->
                            buscar_ayudasdiasgnosticas($codhistoria);
        $data['ayudas']=$respuesta;

        $this->load->view('historias/edit/ayudasdiasgnosticas',$data);

   }



   function update_historia(){
        $tabla=$this->input->post("tabla");    
        $codhistoria=$this->input->post("codhistoria");    
        if($tabla=="antecedentes"){
            $tabla="historias_antecedentes_personales";
            //$this->historias_model->delete_from_historias($tabla,$codhistoria);
            $this->_actualizar_antecedentes_personales($codhistoria);
        }else if($tabla=="sistemas"){
            $tabla="historias_revision_por_sistema";
            //$this->historias_model->delete_from_historias($tabla,$codhistoria);
            $this->_actualizar_revision_por_sistema($codhistoria);
        }else if($tabla=="examen_fisico"){
            $tabla="historias_examen_fisico";
            //$this->historias_model->delete_from_historias($tabla,$codhistoria);
            $this->_actualizar_examen_fisico_organo($codhistoria);
        }else if($tabla=="informacion_ocupacional"){
            $tabla="historias_informacion_ocupacional";
            //$this->historias_model->delete_from_historias($tabla,$codhistoria);
            $this->_update_informacion_ocupacional($codhistoria);
        }else if($tabla=="examen_fisico_imc"){
            $tabla="historias_examen_fisico_imc";
            //$this->historias_model->delete_from_historias($tabla,$codhistoria);
            $this->_update_examen_fisico_imc_ocupacional($codhistoria);
        }else if($tabla=="habitos"){
            $tabla="historias_habitos";
            //$this->historias_model->delete_from_historias($tabla,$codhistoria);
            $this->_update_habitos($codhistoria);
        }else if($tabla=="antecedentes_laborales"){
            $tabla="historias_antecedentes_laborales";
            //$this->historias_model->delete_from_historias($tabla,$codhistoria);
            //pregunta si existe los accidentes laborales para hacer la insercion
            //o para
            if($this->input->post("new")=="1"){
                //echo "voy a guardar $codhistoria";
                $this->_guardar_antedentes_laborales($codhistoria);

            }else{
                //echo "voy a actulizar $codhistoria";
                $this->_update_antecedentes_laborales($codhistoria);
            }


        }else if($tabla=="accidentes"){
            $tabla="historias_accidentes";
            if($this->input->post("new")=="1"){
                //echo "voy a guardar $codhistoria";
                $this->_guardar_accidentes($codhistoria);

            }else{
                //echo "voy a actulizar $codhistoria";
                $this->_update_accidentes($codhistoria);
            }

            //$this->historias_model->delete_from_historias($tabla,$codhistoria);

        }
                

        
    
   }

    function delete_factor(){
        if($this->input->is_ajax_request()){
            $codhistoria    =$this->input->post("codhistoria");
            $codfactor      =$this->input->post("codfactor");
            $tabla          =$this->input->post("tabla");

            if($tabla=="factores"){
                $fk="codfactor";
                $tabla="historias_factores_deriesgo";
            }
                

            $this->historias_model->delete_from_historias_data($tabla,$codhistoria,$codfactor,$fk);
        }

    }

    function delete_diagnostico(){
        if($this->input->is_ajax_request()){
            $codhistoria    =$this->input->post("codhistoria");
            $coddiagnostico =$this->input->post("coddiagnostico");
            $tabla          =$this->input->post("tabla");
            $fk             ="coddiagnostico";
  
            $this->historias_model->delete_from_historias_data($tabla,$codhistoria,$coddiagnostico,$fk);
        }

    }

    function update_historia_riesgos(){
        if($this->input->is_ajax_request()){
            $codhistoria=$this->input->post("codhistoria");
            $this->_guardar_riesgos($codhistoria);

        }

    }


    function update_historia_diagnosticos(){
        if($this->input->is_ajax_request()){
            $codhistoria=$this->input->post("codhistoria");
            $this->_guardar_diagnosticos($codhistoria);

        }

    }


    function _update_informacion_ocupacional($codhistoria){
        $data=array(
            
            "cargo_atual"       =>$this->input->post("cargoactual"),
            "holario_laboral"   =>$this->input->post("horaciolaboral"),
            "turno"             =>$this->input->post("turno"),
            "funciones"         =>$this->input->post("funciones"),
            "antiguedad"        =>$this->input->post("antiguedad")
            );
        var_dump($data);
        return $this->historias_model->actualizar_informacion($codhistoria,$data);

    }

    function _update_examen_fisico_imc_ocupacional($codhistoria){
        $data=array(
            "talla"         =>$this->input->post("talla"),
            "peso"          =>$this->input->post("peso"),
            "ta"            =>$this->input->post("ta"),
            "fc"            =>$this->input->post("fc"),
            "fr"            =>$this->input->post("fr"),
            "brazo"         =>$this->input->post("brazo"),
            "imc"           =>$this->input->post("imc"),
            "temperatura"   =>$this->input->post("temp"),
            "observacion"   =>""
            );
        var_dump($data);
        return $this->historias_model->actualizar_examen_imc($codhistoria,$data);

    }



    function _update_habitos($codhistoria){
        
        $data=array(
            
            "fumador"               =>$this->input->post("fumador"),
            "fuma_frecuencia"       =>$this->input->post("fuma_frecuencia"),
            "fuma_anios"            =>$this->input->post("fuma_anios"),
            "fuma_tipo"             =>$this->input->post("fuma_tipo"),
            "alcohol"               =>$this->input->post("alcohol"),
            "alcohol_frecuencia"    =>$this->input->post("alcohol_frecuencia"),
            "deportes"              =>$this->input->post("deportes"),
            "deportes_frecuencia"   =>$this->input->post("deportes_frecuencia"),
            "lesiones"              =>$this->input->post("lesionesd")
            );
        //var_dump($data);
        return $this->historias_model->actualizar_habitos($codhistoria,$data);

    }



    function _update_antecedentes_laborales($codhistoria){
        $data=array(
            
            "empresaantecedente"        =>$this->input->post("empresaantecedente"),
            "empresaantecedente1"       =>$this->input->post("empresaantecedente1"),
            "cargoanttecedente"         =>$this->input->post("cargoanttecedente"),
            "cargoanttecedente1"        =>$this->input->post("cargoanttecedente1"),
            "tiempoantecedente"         =>$this->input->post("tiempoantecedente"),
            "tiempoantecedente1"        =>$this->input->post("tiempoantecedente1"),
            "incapacidadantecedente"    =>$this->input->post("incapacidadantecedente"),
            "incapacidadantecedente1"   =>$this->input->post("incapacidadantecedente1"),
            "riesgosantecdentes"        =>$this->input->post("riesgosantecdentes"),
            "riesgosantecdentes1"       =>$this->input->post("riesgosantecdentes1")
            );

        return $this->historias_model->update_table($codhistoria,$data,"historias_antecedentes_laborales");

        

    }

        function _update_accidentes($codhistoria){
        $data=array(
            
            "accidentes"        =>$this->input->post("accidentes"),
            "accidentes1"       =>$this->input->post("accidentes1"),
            "enfermedad"         =>$this->input->post("enfermedad"),
            "enfermedad1"        =>$this->input->post("enfermedad1"),
            "fechaaccidente"         =>$this->input->post("fechaaccidente"),
            "fechaaccidente1"        =>$this->input->post("fechaaccidente1"),
            "empresaaccidente"    =>$this->input->post("empresaaccidente"),
            "empresaaccidente1"   =>$this->input->post("empresaaccidente1"),
            "tipodelesion"        =>$this->input->post("tipodelesion"),
            "tipodelesion1"       =>$this->input->post("tipodelesion1"),
            "sitiodelesion"         =>$this->input->post("sitiodelesion"),
            "sitiodelesion1"        =>$this->input->post("sitiodelesion1"),
            "incapacidad"    =>$this->input->post("incapacidad"),
            "incapacidad1"   =>$this->input->post("incapacidad1"),
            "secuelas"        =>$this->input->post("secuelas"),
            "secuelas1"       =>$this->input->post("secuelas1")
            );
        //var_dump($data);
        return $this->historias_model->update_table($codhistoria,$data,"historias_accidentes");

    }


    

    function mostrar_historias(){

        
       $data['codigo']=$this->input->post("or_cod");
       $data['nombres']=$this->input->post("or_nom");
       $data['identificacion']=$this->input->post("or_id");     
      

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="historias/mostrar_historias";
        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']="buscar_historias";

        $this->load->view('includes/empresas/tpl_empresas.php',$data);


    }
 

    function paginar_historias(){
        //por pagina me indica de manera automatica cuantos registros 
        //se van a mostrar por defecto 30

        //para crear la cantidad de paginas para la paginacion
       
        
        //el numero de la pagina para hacer 
        //la consulta de cuales registros mostrar{}
        $por_pagina=$this->input->post("porpagina");
        $pagina=$this->input->post("pagina");
        $data['codpaciente']=$this->input->post("codpaciente");
        $data['fechainicial']=$this->input->post("fechainicial");
        $data['fechafinal']=$this->input->post("fechafinal");


        $this->_pagination_data($por_pagina,$pagina,$data);
        
        

    }

    function _pagination_data($por_pagina,$pagina,$data){

        $data["por_pagina"]         =$por_pagina;
        $data["pagina"]             =$pagina;
        $data["ses"]                =$this->ses;
        $data["numerodepaginas"]    =$this->historias_model->
                                        numerodepaginas($por_pagina,$pagina);
        
        $data["historias"]         =$this->historias_model->
                                        paginacion($por_pagina,$pagina,$data);


         $this->load->view('historias/paginar_resultados',$data);

    }

}


?>