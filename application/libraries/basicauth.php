<?php

class Basicauth{
    
    function __construct() {
       $this->CI= & get_instance();
    }
    
    function login($login,$password){
        $data= array();
       
        $sql="SELECT * FROM usuarios WHERE  login ='".$login."' and password='$password' AND estado='ACTIVO'  ";

        $query = $this->CI->db->query($sql);
        
        if($query->num_rows()>0){
            $this->CI->session->sess_destroy();
            $this->CI->session->sess_create();
    
           $this->CI->session->set_userdata(array(
                                        'logued'            =>true,
                                        'codigo'         =>$query->row()->codigo,
                                        'nombres'         =>$query->row()->nombres,
                                        'permisos'       =>$query->row()->permisos,
                                        'identificacion' =>$query->row()->identificacion,
                                        'avatar'         =>$query->row()->avatar

                                        )
                                            );
        }else{
            $data['error']="Usuario o contraseña incorrecto";
        }
        return $data;
        
       
    }
    
    function logout(){
         $this->CI->session->sess_destroid();
    
    }
    
    function buscar_nombre($tabla,$numedeiden){
        
        $query = $this->CI->db->query("select nombre,apellido from $tabla where numedeiden ='".$numedeiden."' limit 1");
        $reusul="Error";
         if($query->num_rows()>0){
             $reusul= $query->row()->nombre." ".$query->row()->apellido;
         }
       
         return $reusul;
    }
    
}
?>
