<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class proveedores_model extends CI_Model{

  
  function count_proveedores(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  proveedores 
                                  ');


        if($query->num_rows() > 0){
            
           foreach ($query->result_array() as $row){
               $data=$row['cantidad'];
           }

            return $data;
        }else{
            return "0";
        }

    }
  
  function buscar_proveedores_select($value){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('select codigo, nombre, telefono, direccion from proveedores where nombre like "%'.$value.'%" limit 50');


        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data[]=$row;
            }

            return $data;
        }else{
            return false;
        }

    }

     function buscar_proveedor($codigo){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT * from proveedores where codigo="'.$codigo.'"');


        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data[]=$row;
            }

            return $data;
        }else{
            return false;
        }

    }
    
  function buscar_pacientes_codigo($codigo){
    // var_dump($data);

        $sql="SELECT 
                pac_codigo,
                pac_tipo_de_identificacion, 
                pac_identificacion, 
                pac_apellido1, 
                pac_apellido2,
                pac_nombre1,
                pac_nombre2,
                pac_sexo
              from 
                pacientes 
                where pac_codigo='$codigo' ";
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
   function buscar_proveedores($desde,$hasta){
       // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
                direccion, 
                telefono
              FROM 
                proveedores 
                LIMIT $desde,$hasta ";
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




    function esPar($numero){
        $resto = $numero%2;
        if (($resto==0) && ($numero!=0)) {
             return true ;
        }else{
             return false ;
        }
   }


    function guardar_proveedor($data){
        var_dump($data);
        $query=$this->db->insert('proveedores',$data);
    }

    function actualizar_proveedor($data,$codigo){

        $this->db->where("codigo",$codigo);
        $query=$this->db->update('proveedores',$data);
    }


   function buscar_proveedores_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
      
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                
                nombre, 
                direccion, 
                telefono,
                celular,
                contacto,
                estado
              FROM 
                proveedores 
              where 
                $estado
                nombre like '%$nombre%'  
              

                LIMIT $cantidad_res  ";
        $query=$this->db->query( $sql);
       // echo  $sql;
        
        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        }

    }


    function proveedor_certificado($codigo){
       $sql="SELECT 
             codigo,
             nombre,
             direccion
          from 
            proveedores
          where 
            codigo='$codigo' ";
   // echo $sql;
    $query=$this->db->query($sql);
    
      if($query->num_rows()>0){

        foreach ($query->result_array() as $row){

          $data[]=$row;
        }

      }else{
        return false;
      }
      return  $data;

    }



    function guardar_remision($fecha,$codproveedor,$codpaciente,$data){

      $sql="INSERT INTO 
                remisiones 
                ( fecha,codproveedor,codpaciente)
            VALUES
                ('$fecha','$codproveedor','$codpaciente')";
          $query=$this->db->query( $sql);       
          $codigo=$this->db->insert_id();


          
          $data=str_replace("{codigorden}",$codigo,$data);
          $res=$this->guardar_remision_detalle($data);
          
          if($res==0){
            return 0;
          }else{
            return $codigo;
          }
     
         
       
    }

    function guardar_remision_detalle($data){

      $sql="INSERT INTO 
                remisiones_detalles 
                (codremision,codactividad)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }


    function buscar_remision_codigo($codigo){
      $sql="SELECT 
                det.codactividad,
                a.nombre,
                a.descripcion,
                o.fecha,
                o.codigo as codremision
                
              from 
                remisiones o,
                remisiones_detalles det,
                actividades a
              where 
                o.codigo=det.codremision and 
                det.codactividad=a.codigo and
                o.codigo='$codigo' 
                 ";


        $query=$this->db->query( $sql);

        //echo "<br><br>".$sql;
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