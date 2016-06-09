<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class empresas extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('empresas_model');
        $this->ses=$this->session->all_userdata();
    }

    function index(){
       
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="empresas/nueva";
        $data['ses']=$this->ses;
        $data['active']="empresas";
        $data['active2']="admempresas";
        

        $this->load->view('includes/empresas/tpl_empresas.php',$data);
    }

     function nuevo(){
         $usuario=$this->ses['usr_nombre'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="pacientes/nuevo";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_recepcion.php',$data);
        
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

    function contratar(){
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="empresas/contratar";
        $data['ses']=$this->ses;
        $data['active']="empresas";
        $data['active2']="contratarac";
        
        $this->load->view('includes/empresas/tpl_empresas.php',$data);

    }

    function guardar(){
       
        //if($this->_validar()){
        if(true){
           $data=array(
                "nit"                   =>$this->input->post('nit'),
                "razonsocial"           =>$this->input->post('razon'),
                "direccion"             =>$this->input->post('direccion'),
                "ciudad"                =>$this->input->post('ciudad'),
                "departamento"          =>$this->input->post('departamento'),
                "telefono"              =>$this->input->post('telefono'),
                "email"                 =>$this->input->post('email'),
                "fechacreacion"         =>date("Y/m/d H:m:s"),
                "contactofinanciero"    =>$this->input->post('contactof'),
                "celularfinanciero"     =>$this->input->post('contactofc'),
                "emailfinanciero"       =>$this->input->post('contactofe'),
                "solicitante"           =>$this->input->post('solicitante'),
                "celularsolicitante"    =>$this->input->post('solicitantec'),
                "emailsolicitante"      =>$this->input->post('solicitantee'),
                "objetosocial"          =>$this->input->post('objetosocial'),
                "estado"                =>"activo",
                "clave"                 =>$this->aleatorio(),

            );
        $this->empresas_model->guardar_empresa($data);
            echo "si";
        }else{
            echo "no";
        }

    }   


    function aleatorio(){
        $DesdeLetra = "A";
        $HastaLetra = "Z";
        $DesdeNumero = 1;
        $HastaNumero = 9;
        for($i=0;$i<4;$i++){
            $aux[$i]=chr(rand(ord($DesdeLetra), ord($HastaLetra))); 
            $aux[$i]=$aux[$i].rand($DesdeNumero, $HastaNumero);
        }
        $str="";
        foreach($aux as $value1){
            $str=$str.$value1;
        } 
        echo $str;
        return $str;
    }


    function actualizar(){
       
        if($this->input->is_ajax_request()){

             $codigo=$this->input->post("codigo");
           $data=array(
                "nit"                   =>$this->input->post('nit'),
                "razonsocial"           =>$this->input->post('razon'),
                "direccion"             =>$this->input->post('direccion'),
                "ciudad"                =>$this->input->post('ciudad'),
                "departamento"          =>$this->input->post('departamento'),
                "email"                 =>$this->input->post('email'),
                "telefono"              =>$this->input->post('telefono'),
                "contactofinanciero"    =>$this->input->post('contactof'),
                "celularfinanciero"     =>$this->input->post('contactofc'),
                "emailfinanciero"       =>$this->input->post('contactofe'),
                "solicitante"           =>$this->input->post('solicitante'),
                "celularsolicitante"    =>$this->input->post('solicitantec'),
                "emailsolicitante"      =>$this->input->post('solicitantee'),
                "objetosocial"          =>$this->input->post('objetosocial'),
                "estado"                =>"activo",

            );
            $this->empresas_model->actualizar_empresa($data,$codigo);
            echo "si";
        }else{
            echo "no";
        }

    }   

    function existe_empresa_actualizar(){
           if($this->input->is_ajax_request()){
            $codigo=$this->input->post("codigo");
            $nit=$this->input->post("nit");
            if($this->empresas_model->existe_empresa_actualizar($codigo,$nit)){
                echo "no";
            }else{
                echo "si";
            }
        }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }
       
    }

    function buscar_empresa(){

            $respuesta= $this->empresas_model->buscar_empresas_select($this->input->get('nombre'));
            $data['empresas']=$respuesta;
            $data['quien']=$this->input->get('cli');

            $this->load->view('empresas/pagination_empresas',$data);

    }


    public function _validar(){

        $this->form_validation->set_rules('nit','nit','required|trim');
        $this->form_validation->set_rules('razon','razon','required|callback__existe_cliente');
        $this->form_validation->set_rules('direccion','direccion','required|trim');
        $this->form_validation->set_rules('ciudad','ciudad','required|trim');
        $this->form_validation->set_rules('departamento','departamento','required|trim');
        $this->form_validation->set_rules('email','email','required|trim');
        $this->form_validation->set_rules('fecha','fecha','required|trim');
        $this->form_validation->set_rules('contactof','contactof','required|trim');
        $this->form_validation->set_rules('contactofc','contactofc','required|trim');
        $this->form_validation->set_rules('contactofe','contactofe','required|trim');
        $this->form_validation->set_rules('solicitante','solicitante','required|trim');
        $this->form_validation->set_rules('solicitantec','solicitantec','required|trim');
        $this->form_validation->set_rules('solicitantee','solicitantee','required|trim');
        
        //_existe_usuarioack

        if ($this->form_validation->run() == FALSE){
            return false;
        }else{
            return true;
            //$this->enviar_email($this->input->post('email'),$cod_activacion);
        }

    }



    function guardar_cliente_ajax(){
        if($this->input->is_ajax_request()){
                


            }else{
                //hacer vista de acceso denegado
               // echo "acceso denegado";
            }
    }


    

    function existe_empresa_ajax(){
        if($this->input->is_ajax_request()){
                if($this->_existe_empresa($this->input->post('nit'))){
                    echo "no";
                }else{
                    echo "si";
                }
            }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }

    }


    function existe_actividad_ajax(){
        if($this->input->is_ajax_request()){
                if($this->_existe_empresa($this->input->post('nit'))){
                    echo "no";
                }else{
                    echo "si";
                }
            }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }

    }

      function _existe_empresa($valor){
        
        return $this->empresas_model->existeEmpresa($valor);
    }

    function mostrar_ajax(){
        if($this->input->is_ajax_request()){
            $cantidad_res=$this->input->post("cantidad_res");
            $nombre=$this->input->post("nombre");
            $ciudad_search=$this->input->post("ciudad_search");
            $estado=$this->input->post("estado");
            //echo  $cantidad_res.$nombre.$tipo.$estado;
            $cantidad= $this->empresas_model->count_empresas();
            
            $respuesta= $this->empresas_model->buscar_empresas_paginacion($nombre,$ciudad_search,$estado,$cantidad_res);
         
            
            $data['empresas']=$respuesta;
            $data['cantidad']=$cantidad;
          
            $data['titulo']="Ultraclinica: ";
            
            $data['ses']=$this->ses;

            $this->load->view('empresas/paginacion',$data);

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
            echo $this->empresas_model->actualizar_empresa($data,$codigo);
           
        }else{
            echo "no";
        }

    }


    function buscar_empresa_edit(){
        //busca la empresa por el numero de codigo 
        //para devolverlo en un array de Json
        if($this->input->is_ajax_request()){
            $codigo=$this->input->post('codigo');
            $respueta=$this->empresas_model->buscar_empresa($codigo);
            $data['empresa']=$respueta;
            $this->load->view('empresas/data_empresa',$data);
         }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }

        
    }



}


?>