<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class actividades_nomformularios_model extends CI_Model{

  
  function count_actividades_nomformularios(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  actividades_nomformularios 
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
  
   function buscar_actividades_nomformularios_historia(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                actividades_nomformularios 
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

  function buscar_actividades_nomformularios_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                actividades_nomformularios 
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

   function buscar_actividades_nomformularios_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
      
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                 estado
              FROM 
                actividades_nomformularios 
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


    function buscar_actividades_nomformularios_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
               
                estado
              FROM 
                actividades_nomformularios 
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


   function existeactividades_nomformularios($activiadad,$empresa){

    $sql="SELECT 
            det.codactividades_nomformularios
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codactividades_nomformularios='$activiadad' and 
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
                (codcontrato,codactividades_nomformularios,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_actividades_nomformularios($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('actividades_nomformularios', $data); 
    }

    function guardar_actividades_nomformularios($data){
        $query=$this->db->insert('actividades_nomformularios',$data);
    }

    function buscar_sugerencias_edit($codigo){

        $sql="SELECT 
                *
              from 
                actividades_nomformularios 
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
   


    function actualizar_actividades_nomformularios_historia($codhistoria,$data){

        $this->db->where('codhistoria', $codhistoria);
        return $this->db->update('historias_actividades_nomformularios', $data); 
    }

    function sugerencia_certificado($codhistoria){
         $sql="SELECT 
              t.nombre 
          from 
            historias_actividades_nomformularios te,
            actividades_nomformularios t
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

    function buscar_actividadesdelaempresa(){
      $sql="SELECT 
              ade.codigo,
              a.nombre
          from 
            actividadesdelaempresa ade,
            actividades a
          where 
            ade.codactividad=a.codigo ";
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