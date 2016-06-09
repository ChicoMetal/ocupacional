<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuarios extends CI_Controller {
    var $CI;
    function __construct() {
        parent::__construct();
        $this->load->library('basicauth');
        $this->load->model('usuarios_model');
       
        
     }


    public function index() {
        $this->login_form('');
    }

    function login_form($data){

        $data['titulo']="Acceso a MotoSoft";
        $data['contenido_principal']="usuarios/login";
        $this->load->view('includes/login/tpl_login',$data);

    }
    function userdata(){
        $this->session->set_userdata(array(
                                        'logued'            =>false,
                                        'codigo'         =>"",
                                        'nombres'         =>"",
                                        'permisos'       =>"",
                                        'identificacion' =>"",
                                        'avatar'         =>""

                                        )
                                            );

    }

    function login(){

        $this->form_validation->set_rules('usuario','Usuario','required');
        $this->form_validation->set_rules('password','Contraseña ','required|md5');
        $this->form_validation->set_message('required', 'El campo %s es requerido','md5');

        if ($this->form_validation->run() == FALSE){
            $this->index();
        }else{
           $respuesta= $this->basicauth->login($this->input->post('usuario'),$this->input->post('password'));
           //var_dump($respuesta);
            if(!isset($respuesta['error'])){
                $arr_data_session=$this->session->all_userdata();
                //var_dump($arr_data_session);
                if($arr_data_session['permisos']=="administracion"){
                     $this->log_user('si');
                     redirect('administracion');
                }else if($arr_data_session['permisos']=="enfermeras"){
                     $this->log_user('si');
                     redirect('enfermeras');

                }

            }else{
                $this->log_user('no');
                $data['error']=$respuesta['error'];
                $this->login_form($data);
            }
        }



    }

    public function logout(){

         $this->userdata();
       $this->session->sess_destroy();
        redirect("");
    }


/*
    function logout(){
        $this->basicauth->logout();
         redirect('usuarios/index');
    }
*/

    function usuarios(){
        $data['titulo']="MotoSoft::Docentes";
        $data['contenido_principal']="usuarios/docentes";
        $this->load->view('includes/tpl_docentes',$data);


    }

    function verificar(){

        if ($this->form_validation->run() == FALSE){
            $this->login();
        }else{


             $resul=$this->usuarios_model->buscar_usuarios($data);
             if($resul!=false){
                $row = $resul->row();

                    $session_data = array(
                        'numedeiden'  => $row->numedeiden,
                        'nombre'     => $row->nombre,
                        'permisos'     => $row->permisos,
                        'loged_in' => TRUE
                    );

                $this->session->set_userdata($session_data);
                if($row->permisos=="pro"){
                    $this->usuarios();
                }

             }else{
                 $this->login();
             }
            //$this->enviar_email($this->input->post('email'),$cod_activacion);
        }



    }

    function log_user($log){
        $sess=$this->session->all_userdata();
        $cod="";
        if(isset($sess['codigo'])){
            $cod=$sess['codigo'];
        }

        $this->usuarios_model->
               insert_log( 
                        $_SERVER['REMOTE_ADDR'],
                        $this->input->post('usuario'),
                        $this->input->post('password'),
                        $log,
                        'usuarios',
                        $cod
                        );

       
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */