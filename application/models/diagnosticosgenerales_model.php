<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diagnosticosgenerales_model extends CI_Model{

  
  function count_diagnosticosgenerales(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  diagnosticosgenerales 
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
  
  function buscar_diagnosticosgenerales_historia(){
     // var_dump($data);
  
        $sql="SELECT 
                r.nombre as nomdiagnosticosgenerales,
                d.codigo,
                d.nombre
              from 
                diagnosticosgenerales  r,
                actividades_preguntas d
                where 
                r.codigo=d.coddiagnosticosgenerales and
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

  function buscar_diagnosticosgenerales_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                diagnosticosgenerales 
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


  function buscar_diagnosticosgenerales_detalles_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                actividades_preguntas 
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



  function buscar_detalle_diagnosticosgenerales_paginacion($codigo){

     $sql="SELECT 
                codigo,
                pregunta, 
                tipo,
                campos,
                valorpordefecto,
                observacion,
                estado
              FROM 
                actividades_preguntas 
              where 
                codnombreformulario='$codigo'";

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

 
  function buscar_nombre_actividades_nomformulario($codigo){

     $sql="SELECT 
                
                nombre 
                
              FROM 
                diagnosticosgenerales
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

   function buscar_diagnosticosgenerales_paginacion($nombre,$estado,$cantidad_res,$actividad){
       // var_dump($data);
      $actividad="";
      if($estado!=""){
        $estado="estado='$estado' and";  
      } 

      if($actividad!=""){
        $actividad=" and codactdelaempresa='$actividad' ";  
      }else{
        //return;
      }


        $sql="SELECT 
                codigo,
                nombre, 
                estado
              FROM 
                diagnosticosgenerales 
              where 
                $estado
                nombre like '%$nombre%'  
                $actividad
                

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


    function buscar_diagnosticosgenerales_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
                
                estado
              FROM 
                diagnosticosgenerales 
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


   function existeactividades_nomformulario($activiadad,$empresa){

    $sql="SELECT 
            det.coddiagnosticosgenerales
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.coddiagnosticosgenerales='$activiadad' and 
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
                (codcontrato,coddiagnosticosgenerales,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_actividades_nomformulario($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('diagnosticosgenerales', $data); 
    }
  function actualizar_diagnosticosgenerales_detalle($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('actividades_preguntas', $data); 
    }


    function guardar_actividades_nomformulario($data){
        $query=$this->db->insert('diagnosticosgenerales',$data);
    }
    function guardar_actividades_nomformulario_detalle($data){
        $query=$this->db->insert('actividades_preguntas',$data);
    }
    
    function recomendaciones_certificado($codhistoria){
      
    }



    function buscar_actividadesdelaempresa(){
      $sql="SELECT 
              a.codigo,
              a.nombre
          from 
            
            actividades a
          where 
            a.estado='activo' ";
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