<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class recomendaciones_laborales extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('recomendaciones_laborales_model');
        $this->ses=$this->session->all_userdata();
    }

    function index(){
       
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="recomendaciones_laborales/nuevo";
        $data['ses']=$this->ses;
        $data['active']="formularios";
        $data['active2']="admrecomendaciones_laborales";

        $this->load->view('includes/recomendaciones_laborales/tpl_recomendaciones_laborales.php',$data);
    }

    function show_recomendaciones_laborales(){
        if($this->input->is_ajax_request()){
            $respuesta= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_historia();
            $data['recomendaciones_laborales']=$respuesta;
            $this->load->view('recomendaciones_laborales/show_historia',$data);
        }

    }
     function edit(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->get("codigo");
            
            $respuesta= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_edit($codigo);
            $data['actividad']=$respuesta;
            
            $this->load->view('recomendaciones_laborales/form_edit',$data);
        }
    }
 function edit_detalle(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->get("codigo");
            
            $respuesta= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_detalles_edit($codigo);
            $recomendaciones_laborales= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_select();
            
            $data['detalles']=$respuesta;

            $data['recomendaciones_laborales']=$recomendaciones_laborales;
             
            $this->load->view('recomendaciones_laborales/form_edit_detalle',$data);
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

            $respuesta= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_select();
            $data['recomendaciones_laborales']=$respuesta;
            $this->load->view('recomendaciones_laborales/pagination_recomendaciones_laborales_elegir',$data);
    }
    function mostrar_elegir_validar(){

            $respuesta= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_select();
            $data['recomendaciones_laborales']=$respuesta;
            $this->load->view('recomendaciones_laborales/pagination_recomendaciones_laborales_elegir_validar',$data);
    }


    function contratar(){
       //var_dump($this->input->post());
       
       /*los codigos de las recomendaciones_laborales
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
                    "({codigoempresa},'".
                    $ca[$i]."','".
                    $array_post["tx-".$ca[$i]].
                    "',curdate())$"
                    ;


                
            }
           

        }

        if($find){


            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);
            $codigo=$this->recomendaciones_laborales_model->guardar_contratos(
                    $array_post['codempresa'],
                    $insert_values,
                    $this->ses['codigo']
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
            $codigo=$this->recomendaciones_laborales_model->
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
            $codigo=$this->recomendaciones_laborales_model->
                    editar_detalle($codactividad,$codcontrato,$data);


        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }

    }


    function contratar_nueva(){
       //var_dump($this->input->post());
       
       /*los codigos de las recomendaciones_laborales
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
                recomendaciones_laborales_model->
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
        $data['contrato']=$this->recomendaciones_laborales_model->buscar_contrato($codigo);

        $this->load->view('recomendaciones_laborales/show_contratos',$data);

    }

    function show_contratos_orden(){
        $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->recomendaciones_laborales_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('recomendaciones_laborales/show_contratos_orden',$data);


    }

    function show_contratos_empresa(){
       $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->recomendaciones_laborales_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('recomendaciones_laborales/show_contratos_edit',$data);

    }

    function contratadas(){

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="recomendaciones_laborales/search_recomendaciones_laborales";
        $data['ses']=$this->ses;
        $data['active']="empresas";
        $data['active2']="acontratadas";

        $this->load->view('includes/recomendaciones_laborales/tpl_recomendaciones_laborales.php',$data);

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
       
        if($this->input->is_ajax_request()){
           $data=array(
              
                "nombre"           =>$this->input->post('nombre')
            );
        $this->recomendaciones_laborales_model->guardar_recomendaciones_laborale($data);
            echo "si";
        }else{
            echo "no";
        }

    }

    function guardar_detalle(){
       
        if($this->input->is_ajax_request()){
           $data=array(
              
                "nombre"           =>$this->input->post('nombre_detalle'),
                "codrecomendaciones_laborales"        =>$this->input->post('codrecomendaciones_laboraleadd')
            );
        $this->recomendaciones_laborales_model->guardar_recomendaciones_laborale_detalle($data);
            echo "si";
        }else{
            echo "no";
        }

    }  



     function actualizar(){
       
        if($this->input->is_ajax_request()){
            $codigo =$this->input->post('codigo');
           $data=array(
                
                "nombre"           =>$this->input->post('nombre'),
                "estado"           =>$this->input->post('estado'),
            );
            echo $this->recomendaciones_laborales_model->actualizar_recomendaciones_laborale($data,$codigo);
           
        }else{
            echo "no";
        }

    }   

     function actualizar_detalle(){
       
        if($this->input->is_ajax_request()){
            $codigo =$this->input->post('codigo');
           $data=array(
                
                "nombre"           =>$this->input->post('nombre'),
                "codrecomendaciones_laborales"=>$this->input->post('codrecomendaciones_laborales'),
                "estado"           =>$this->input->post('estado'),
            );
            echo $this->recomendaciones_laborales_model->actualizar_recomendaciones_laborale_detalle($data,$codigo);
           
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
            echo $this->recomendaciones_laborales_model->actualizar_recomendaciones_laborale($data,$codigo);
           
        }else{
            echo "no";
        }

    }
 
    function cambiarestado_detalle(){
        
        if($this->input->is_ajax_request()){
            $accion =$this->input->post('accion');
            $codigo =$this->input->post('codigo');
            //echo $accion.$accion.$accion.$accion;
            if($accion=="a"){
                $estado="activo";
            }else if($accion=="d"){
                 $estado="inactivo";       
            }
           $data=array(
                "estado"=>$estado,
            );
            echo $this->recomendaciones_laborales_model->actualizar_recomendaciones_laborale_detalle($data,$codigo);
           
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
        
        return $this->recomendaciones_laborales_model->existeactividad($actividad,$empresa);
    }

    function buscardetalle(){
        if($this->input->is_ajax_request()){

            $codigo=$this->input->post("codigo");
            
            $respuesta= $this->recomendaciones_laborales_model->buscar_detalle_recomendaciones_laborales_paginacion($codigo);
            $nombre= $this->recomendaciones_laborales_model->buscar_nombre_recomendaciones_laborale($codigo);
            $data['detallesderecomendaciones_laborales']=$respuesta;
            $data['recomendaciones_laborales']=$nombre;
            $data['codigo']=$codigo;
            $data['ses']=$this->ses;

            $this->load->view('recomendaciones_laborales/detalles_paginacion',$data);

        }

    }

    function mostrar_ajax(){
        if($this->input->is_ajax_request()){
            $cantidad_res=$this->input->post("cantidad_res");
            $nombre=$this->input->post("nombre");
            
           
            $estado=$this->input->post("estado");
            //echo  $cantidad_res.$nombre.$tipo.$estado;
            $cantidad= $this->recomendaciones_laborales_model->count_recomendaciones_laborales();
            
            $respuesta= $this->recomendaciones_laborales_model->buscar_recomendaciones_laborales_paginacion($nombre,$estado,$cantidad_res);
         
            
            $data['recomendaciones_laborales']=$respuesta;
            $data['cantidad']=$cantidad;
          
            $data['titulo']="Ultraclinica: ";
            
            $data['ses']=$this->ses;

            $this->load->view('recomendaciones_laborales/paginacion',$data);

        }
       
    }
    




}


?>