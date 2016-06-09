<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class proveedores extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('proveedores_model');
        $this->ses=$this->session->all_userdata();
    }

    function index(){
       
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="proveedores/nueva";
        $data['ses']=$this->ses;
        $data['active']="proveedores";
        $data['active2']="admproveedores";
        

        $this->load->view('includes/proveedores/tpl_proveedores.php',$data);
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
        $data['contenido_principal']="proveedores/contratar";
        $data['ses']=$this->ses;
        $data['active']="proveedores";
        $data['active2']="contratarac";
        
        $this->load->view('includes/proveedores/tpl_proveedores.php',$data);

    }

    function guardar(){
       
        //if($this->_validar()){
        if(true){
           $data=array(
               
                "nombre"           =>$this->input->post('nombre'),
                "direccion"        =>$this->input->post('direccion'),
                "telefono"         =>$this->input->post('telefono'),
                "celular"          =>$this->input->post('celular'),
                "contacto"         =>$this->input->post('contacto'),
                "estado"           =>"activo",

            );
        $this->proveedores_model->guardar_proveedor($data);
            echo "si";
        }else{
            echo "no";
        }

    }   


    function actualizar(){
       
        if($this->input->is_ajax_request()){

             $codigo=$this->input->post("codigo");
           $data=array(
                "nombre"           =>$this->input->post('nombre'),
                "direccion"        =>$this->input->post('direccion'),
                "telefono"         =>$this->input->post('telefono'),
                "celular"          =>$this->input->post('celular'),
                "contacto"         =>$this->input->post('contacto'),
                "estado"           =>"activo",

            );
            $this->proveedores_model->actualizar_proveedor($data,$codigo);
            echo "si";
        }else{
            echo "no";
        }

    }   


    function buscar_proveedor(){

            $respuesta= $this->proveedores_model->buscar_proveedores_select($this->input->get('nombre'));
            $data['proveedores']=$respuesta;
            $data['quien']=$this->input->get('cli');

            $this->load->view('proveedores/pagination_proveedores',$data);

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


    

    function existe_proveedor_ajax(){
        if($this->input->is_ajax_request()){
                if($this->_existe_proveedor($this->input->post('nit'))){
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
                if($this->_existe_proveedor($this->input->post('nit'))){
                    echo "no";
                }else{
                    echo "si";
                }
            }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }

    }

      function _existe_proveedor($valor){
        
        return $this->proveedores_model->existeproveedor($valor);
    }

    function mostrar_ajax(){
        if($this->input->is_ajax_request()){
            $cantidad_res=$this->input->post("cantidad_res");
            $nombre=$this->input->post("nombre");
            
            $estado=$this->input->post("estado");
            //echo  $cantidad_res.$nombre.$tipo.$estado;
            $cantidad= $this->proveedores_model->count_proveedores();
            
            $respuesta= $this->proveedores_model->buscar_proveedores_paginacion($nombre,$estado,$cantidad_res);
         
            
            $data['proveedores']=$respuesta;
            $data['cantidad']=$cantidad;
          
            $data['titulo']="Ultraclinica: ";
            
            $data['ses']=$this->ses;

            $this->load->view('proveedores/paginacion',$data);

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
            echo $this->proveedores_model->actualizar_proveedor($data,$codigo);
           
        }else{
            echo "no";
        }

    }


    function buscar_proveedor_edit(){
        //busca la proveedor por el numero de codigo 
        //para devolverlo en un array de Json
        if($this->input->is_ajax_request()){
            $codigo=$this->input->post('codigo');
            $respueta=$this->proveedores_model->buscar_proveedor($codigo);
            $data['proveedor']=$respueta;
            $this->load->view('proveedores/data_proveedor',$data);
         }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }

        
    }



}


?>