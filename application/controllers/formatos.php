<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class formatos extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        $this->ses=$this->session->all_userdata();
    }
     
    function mostrar_certificado_historia(){

        $codhistoria = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="formatos/mostrarpdf";

        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']="";
        $data['url']=base_url()."pdf/certificado.php?codigo=".$codhistoria;
        
        $this->load->view('includes/historias/tpl_historias.php',$data);


   }

    function mostrar_historia(){

        $codhistoria = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="formatos/mostrarpdf";

        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']="";
        $data['url']=base_url()."pdf/historias.php?codigo=".$codhistoria;
        
        $this->load->view('includes/historias/tpl_historias.php',$data);


   }


    function mostrar_certificado_audio(){


        $codhistoria = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="formatos/mostrarpdf";

        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']="";
        $data['url']=base_url()."pdf/audiometria.php?codigo=".$codhistoria;
        
        $this->load->view('includes/historias/tpl_historias.php',$data);


   }

   function remision(){
        $codremision = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="formatos/mostrarpdf";

        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="";
        $data['url']=base_url()."pdf/remision.php?codigo=".$codremision;
        
        $this->load->view('includes/historias/tpl_historias.php',$data);


   }



   function consentimiento(){
        $codremision = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="formatos/mostrarpdf";

        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="";
        $data['url']=base_url()."pdf/consentimiento.php?codigo=".$codremision;
        
        $this->load->view('includes/historias/tpl_historias.php',$data);


   }



    function acceso_denegado(){

         $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['nombre_usuario'];
        $data['titulo']="Motos: ".$usuario;
        $data['contenido_principal']="access/prohibido";
        $this->load->view('includes/tpl_usuarios',$data);
    }

    function mostrar_certificado_otro_examen(){

        $codhistoria = $this->uri->segment(3) ;
        $codactividad = $this->uri->segment(4) ;
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="formatos/mostrarpdf";

        $data['ses']=$this->ses;
        $data['active']="historias";
        $data['active2']="";
        $data['url']=base_url()."pdf/otros_emanenes.php?codigo=".$codhistoria."&codactividad=".$codactividad;
        
        $this->load->view('includes/historias/tpl_historias.php',$data);


    }




    function facturacion(){


        $codfactura = $this->uri->segment(3) ;
        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="formatos/mostrarpdf";

        $data['ses']=$this->ses;
        $data['active']="reportes";
        $data['active2']="";
        $data['url']=base_url()."pdf/facturacion.php?codigo=".$codfactura;
        
        $this->load->view('includes/historias/tpl_historias.php',$data);


   }



    function facturacion_dialog(){


        $codfactura = $this->uri->segment(3) ;
      
        $data['url']=base_url()."pdf/facturacion.php?codigo=".$codfactura;
        $this->load->view('formatos/mostrarpdfdialog',$data);
        


   }



}


?>
