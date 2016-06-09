<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class recomendaciones_laborales_model extends CI_Model{

  
  function count_recomendaciones_laborales(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  recomendaciones_laborales 
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
  
  function buscar_recomendaciones_laborales_historia(){
     // var_dump($data);
  
        $sql="SELECT 
                r.nombre as nomrecomendaciones_laborales,
                d.codigo,
                d.nombre
              from 
                recomendaciones_laborales  r,
                detallesderecomendaciones_laborales d
                where 
                r.codigo=d.codrecomendaciones_laborales and
                r.estado='activo' and 
                d.estado='activo' ";
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

  function buscar_recomendaciones_laborales_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                recomendaciones_laborales 
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


  function buscar_recomendaciones_laborales_detalles_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                detallesderecomendaciones_laborales 
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



  function buscar_detalle_recomendaciones_laborales_paginacion($codigo){

     $sql="SELECT 
                codigo,
                nombre, 
                estado
              FROM 
                detallesderecomendaciones_laborales 
              where 
                codrecomendaciones_laborales='$codigo'";

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

 
  function buscar_nombre_recomendaciones_laborale($codigo){

     $sql="SELECT 
                
                nombre 
                
              FROM 
                recomendaciones_laborales
              where 
                codigo='$codigo' limit 1";

        $query=$this->db->query( $sql);
        //echo  $sql;
 
        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data=$row['nombre'];
           }

            return $data;
        }else{
            return false;
        }

  }

   function buscar_recomendaciones_laborales_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
     
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                estado
              FROM 
                recomendaciones_laborales 
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


    function buscar_recomendaciones_laborales_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
                
                estado
              FROM 
                recomendaciones_laborales 
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


   function existerecomendaciones_laborale($activiadad,$empresa){

    $sql="SELECT 
            det.codrecomendaciones_laborales
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codrecomendaciones_laborales='$activiadad' and 
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
                (codcontrato,codrecomendaciones_laborales,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_recomendaciones_laborale($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('recomendaciones_laborales', $data); 
    }
  function actualizar_recomendaciones_laborale_detalle($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('detallesderecomendaciones_laborales', $data); 
    }


    function guardar_recomendaciones_laborale($data){
        $query=$this->db->insert('recomendaciones_laborales',$data);
    }
    function guardar_recomendaciones_laborale_detalle($data){
        $query=$this->db->insert('detallesderecomendaciones_laborales',$data);
    }
    
    function recomendaciones_certificado($codhistoria){
      
    }

   
}