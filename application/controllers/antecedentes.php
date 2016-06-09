<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class antecedentes extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('antecedentes_model');
        $this->ses=$this->session->all_userdata();
    }


    function index(){
       
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="antecedentes/nuevo";
        $data['ses']=$this->ses;
        $data['active']="formularios";
        $data['active2']="admantecedentes";

        $this->load->view('includes/antecedentes/tpl_antecedentes.php',$data);
    }

    function show_historia(){
        if($this->input->is_ajax_request()){
            $respuesta= $this->antecedentes_model->buscar_antecedentes_historia();
            $data['antecedentes']=$respuesta;
            
            $this->load->view('antecedentes/show_historia',$data);
        }

    }

     function edit(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->get("codigo");
            
            $respuesta= $this->antecedentes_model->buscar_antecedentes_edit($codigo);
            $data['actividad']=$respuesta;
            
            $this->load->view('antecedentes/form_edit',$data);
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

            $respuesta= $this->antecedentes_model->buscar_antecedentes_select();
            $data['antecedentes']=$respuesta;
            $this->load->view('antecedentes/pagination_antecedentes_elegir',$data);
    }
    function mostrar_elegir_validar(){

            $respuesta= $this->antecedentes_model->buscar_antecedentes_select();
            $data['antecedentes']=$respuesta;
            $this->load->view('antecedentes/pagination_antecedentes_elegir_validar',$data);
    }


    function contratar(){
       //var_dump($this->input->post());
       
       /*los codigos de las antecedentes
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
            $codigo=$this->antecedentes_model->guardar_contratos(
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
            $codigo=$this->antecedentes_model->
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
            $codigo=$this->antecedentes_model->
                    editar_detalle($codactividad,$codcontrato,$data);


        }else{
            //hacer vista de acceso denegado
           // echo "acceso denegado";
        }

    }


    function contratar_nueva(){
       //var_dump($this->input->post());
       
       /*los codigos de las antecedentes
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
                antecedentes_model->
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
        $data['contrato']=$this->antecedentes_model->buscar_contrato($codigo);

        $this->load->view('antecedentes/show_contratos',$data);

    }

    function show_contratos_orden(){
        $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->antecedentes_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('antecedentes/show_contratos_orden',$data);


    }

    function show_contratos_empresa(){
       $codigo = $this->uri->segment(3);
        $fecha = $this->uri->segment(4);
        $data['contrato']=$this->antecedentes_model->buscar_contrato_codempresa($codigo,$fecha);

        $this->load->view('antecedentes/show_contratos_edit',$data);

    }

    function contratadas(){

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="antecedentes/search_antecedentes";
        $data['ses']=$this->ses;
        $data['active']="empresas";
        $data['active2']="acontratadas";

        $this->load->view('includes/antecedentes/tpl_antecedentes.php',$data);

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
              
                "nombre"           =>$this->input->post('nombre'),
                "tipo"             =>$this->input->post('tipo')
            );
        $this->antecedentes_model->guardar_antecedente($data);
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
                "tipo"             =>$this->input->post('tipo'),
                "estado"           =>$this->input->post('estado'),
            );
            echo $this->antecedentes_model->actualizar_antecedente($data,$codigo);
           
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
            echo $this->antecedentes_model->actualizar_antecedente($data,$codigo);
           
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
        
        return $this->antecedentes_model->existeactividad($actividad,$empresa);
    }


    function mostrar_ajax(){
        if($this->input->is_ajax_request()){
            $cantidad_res=$this->input->post("cantidad_res");
            $nombre=$this->input->post("nombre");
            $tipo=$this->input->post("tipo");
            $estado=$this->input->post("estado");
            //echo  $cantidad_res.$nombre.$tipo.$estado;
            $cantidad= $this->antecedentes_model->count_antecedentes();
            
            $respuesta= $this->antecedentes_model->buscar_antecedentes_paginacion($nombre,$tipo,$estado,$cantidad_res);
         
            
            $data['antecedentes']=$respuesta;
            $data['cantidad']=$cantidad;
          
            $data['titulo']="Ultraclinica: ";
            
            $data['ses']=$this->ses;

            $this->load->view('antecedentes/paginacion',$data);

        }
       
    }
    

    function change_historia(){
       if($this->input->is_ajax_request()){
            $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->antecedentes_model->buscar_antecedentes_historia_edit($data["codhistoria"]);
            $data['antecedentes']=$respuesta;
            $this->load->view('antecedentes/change_historia',$data);

       }     

    }


}


?>