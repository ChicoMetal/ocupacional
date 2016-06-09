<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diagnosticos_model extends CI_Model{

  
  function count_diagnosticos(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  diagnosticos 
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
  
   function buscar_diagnosticos_historia(){

        $sql="SELECT 
                codigo,
                nombre
              from 
                diagnosticos 
                where estado='activo' and 
                codactividad='58' ";
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

  function buscar_diagnosticos_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                diagnosticos 
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

   function buscar_diagnosticos_paginacion($nombre,$estado,$cantidad_res,$codactividad){
       // var_dump($data);
      
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                 estado
              FROM 
                diagnosticos 
              where 
                $estado
                nombre like '%$nombre%'  and
                codactividad='$codactividad'

               

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


    function buscar_diagnosticos_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
               
                estado
              FROM 
                diagnosticos 
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


   function existediagnosticos($activiadad,$empresa){

    $sql="SELECT 
            det.coddiagnosticos
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.coddiagnosticos='$activiadad' and 
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
                (codcontrato,coddiagnosticos,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_diagnosticos($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('diagnosticos', $data); 
    }

    function guardar_diagnosticos($data){
        $query=$this->db->insert('diagnosticos',$data);
    }

    function buscar_tipos_edit($codigo){

        $sql="SELECT 
                *
              from 
                diagnosticos 
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
   


    function actualizar_diagnosticos_historia($codhistoria,$data){

        $this->db->where('codhistoria', $codhistoria);
        return $this->db->update('historias_diagnosticos', $data); 
    }

    function tipo_certificado($codhistoria){
         $sql="SELECT 
              t.nombre 
          from 
            historias_diagnosticos te,
            diagnosticos t
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

    function buscar_diagnosticos_historia_edit($codhistorias,$codactividad=58){

        $sql="SELECT 
                nombre,
                codigo_internacional,
                codigo
              from 
                diagnosticos
                where 
               
                estado='activo' and 
                codactividad='$codactividad' and
                codigo not in(  
                      select  
                        coddiagnostico 
                      from 
                        historias_diagnosticos 
                      where 
                        codhistoria='$codhistorias')";
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



    function buscar_diagnosticos_historia_otros_edit($codhistorias,$codactividad){

        $sql="SELECT 
                nombre,
                codigo_internacional,
                codigo
              from 
                diagnosticos
                where 
               
                estado='activo' and 
                codactividad='$codactividad' and
                codigo not in(  
                      select  
                        coddiagnostico 
                      from 
                        historias_otros_disgnosticos 
                      where 
                        codhistoria='$codhistorias')";
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



    function buscar_diagnosticos_historia_edit_otros($codhistorias,$codactividad){

        if($codactividad=="todas"){
          $codactividad=" codactividad<>58 and";
        }else{
          $codactividad=" codactividad=58 and";
        }

        $sql="SELECT 
                nombre,
                codigo_internacional,
                codigo
              from 
                diagnosticos
                where 
               
                estado='activo' and 
                $codactividad
                codigo not in(  
                      select  
                        coddiagnostico 
                      from 
                        historias_diagnosticos 
                      where 
                        codhistoria='$codhistorias')";
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