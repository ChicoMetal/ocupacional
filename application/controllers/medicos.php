<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class medicos extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('pacientes_model');
        $this->load->model('citas_model');
        $this->ses=$this->session->all_userdata();
    }

    function index(){
       
        $usuario=$this->ses['usr_nombre'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="medicos/index";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_medicos.php',$data);
    }
     function calendario(){
       
        $usuario=$this->ses['usr_nombre'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="medicos/calendario";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_medicos.php',$data);
    }


    function principal(){
        $this->load->view('cotizaciones/principal');


    }

   
    function consultas(){
       $limit="";
        if($this->input->get('limit')){
            $limit="limit ".$this->input->get('limit');

        }
        
        

        $citas= $this->citas_model->buscar_citas($this->ses['usr_identificacion']);
        
        $data['pacientes']=$citas;
        
        $data['titulo']="Ultraclinica: ";
        $data['contenido_principal']="medicos/consultas";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_medicos.php',$data);
    }
    

    function  atencion(){
        
         if ($this->uri->segment(3) === FALSE){
            $codigo = 0;

        }else{
            $codigo=$this->uri->segment(3);
            $usuario=$this->ses['usr_nombre'];

            $data['titulo']="Ultraclinica: ".$usuario;

            $paciente= $this->pacientes_model->buscar_pacientes_codigo($codigo);

            $data['paciente']=$paciente;

            $data['contenido_principal']="medicos/atencion";
            $data['ses']=$this->ses;

            $this->load->view('includes/tpl_medicos.php',$data);
        }
       
        
    }

    



    




}


?>