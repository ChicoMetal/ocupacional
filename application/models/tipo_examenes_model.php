<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tipo_examenes_model extends CI_Model{

  
  function count_tipo_examenes(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  tipo_examenes 
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
  
   function buscar_tipo_examenes_historia(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                tipo_examenes 
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

  function buscar_tipo_examenes_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                tipo_examenes 
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

   function buscar_tipo_examenes_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
      
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                 estado
              FROM 
                tipo_examenes 
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


    function buscar_tipo_examenes_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
               
                estado
              FROM 
                tipo_examenes 
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


   function existetipo_examenes($activiadad,$empresa){

    $sql="SELECT 
            det.codtipo_examenes
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codtipo_examenes='$activiadad' and 
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
                (codcontrato,codtipo_examenes,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_tipo_examenes($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('tipo_examenes', $data); 
    }

    function guardar_tipo_examenes($data){
        $query=$this->db->insert('tipo_examenes',$data);
    }

    function buscar_tipos_edit($codigo){

        $sql="SELECT 
                *
              from 
                tipo_examenes 
                where codigo<>'$codigo' ";
        $query=$this->db->query( $sql);

        //echo "<br><br>".$sql;
        if($query->num_rows() > 0){
         
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        }

    }
   


    function actualizar_tipo_examenes_historia($codhistoria,$data){

        $this->db->where('codhistoria', $codhistoria);
        return $this->db->update('historias_tipo_examenes', $data); 
    }

    function tipo_certificado($codhistoria){
         $sql="SELECT 
              t.nombre 
          from 
            historias_tipo_examenes te,
            tipo_examenes t
          where 
            t.codigo=te.codexamen and
            te.codhistoria='$codhistoria' ";
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


}