<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class citas extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('pacientes_model');
        $this->load->model('citas_model');
        $this->ses=$this->session->all_userdata();
    }

    function index(){
       
        echo "hola";

        //$this->load->view('includes/tpl_cotizaciones.php',$data);
    }

     function nueva(){
        
         if ($this->uri->segment(3) === FALSE){
            $codigo = 0;

        }else{
            $codigo=$this->uri->segment(3);
            $usuario=$this->ses['usr_nombre'];

            $data['titulo']="Ultraclinica: ".$usuario;

            $paciente= $this->pacientes_model->buscar_pacientes_codigo($codigo);

            $data['paciente']=$paciente;

            $data['contenido_principal']="citas/nueva";
            $data['ses']=$this->ses;

            $this->load->view('includes/tpl_recepcion.php',$data);
        }
       
        
    }

    function calendario(){
        $usuario=$this->ses['usr_nombre'];
        $data['titulo']="Ultraclinica::Calendario ".$usuario;
        $data['contenido_principal']="citas/calendario";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_recepcion.php',$data);        
    }

    function guardar_citas(){
        if(true){
            $data=array(
                "con_paciente"        =>$this->input->post('cod_paciente'),
                "con_fecha"         =>$this->input->post('feha')." ".$this->input->post('hora'),
                "con_medico"           =>$this->input->post('medico'),
                "con_motivo"             =>$this->input->post('motivo'),
                "con_observaciones"           =>$this->input->post('observacion'),
                "fecharealizacion"          =>date("Y/m/d H:m:s"),
               
  

            );
                $this->citas_model->insertar_cita($data);
                    echo "si";
                }else{
                    echo "no";
                }

    }   




}


?>