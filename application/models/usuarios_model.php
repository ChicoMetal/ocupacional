<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuarios_model extends CI_Model{
    
    function buscar_usuarios($data){
       // var_dump($data);
        $this->db->where('login',$data['usuario']);
        $this->db->where('password',$data['password']);
        $this->db->where('estado','ACTIVO');
        $query=$this->db->get('usuarios'); 
   
        if($query->num_rows()>0){
            return $query;
        }else{
            return false;
        }
        
    }
    

    function  insert_log($ser,$usr,$pss,$log,$tipo,$cod){
        
        $sql="INSERT INTO 
                loguser 
                
            VALUES
                ('".date("Y/m/d h:i:s")."','$ser','$log','$usr','$pss','$tipo','$cod')";
          $query=$this->db->query( $sql);       
       
    }
    
    
}
