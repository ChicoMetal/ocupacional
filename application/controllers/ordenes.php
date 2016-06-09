<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ordenes extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('ordenes_model');
        date_default_timezone_set('America/New_York');
        $this->ses=$this->session->all_userdata();
    }

    function index(){
       
        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="actividades/nueva";
        $data['ses']=$this->ses;
        $data['active']="actividades";
        $data['active2']="admactividades";

        $this->load->view('includes/actividades/tpl_actividades.php',$data);
    }

     function nuevo(){
         $usuario=$this->ses['usr_nombre'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="pacientes/nuevo";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_recepcion.php',$data);
        
    }

    function buscar(){

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="ordenes/buscar";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="buscar_orden";

        $this->load->view('includes/empresas/tpl_empresas.php',$data);

         
    }

    function buscar_ordenes(){



        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;

        $paciente=$this->input->post("paciente");
        $fecha1=$this->input->post("fecha1");
        $fecha2=$this->input->post("fecha2");
       $data['ordenes']=$this->ordenes_model->buscar_ordenes($paciente,$fecha1,$fecha2);

        $this->load->view('ordenes/mostrar',$data);
    }


    function buscar_ordenes_pendientes_todas(){
        
        $data['ordenes']=$this->ordenes_model->buscar_ordenes($paciente,$fecha1,$fecha2);

        $this->load->view('ordenes/paginacion',$data);
    }

    

    function buscar_ordenes_pendientes(){
        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="ordenes/buscar_ordenes_pendientes";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="buscar_ordenes_pendientes";

        $this->load->view('includes/ordenes/tpl_ordenes',$data);
    }



    function mostrar_elegir(){

            $respuesta= $this->ordenes_model->buscar_actividades_select();
            $data['actividades']=$respuesta;
            $this->load->view('actividades/pagination_actividades_elegir',$data);
    }
    function mostrar_elegir_validar(){

            $respuesta= $this->ordenes_model->buscar_actividades_select();
            $data['actividades']=$respuesta;
            $this->load->view('actividades/pagination_actividades_elegir_validar',$data);
    }


  
    function generar_orden(){
       
      
       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $ca=array_filter(explode(",",$this->input->post("cods_acts")));

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       $codcontrato=$this->input->post("codcontrato");
       $codpaciente=$this->input->post("codpaciente");
       $soloexamenes=$this->input->post("soloexamenes");
       //echo  $soloexamenes;
        $insert_values="";

        for($i=0;$i<sizeof($ca);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["ch-".$ca[$i]])){

                $find=true;
                $insert_values=
                    $insert_values.
                    "({codigorden},'".
                    $array_post["ca-".$ca[$i]].
                    "','pendiente')$"
                   
                    ;



                
            }
           

        }

        if($find){


            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);

            $codigo=$this->ordenes_model->guardar_orden(
                    date("Y/m/d H:m:s"),
                    $codcontrato,
                    $codpaciente,
                    $insert_values,
                    $this->ses['codigo'],
                    $soloexamenes
                    );

           if($codigo==0){
            echo "no";
           }else{
            echo $codigo;
           }

        }else{
            echo "no";
        }

    }


    function actualizar_orden(){
       
      
       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $ca=array_filter(explode(",",$this->input->post("cods_acts")));

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       
       $codorden=$this->input->post("codorden");
       
       //echo  $soloexamenes;
        $insert_values="";

        for($i=0;$i<sizeof($ca);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["ch-".$ca[$i]])){

                $find=true;
                $insert_values=
                    $insert_values.
                    "('$codorden','".
                    $array_post["ca-".$ca[$i]].
                    "','pendiente')$"
                   
                    ;



                
            }
           

        }

        if($find){


            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);

            $codigo=$this->ordenes_model->guardar_orden_detalle($insert_values
                    );

           if($codigo==0){
            echo "no";
           }else{
            echo $codigo;
           }

        }else{
            echo "no";
        }

    }

    function eliminar_actividad_contratada(){
        if($this->input->is_ajax_request()){
            
            $codactividad=$this->input->post("actividad");
            $codcontrato=$this->input->post("codcontrato");
            $codigo=$this->ordenes_model->
                    eliminar_detalle($codactividad,$codcontrato);


        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }


    }

    function editar_detalle(){
        if($this->input->is_ajax_request()){
            $data =array(
                   "valor"=>$this->input->post("nuevo_valor"),
                    "modificado"=>date("y/m/d")." ".$this->hora_local(-5),


                );
            $codactividad=$this->input->post("cod_actividad");
            $codcontrato=$this->input->post("codcontrato");
            $codigo=$this->ordenes_model->
                    editar_detalle($codactividad,$codcontrato,$data);


        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }

    }


    function contratar_nueva(){
       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $ca=array_filter(explode(",",$this->input->post("cods_acts")));

       $find=false;
      $array_post=$this->input->post();
        //echo sizeof($array_post);
       
        $insert_values="";

        for($i=0;$i<sizeof($ca);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["ch-".$ca[$i]])){
                $find=true;
                $insert_values=
                    $insert_values.
                    "('".$array_post['codcontrato']."','".
                    $ca[$i]."','".
                    $array_post["tx-".$ca[$i]].
                    "',curdate())$"
                    ;


                
            }
           

        }

        if($find){


            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            $codigo=$this->
                ordenes_model->
                    guardar_contratos_detalle($insert_values);

           if($codigo==0){
            echo "no";
           }else{
            echo $codigo;
           }

        }else{
            echo "no";
        }

    }


    function show_contratos(){
        $codigo = $this->uri->segment(3) ;
        $data['contrato']=$this->ordenes_model->buscar_contrato($codigo);

        $this->load->view('actividades/show_contratos',$data);

    }

    function show_contratos_orden(){
        $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->ordenes_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('actividades/show_contratos_orden',$data);


    }

    function show_contratos_orden_edit(){
        $orden = $this->uri->segment(3);
        $contrato = $this->uri->segment(4);
        $corden = $this->uri->segment(5);
        $data['contrato']=$this->ordenes_model->buscar_contrato_codempresa_edit($orden,$contrato,$corden);

        $this->load->view('ordenes/show_contratos_orden_edit',$data);


    }



    function show_contratos_empresa(){
       $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->ordenes_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('actividades/show_contratos_edit',$data);

    }

    function contratadas(){

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="actividades/search_actividades";
        $data['ses']=$this->ses;
        $data['active']="empresas";
        $data['active2']="acontratadas";

        $this->load->view('includes/actividades/tpl_actividades.php',$data);

    }


    function hora_local($zona_horaria = 0){
        if ($zona_horaria > -12.1 and $zona_horaria < 12.1)
        {
            $hora_local = time() + ($zona_horaria * 3600);
            return $hora_local;
        }
        return 'error';
    }


    function guardar(){
       
        if($this->_validar()){
           $data=array(
              
                "nombre"           =>$this->input->post('nombre'),
                "descripcion"             =>$this->input->post('descripcion'),
                "valor"                =>$this->input->post('valor'),
                "estado"                =>"activa",

            );
        $this->ordenes_model->guardar_actividad($data);
            echo "si";
        }else{
            echo "no";
        }

    }   


    public function _validar(){

        $this->form_validation->set_rules('nombre','nombre','required|trim');
        $this->form_validation->set_rules('descripcion','descripcion','required|trim');
        $this->form_validation->set_rules('valor','valor','required|trim');
        
      

        if ($this->form_validation->run() == FALSE){
            return false;
        }else{
            return true;
            
        }

    }



    function guardar_cliente_ajax(){
        if($this->input->is_ajax_request()){
                


            }else{
                //hacer vista de acceso denegado
               // echo "acceso denegado";
            }
    }


    

    function existe_actividad_ajax(){
         //echo "buscandooooo111";
        if($this->input->is_ajax_request()){
           // echo "buscandooooo";
                $actividad=$this->input->post('codactividad');
                $empresa=$this->input->post('codempresa');

                if($this->_existe_actividad( $actividad,$empresa)=="0"){
                    echo "no";
                }else{
                    echo "si";
                }
            }else{
                //hacer vista de acceso denegado
                echo "acceso denegado";
            }

    }

      function _existe_actividad($actividad,$empresa){
        
        return $this->ordenes_model->existeactividad($actividad,$empresa);
    }

    function mostrar_ajax(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->post("codigo");
            
            $data['ordenes']= $this->ordenes_model->buscar_orden_codigo($codigo);
          
            $this->load->view('ordenes/mostrar',$data);

        }
       
    }
    
    function paginar(){
        //por pagina me indica de manera automatica cuantos registros 
        //se van a mostrar por defecto 30

        //para crear la cantidad de paginas para la paginacion
       
        
        //el numero de la pagina para hacer 
        //la consulta de cuales registros mostrar{}
        $por_pagina=$this->input->post("porpagina");
        $pagina=$this->input->post("pagina");
        $paciente=$this->input->post("paciente");
        $this->_pagination_data($por_pagina,$pagina,$paciente);


    }

    function _pagination_data($por_pagina,$pagina,$paciente){

        $data["por_pagina"]         =$por_pagina;
        $data["pagina"]             =$pagina;
        $data["ses"]                =$this->ses;
        $data["numerodepaginas"]    =$this->ordenes_model->
                                        numerodepaginas($por_pagina,$pagina);
        
        $data["actividades"]         =$this->ordenes_model->
                                        paginacion($por_pagina,$pagina,$paciente);


         $this->load->view('ordenes/paginar_resultados',$data);

    }


    function paginar_otros(){
        //por pagina me indica de manera automatica cuantos registros 
        //se van a mostrar por defecto 30

        //para crear la cantidad de paginas para la paginacion
       
        
        //el numero de la pagina para hacer 
        //la consulta de cuales registros mostrar{}
        $por_pagina=$this->input->post("porpagina");
        $pagina=$this->input->post("pagina");
        $paciente= $this->input->post("paciente");
        $this->_pagination_data_otros($por_pagina,$pagina,$paciente);


    }

    function _pagination_data_otros($por_pagina,$pagina,$paciente){

        $data["por_pagina"]         =$por_pagina;
        $data["pagina"]             =$pagina;
        $data["ses"]                =$this->ses;
        $data["numerodepaginas"]    =$this->ordenes_model->
                                        numerodepaginas_otros($por_pagina,$pagina);
        
        $data["actividades"]         =$this->ordenes_model->
                                        paginacion_otros($por_pagina,$pagina,$paciente);

        

         $this->load->view('ordenes/paginar_resultados_otros',$data);

    }

    function editar(){
        $orden=$this->input->post("orden");

        $usuario=$this->ses['nombres'];

        $data["orden"] =$this->ordenes_model->buscar_orden_data($orden);
        

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="ordenes/editar_ordenes";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="orden_atencion";
        $data['codorden']=$orden;

        $this->load->view('includes/empresas/tpl_empresas.php',$data);
             
                                
    }

    function cancelar(){

        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="ordenes/cancelar";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="cancelarorden";
       
        $this->load->view('includes/empresas/tpl_empresas.php',$data);
            
    }

    function cancelar_orden(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->post("codigo");
            echo  $this->ordenes_model->actualizarestado("cancelada",$codigo);
            echo  $this->ordenes_model->actualizarestado_detalle("cancelada",$codigo);


        } 
    }
}


?>