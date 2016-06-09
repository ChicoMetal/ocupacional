<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class actividades extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('actividades_model');
        $this->ses=$this->session->all_userdata();
    }



    function index(){
       
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="actividades/nuevo";
        $data['ses']=$this->ses;
        $data['active']="actividades";
        $data['active2']="admactividades";

        

        $this->load->view('includes/actividades/tpl_actividades.php',$data);
    }

    function show_historia(){
        if($this->input->is_ajax_request()){
            $respuesta= $this->actividades_model->buscar_actividades_historia();
            $data['actividades']=$respuesta;
            
            $this->load->view('actividades/show_historia',$data);
        }

    }

     function edit(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->get("codigo");
            
            $respuesta= $this->actividades_model->buscar_actividades_edit($codigo);
            $data['actividad']=$respuesta;
            
            $this->load->view('actividades/form_edit',$data);
        }
    }



     function nuevo(){
         $usuario=$this->ses['usr_nombre'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="pacientes/nuevo";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_recepcion.php',$data);
        
    }

    function mostrar_elegir(){

            $respuesta= $this->actividades_model->buscar_actividades_select();
            $data['actividades']=$respuesta;
            $this->load->view('actividades/pagination_actividades_elegir',$data);
    }
    
    function mostrar_elegir_validar(){

            $respuesta= $this->actividades_model->buscar_actividades_select();
            $data['actividades']=$respuesta;
            $this->load->view('actividades/pagination_actividades_elegir_validar',$data);
    }

    function contratar(){
        //var_dump($this->input->post());

        /*los codigos de las actividades
        array_filter elimina el elemeto vacio del aaray 
        */
        $ca=array_filter(explode(",",$this->input->post("cods_acts")));
        $fechafinal=$this->input->post("fechafinal");

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
                    "({codigoempresa},'".
                    $ca[$i]."','".
                    $array_post["tx-".$ca[$i]].
                    "',curdate())$"
                    ;


                
            }
           

        }

        if($find){

            $contrato=$this->input->post("contrato");

            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            $codigo=$this->actividades_model->guardar_contratos(
                    $array_post['codempresa'],
                    $insert_values,
                    $this->ses['codigo'],
                    $fechafinal,
                    $contrato
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
            $codigo=$this->actividades_model->
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
            $codigo=$this->actividades_model->
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

            $codigo=$this->actividades_model->
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
        $data['contrato']=$this->actividades_model->buscar_contrato($codigo);

        $this->load->view('actividades/show_contratos',$data);

    }

    function show_contratos_orden(){
        $codigo = $this->uri->segment(3);

        $data['contrato']=$this->actividades_model->buscar_contrato_codempresa($codigo);

        $this->load->view('actividades/show_contratos_orden',$data);


    }

    function show_contratos_empresa(){
        $codigo = $this->uri->segment(3);

        $data['contratos']=$this->actividades_model->buscar_contrato_codempresa_nombre($codigo);

        $this->load->view('actividades/show_select_contratos',$data);

    }

    function show_contratos_empresa_codigo(){
        $codigo = $this->uri->segment(3);

        $data['contrato']=$this->actividades_model->buscar_contrato_codigo($codigo);

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


    function hora_local($zona_horaria = 0)
    {
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
              
                "nombre"                =>$this->input->post('nombre'),
                "descripcion"           =>$this->input->post('descripcion'),
                "valor"                 =>$this->input->post('valor'),
                "historia_obligatoria"  =>$this->input->post('historia_obligatoria'),
                "estado"                =>"activo",

            );
        $this->actividades_model->guardar_actividad($data);
            echo "si";
        }else{
            echo "no";
        }
    }  

     function actualizar(){
       
        if($this->input->is_ajax_request()){
            $codigo =$this->input->post('codigo');
           $data=array(
                
                "nombre"                =>$this->input->post('nombre'),
                "descripcion"           =>$this->input->post('descripcion'),
                "valor"                 =>$this->input->post('valor'),
                "historia_obligatoria"  =>$this->input->post('historia_obligatoria'),
                "estado"                =>$this->input->post('estado'),
            );
            echo $this->actividades_model->actualizar_actividad($data,$codigo);
           
        }else{
            echo "no";
        }

    }


    function actualizar_fecha_contrato(){
        if($this->input->is_ajax_request()){
            $fecha =$this->input->post('fecha');
            $contrato =$this->input->post('contrato');


            $data=array(
                "fechafinal"=>$fecha

            );
            echo $this->actividades_model->actualizar_fecha_contrato($data,$contrato);

        }else{
            echo "no";
        }

    }

    function cambiarestado(){
        if($this->input->is_ajax_request()){
            $accion =$this->input->post('accion');
            $codigo =$this->input->post('codigo');
            echo $accion.$accion.$accion.$accion;
            if($accion=="a"){
                $estado="activo";
            }else if($accion=="d"){
                 $estado="inactivo";       
            }
           $data=array(
                "estado"=>$estado,
            );
            echo $this->actividades_model->actualizar_actividad($data,$codigo);
           
        }else{
            echo "no";
        }

    }

    public function _validar(){

        return true;

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
                $contrato=$this->input->post('contrato');

                if($this->_existe_actividad_contrato( $actividad,$empresa,$contrato)=="0"){
                    echo "no";
                }else{
                    echo "si";
                }
            }else{
                //hacer vista de acceso denegado
                echo "acceso denegado";
            }

    }


    function _existe_actividad($actividad,$empresa,$contrato){

        return $this->actividades_model->existeactividad($actividad,$empresa,$contrato);
    }




    function _existe_actividad_contrato($actividad,$empresa,$contrato){

        return $this->actividades_model->existeactividadcontrato($actividad,$empresa,$contrato);
    }




    function mostrar_ajax(){
        if($this->input->is_ajax_request()){
            $cantidad_res=$this->input->post("cantidad_res");
            $nombre=$this->input->post("nombre");
          
            $estado=$this->input->post("estado");
            //echo  $cantidad_res.$nombre.$tipo.$estado;
            $cantidad= $this->actividades_model->count_actividades();
            
            $respuesta= $this->actividades_model->buscar_actividades_paginacion($nombre,$estado,$cantidad_res);
         
            
            $data['actividades']=$respuesta;
            $data['cantidad']=$cantidad;
          
            $data['titulo']="Ultraclinica: ";
            
            $data['ses']=$this->ses;

            $this->load->view('actividades/paginacion',$data);

        }
       
    }
    
    function existe_contrato(){
         if($this->input->is_ajax_request()){
            $codempresa=$this->input->post("codempresa");
           
            echo $this->actividades_model->existe_contrato($codempresa);
    
           

        }


    }



}


?>