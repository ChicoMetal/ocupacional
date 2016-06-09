<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class audiometrias_model extends CI_Model{

  
  function count_audiometrias(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  audiometrias 
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
  
  function buscar_audiometrias_historia(){
     // var_dump($data);
  
        $sql="SELECT 
                r.nombre as nomaudiometria,
                d.codigo,
                d.nombre
              from 
                audiometrias  r,
                detallesdeaudiometrias d
                where 
                r.codigo=d.codaudiometria and
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

  function buscar_audiometrias_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                audiometrias 
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


  function buscar_audiometrias_detalles_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                detallesdeaudiometrias 
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



  function buscar_detalle_audiometrias_paginacion($codigo){

     $sql="SELECT 
                codigo,
                nombre, 
                estado
              FROM 
                detallesdeaudiometrias 
              where 
                codaudiometria='$codigo'";

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

 
  function buscar_nombre_audiometria($codigo){

     $sql="SELECT 
                
                nombre 
                
              FROM 
                audiometrias
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

   function buscar_audiometrias_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
     
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                estado
              FROM 
                audiometrias 
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


    function buscar_audiometrias_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
                
                estado
              FROM 
                audiometrias 
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


   function existeaudiometria($activiadad,$empresa){

    $sql="SELECT 
            det.codaudiometria
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codaudiometria='$activiadad' and 
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
                (codcontrato,codaudiometria,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_audiometria($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('audiometrias', $data); 
    }
  function actualizar_audiometria_detalle($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('detallesdeaudiometrias', $data); 
    }


    function guardar_audiometria($data){
        $query=$this->db->insert('audiometrias',$data);
    }
    function guardar_audiometria_detalle($data){
        $query=$this->db->insert('detallesdeaudiometrias',$data);
    }
    


   
}