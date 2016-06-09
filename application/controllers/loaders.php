<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class loaders extends CI_Controller{
   

    function loader(){
    	$loader = $this->uri->segment(3) ;
    	$data['gif']=$loader;
        $this->load->view('loaders/show',$data);

    }
}


?>