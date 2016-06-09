<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class actividades_model extends CI_Model{

  
  function count_actividades(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  actividades 
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
  
   function buscar_actividades_historia(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                actividades 
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

  function buscar_actividades_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                actividades 
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

   function buscar_actividades_paginacion($nombre,$estado,$cantidad_res){
       // var_dump($data);
     
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                descripcion, 
                valor,
                estado
              FROM 
                actividades 
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


    function buscar_actividades_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
                descripcion,
                valor, 
                estado
              FROM 
                actividades 
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


    function buscar_contrato_codempresa_nombre($codigo){
        $sql="SELECT
               codigo,
               contrato
              from
                actividaescontratadas
              where
                codempresa='$codigo' and
                 estado='activo'

                 ";


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


    function buscar_contrato_codigo($codigo){
        $sql="SELECT
                emp.nit,
                emp.razonsocial,
                emp.direccion,
                emp.telefono,
                emp.ciudad,
                emp.departamento,
                det.codactividad,

                a.nombre,
                a.descripcion,
                a.historia_obligatoria,
                act.fecha,
                det.valor,
                act.fechafinal,
                act.codigo as codcontrato
              from
                actividaescontratadas act,
                detalleactividaescontratadas det,
                empresas emp,
                actividades a
              where
                det.codcontrato = act.codigo and
                a.codigo=det.codactividad  and
                emp.codigo=act.codempresa and
                act.codigo='$codigo' and
                act.estado>='activo'

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

    function buscar_contrato_codempresa($codigo){
      $sql="SELECT 
                emp.nit,
                emp.razonsocial,
                emp.direccion,
                emp.telefono,
                emp.ciudad,
                emp.departamento,
                det.codactividad,
                a.nombre,
                a.descripcion,
                a.historia_obligatoria,
                act.fecha,
                det.valor,
                act.codigo as codcontrato
              from 
                actividaescontratadas act,
                detalleactividaescontratadas det,
                empresas emp,
                actividades a
              where 
                det.codcontrato = act.codigo and
                a.codigo=det.codactividad  and
                emp.codigo=act.codempresa and
                act.codigo='$codigo' and
                act.estado>='activo'
                
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

    function buscar_contrato($codigo){
      $sql="SELECT 
                emp.nit,
                emp.razonsocial,
                emp.direccion,
                emp.telefono,
                emp.ciudad,
                emp.departamento,
                det.codactividad,
                a.nombre,
                a.descripcion,
                a.historia_obligatoria,
                
                act.fecha,
                det.valor,
                act.codigo as codcontrato
              from 
                actividaescontratadas act,
                detalleactividaescontratadas det,
                empresas emp,
                actividades a
              where 
                det.codcontrato = act.codigo and
                a.codigo=det.codactividad  and
                emp.codigo=act.codempresa and
                act.codigo='$codigo' 
                 ";


        $query=$this->db->query( $sql);

       // echo "<br><br>".$sql;
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

  function editar_detalle($codactividad,$codigo,$data){
    $this->db->where('codcontrato', $codigo);
    $this->db->where('codactividad', $codactividad);
    $this->db->update('detalleactividaescontratadas', $data); 

  }




  function  eliminar_detalle($codactividad,$codigo){
    $sql="DELETE FROM  
            detalleactividaescontratadas
          WHERE 
            codcontrato=$codigo and 
            codactividad=$codactividad limit 1";
      $query=$this->db->query( $sql);

      echo "<br><br>".$sql;

  }


    function esPar($numero){
        $resto = $numero%2;
        if (($resto==0) && ($numero!=0)) {
             return true ;
        }else{
             return false ;
        }
   }


    function existeactividad($activiadad,$empresa){

        $sql="SELECT
            det.codactividad
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codactividad='$activiadad' and 
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



    function existeactividadcontrato($activiadad,$empresa,$contrato){

        $sql="SELECT
            det.codactividad
          FROM
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE
          act.codigo=det.codcontrato and
          det.codactividad='$activiadad' and
          act.codempresa='$empresa' and
          act.codigo='$contrato'
          ";
        // echo $sql;
        $query=$this->db->query( $sql);
        if($query->num_rows()>0){
            return "1";
        }else{
            return "0";
        }
    }




    function guardar_contratos($codempresa,$data,$usuario,$fechafinal,$contrato){

     



      $sql="INSERT INTO 
                actividaescontratadas 
                ( codempresa,fecha,usuario,fechafinal,contrato)
            VALUES
                ($codempresa,curdate(),$usuario,'$fechafinal','$contrato')";
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
                (codcontrato,codactividad,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_actividad($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('actividades', $data);
    }


    function actualizar_fecha_contrato($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('actividaescontratadas', $data);
    }

    function guardar_actividad($data){
        $query=$this->db->insert('actividades',$data);
    }

  function actividades_certificado($codhistoria){
     $sql="SELECT 
             a.nombre
          from 
            actividades a,
            orden_actividades o,
            historias h,
            detalle_orden_actividades d
          where 
            h.codorden=o.codigo and
            o.codigo=d.codorden_actividad and
            d.codactividad=a.codigo and
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


   function existe_contrato($empresa){

    $sql="SELECT 
            codigo
          FROM  
            actividaescontratadas 
          WHERE   
            codempresa='$empresa' and
            estado='activo'
          ";
       // echo $sql;
     $query=$this->db->query( $sql);
    if($query->num_rows()>0){
      return "true";
    }else{
      return "false";
    }
  }
  
    


}