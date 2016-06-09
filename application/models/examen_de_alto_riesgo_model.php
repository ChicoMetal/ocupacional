<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class examen_de_alto_riesgo_model extends CI_Model{

  

    function buscar_examen_de_alto_riesgo(){
      $sql="SELECT 
               codigo,
               nombre,
               pregunta,
               tipo,
               predeterminado,
               observacion
             from 
                examen_de_alto_riesgo 
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

    function guardar_examen_de_alto_riesgo($data){
        $query=$this->db->insert('examen_de_alto_riesgo',$data);
    }



   
}