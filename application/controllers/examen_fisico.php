<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class examen_fisico extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('examen_fisico_model');
        $this->ses=$this->session->all_userdata();
    }


    function index(){
       
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="examen_fisico/nuevo";
        $data['ses']=$this->ses;
        $data['active']="formularios";
        $data['active2']="admexamen_fisico";

        $this->load->view('includes/examen_fisico/tpl_examen_fisico.php',$data);
    }

    function show_historia(){
        if($this->input->is_ajax_request()){
            $respuesta= $this->examen_fisico_model->buscar_examen_fisico_historia();
            $data['examen_fisico']=$respuesta;
            $this->load->view('examen_fisico/show_historia',$data);
        }

    }

     function edit(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->get("codigo");
            
            $respuesta= $this->examen_fisico_model->buscar_examen_fisico_edit($codigo);
            $data['actividad']=$respuesta;
            
            $this->load->view('examen_fisico/form_edit',$data);
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

            $respuesta= $this->examen_fisico_model->buscar_examen_fisico_select();
            $data['examen_fisico']=$respuesta;
            $this->load->view('examen_fisico/pagination_examen_fisico_elegir',$data);
    }
    function mostrar_elegir_validar(){

            $respuesta= $this->examen_fisico_model->buscar_examen_fisico_select();
            $data['examen_fisico']=$respuesta;
            $this->load->view('examen_fisico/pagination_examen_fisico_elegir_validar',$data);
    }


    function contratar(){
       //var_dump($this->input->post());
       
       /*los codigos de las examen_fisico
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
            $codigo=$this->examen_fisico_model->guardar_contratos(
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
            $codigo=$this->examen_fisico_model->
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
            $codigo=$this->examen_fisico_model->
                    editar_detalle($codactividad,$codcontrato,$data);


        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }

    }


    function contratar_nueva(){
       //var_dump($this->input->post());
       
       /*los codigos de las examen_fisico
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
                examen_fisico_model->
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
        $data['contrato']=$this->examen_fisico_model->buscar_contrato($codigo);

        $this->load->view('examen_fisico/show_contratos',$data);

    }

    function show_contratos_orden(){
        $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->examen_fisico_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('examen_fisico/show_contratos_orden',$data);


    }

    function show_contratos_empresa(){
       $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->examen_fisico_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('examen_fisico/show_contratos_edit',$data);

    }

    function contratadas(){

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="examen_fisico/search_examen_fisico";
        $data['ses']=$this->ses;
        $data['active']="empresas";
        $data['active2']="acontratadas";

        $this->load->view('includes/examen_fisico/tpl_examen_fisico.php',$data);

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
        $this->examen_fisico_model->guardar_examen_fisico($data);
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
            echo $this->examen_fisico_model->actualizar_examen_fisico($data,$codigo);
           
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
            echo $this->examen_fisico_model->actualizar_examen_fisico($data,$codigo);
           
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
        
        return $this->examen_fisico_model->existeactividad($actividad,$empresa);
    }


    function mostrar_ajax(){
        if($this->input->is_ajax_request()){
            $cantidad_res=$this->input->post("cantidad_res");
            $nombre=$this->input->post("nombre");
           
            $estado=$this->input->post("estado");
            //echo  $cantidad_res.$nombre.$tipo.$estado;
            $cantidad= $this->examen_fisico_model->count_examen_fisico();
            
            $respuesta= $this->examen_fisico_model->buscar_examen_fisico_paginacion($nombre,$estado,$cantidad_res);
         
            
            $data['examen_fisico']=$respuesta;
            $data['cantidad']=$cantidad;
          
            $data['titulo']="Ultraclinica: ";
            
            $data['ses']=$this->ses;

            $this->load->view('examen_fisico/paginacion',$data);

        }
       
    }
    

    function change_historia(){
        if($this->input->is_ajax_request()){
           $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->
            				examen_fisico_model->
            				buscar_examenes_historia_edit($data["codhistoria"]);
            $data['examen_fisico']=$respuesta;
            $this->load->view('examen_fisico/change_historia',$data);
           
        }

    }

    function update_historia(){
        if($this->input->is_ajax_request()){
            $codhistoria=$this->input->post("codhistoria");
            $data=array(
                    "codexamen" =>$this->input->post('codigo')
                    );
            $this->examen_fisico_model->actualizar_examen_fisico_historia($codhistoria,$data);

        }   

    }

}


?>