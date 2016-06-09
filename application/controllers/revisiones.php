<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class revisiones extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->load->model('revisiones_model');
        $this->ses=$this->session->all_userdata();
    }



    function change_historia(){
       if($this->input->is_ajax_request()){
            $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->revisiones_model->buscar_revisiones_historia_edit($data["codhistoria"]);
            $data['sistema']=$respuesta;
            $this->load->view('revisiones/change_historia',$data);

       }     

    }


}


?>