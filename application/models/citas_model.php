<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class citas_model extends CI_Model{

  
    function insertar_cita($data){
        $query=$this->db->insert('consultas',$data);
    }


  function buscar_citas($codigo){
    // var_dump($data);

        $sql="SELECT 
                p.pac_codigo,
                p.pac_tipo_de_identificacion, 
                p.pac_identificacion, 
                p.pac_apellido1, 
                p.pac_apellido2,
                p.pac_nombre1,
                p.pac_nombre2,
                p.pac_sexo,
                c.con_fecha
              from 
                pacientes p,
                consultas c

                where 
                p.pac_codigo=c.con_paciente and
                c.con_medico='$codigo' "          ;
        $query=$this->db->query( $sql);

        ///echo "<br><br>".$sql;
        if($query->num_rows() > 0){
            $i=1;
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        }
  }


   
}