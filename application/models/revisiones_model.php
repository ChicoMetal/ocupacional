<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class revisiones_model extends CI_Model{

  function buscar_revisiones_historia_edit($codhistoria){

        $sql="SELECT 
                a.codigo,
                a.nombre,
                ha.observacion
              from 
                revision_por_sistema a,
                historias h,
                historias_revision_por_sistema ha 
              where 
                ha.codhistoria=h.codigo and
                ha.codrevision=a.codigo and 
                ha.codhistoria='$codhistoria' ";
        $query=$this->db->query( $sql);

        ///echo "<br><br>".$sql;
        if($query->num_rows() > 0){
         
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        } 
  }
   
}