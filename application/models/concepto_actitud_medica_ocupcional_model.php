<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class concepto_actitud_medica_ocupcional_model extends CI_Model{

  
  function count_concepto_actitud_medica_ocupcional(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  concepto_actitud_medica_ocupcional 
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
  
   function buscar_concepto_actitud_medica_ocupcional_historia(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                concepto_actitud_medica_ocupcional 
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

  function buscar_concepto_actitud_medica_ocupcional_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                concepto_actitud_medica_ocupcional 
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

   function buscar_concepto_actitud_medica_ocupcional_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
      
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                 estado
              FROM 
                concepto_actitud_medica_ocupcional 
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


    function buscar_concepto_actitud_medica_ocupcional_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
               
                estado
              FROM 
                concepto_actitud_medica_ocupcional 
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


   function existeexamenes_realizado($activiadad,$empresa){

    $sql="SELECT 
            det.codexamenes_realizado
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codexamenes_realizado='$activiadad' and 
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
                (codcontrato,codexamenes_realizado,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_concepto_actitud_medica_ocupcional($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('concepto_actitud_medica_ocupcional', $data); 
    }

    function guardar_concepto_actitud_medica_ocupcional($data){
        $query=$this->db->insert('concepto_actitud_medica_ocupcional',$data);
    }

    function concepto_certificado($codhistoria){
        $sql="SELECT 
             c.nombre
          from 
            concepto_actitud_medica_ocupcional c,
            historias h,
            historias_concepto_actitud_medica_ocupcional hc
          where 
            hc.codhistoria=h.codigo and
            hc.codconcepto=c.codigo and
            h.codigo='$codhistoria' ";
    //echo $sql;
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