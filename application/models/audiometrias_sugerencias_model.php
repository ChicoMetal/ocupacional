<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class audiometrias_sugerencias_model extends CI_Model{

  
  function count_audiometrias_sugerencias(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  audiometrias_sugerencias 
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
  
   function buscar_audiometrias_sugerencias_historia(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                audiometrias_sugerencias 
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

  function buscar_audiometrias_sugerencias_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                audiometrias_sugerencias 
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

   function buscar_audiometrias_sugerencias_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
      
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                 estado
              FROM 
                audiometrias_sugerencias 
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


    function buscar_audiometrias_sugerencias_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
               
                estado
              FROM 
                audiometrias_sugerencias 
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


   function existeaudiometrias_sugerencias($activiadad,$empresa){

    $sql="SELECT 
            det.codaudiometrias_sugerencias
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codaudiometrias_sugerencias='$activiadad' and 
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
                (codcontrato,codaudiometrias_sugerencias,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_audiometrias_sugerencias($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('audiometrias_sugerencias', $data); 
    }

    function guardar_audiometrias_sugerencias($data){
        $query=$this->db->insert('audiometrias_sugerencias',$data);
    }

    function buscar_sugerencias_edit($codigo){

        $sql="SELECT 
                *
              from 
                audiometrias_sugerencias 
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
   


    function actualizar_audiometrias_sugerencias_historia($codhistoria,$data){

        $this->db->where('codhistoria', $codhistoria);
        return $this->db->update('historias_audiometrias_sugerencias', $data); 
    }

    function sugerencia_certificado($codhistoria){
         $sql="SELECT 
              t.nombre 
          from 
            historias_audiometrias_sugerencias te,
            audiometrias_sugerencias t
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