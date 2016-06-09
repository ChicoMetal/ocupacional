<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class examen_fisico_model extends CI_Model{

  
  function count_examen_fisico(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  examen_fisico 
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
  
   function buscar_examen_fisico_historia(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                examen_fisico 
                where estado='activo' ";
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

  
   function buscar_examen_fisico(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                examen_fisico 
                where estado='activo' ";
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

  function buscar_examen_fisico_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                examen_fisico 
                where codigo='$codigo' limit 1 ";
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

   function buscar_examen_fisico_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
      
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                 estado
              FROM 
                examen_fisico 
              where 
                $estado
                nombre like '%$nombre%'  
               

                LIMIT $cantidad_res  ";
        $query=$this->db->query( $sql);
        //echo  $sql;
        
        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        }

    }


    function buscar_examen_fisico_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
               
                estado
              FROM 
                examen_fisico 
                where estado='activo' ";
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


   function existeexamen_fisico($activiadad,$empresa){

    $sql="SELECT 
            det.codexamen_fisico
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codexamen_fisico='$activiadad' and 
          act.codempresa='$empresa'
          ";
       // echo $sql;
     $query=$this->db->query( $sql);
    if($query->num_rows()>0){
      return "1";
    }else{
      return "0";
    }
  }

    function guardar_contratos($codempresa,$data,$usuario){

     



      $sql="INSERT INTO 
                actividaescontratadas 
                ( codempresa,fecha,usuario)
            VALUES
                ($codempresa,curdate(),$usuario)";
          $query=$this->db->query( $sql);       
          $codigo=$this->db->insert_id();


          
          $data=str_replace("{codigoempresa}",$codigo,$data);
          $res=$this->guardar_contratos_detalle($data);
          
          if($res==0){
            return 0;
          }else{
            return $codigo;
          }
     
         
       
    }

    function guardar_contratos_detalle($data){

      $sql="INSERT INTO 
                detalleactividaescontratadas 
                (codcontrato,codexamen_fisico,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_examen_fisico($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('examen_fisico', $data); 
    }

    function guardar_examen_fisico($data){
        $query=$this->db->insert('examen_fisico',$data);
    }

    function buscar_examenes_historia_edit($codhistoria){

        $sql="SELECT 
                a.codigo,
                a.nombre,
                ha.observacion
              from 
                examen_fisico a,
                historias h,
                historias_examen_fisico ha 
              where 
                ha.codhistoria=h.codigo and
                ha.codexamen=a.codigo and 
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
   


    function actualizar_examen_fisico_historia($codhistoria,$data){

        $this->db->where('codhistoria', $codhistoria);
        return $this->db->update('historias_examen_fisico', $data); 
    }


}