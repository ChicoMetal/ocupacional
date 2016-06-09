<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riesgos_model extends CI_Model{

  
  function count_riesgos(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  riesgos 
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
  
  function buscar_riesgos_historia(){
     // var_dump($data);
  
        $sql="SELECT 
                r.nombre as nomriesgo,
                d.codigo,
                d.nombre
              from 
                riesgos  r,
                detallesderiesgos d
                where 
                r.codigo=d.codriesgo and
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

  function buscar_riesgos_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                riesgos 
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


  function buscar_riesgos_detalles_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                detallesderiesgos 
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



  function buscar_detalle_riesgos_paginacion($codigo){

     $sql="SELECT 
                codigo,
                nombre, 
                estado
              FROM 
                detallesderiesgos 
              where 
                codriesgo='$codigo'";

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

 
  function buscar_nombre_riesgo($codigo){

     $sql="SELECT 
                
                nombre 
                
              FROM 
                riesgos
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

   function buscar_riesgos_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
     
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                estado
              FROM 
                riesgos 
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


    function buscar_riesgos_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
                
                estado
              FROM 
                riesgos 
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


   function existeriesgo($activiadad,$empresa){

    $sql="SELECT 
            det.codriesgo
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codriesgo='$activiadad' and 
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
                (codcontrato,codriesgo,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_riesgo($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('riesgos', $data); 
    }
  function actualizar_riesgo_detalle($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('detallesderiesgos', $data); 
    }


    function guardar_riesgo($data){
        $query=$this->db->insert('riesgos',$data);
    }
    function guardar_riesgo_detalle($data){
        $query=$this->db->insert('detallesderiesgos',$data);
    }
    
    function buscar_riesgos_historia_edit($codhistoria){

        $sql="SELECT 
                r.nombre as nomriesgo,
                d.codigo,
                d.nombre
              from 
                riesgos  r,
                detallesderiesgos d
                where 
                r.codigo=d.codriesgo and
                r.estado='activo' and 
                d.estado='activo'  and 
                d.codigo not in(  
                      select  
                        codfactor 
                      from 
                        historias_factores_deriesgo 
                      where 
                        codhistoria='$codhistoria')";
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