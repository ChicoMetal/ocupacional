<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class revision_por_sistema_model extends CI_Model{

  

    function buscar_revision_por_sistema(){
      $sql="SELECT 
               codigo,nombre

              from 
                
                revision_por_sistema 
              where 
                estado ='activo'";


        $query=$this->db->query( $sql);

       
        if($query->num_rows() > 0){
         
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        }

    }

    function guardar_revision_por_sistema($data){
        $query=$this->db->insert('revision_por_sistema',$data);
    }



   
}