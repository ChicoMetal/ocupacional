<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class antecedentes_model extends CI_Model{

  
  function count_antecedentes(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  antecedentes 
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
  
   function buscar_antecedentes_historia(){

        $sql="SELECT 
                codigo,
                nombre,
                tipo
              from 
                antecedentes 
                where estado='activo' order by tipo ";
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

  function buscar_antecedentes_edit($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                *
              from 
                antecedentes 
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

   function buscar_antecedentes_paginacion($nombre,$tipo,$estado,$cantidad_res){
       // var_dump($data);
      if($tipo!=""){
        $tipo="and tipo='$tipo'";  
      }
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nombre, 
                tipo, 
                estado
              FROM 
                antecedentes 
              where 
                $estado
                nombre like '%$nombre%'  
                $tipo

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


    function buscar_antecedentes_select(){
      // var_dump($data);

        $sql="SELECT 
                codigo,
                nombre, 
                tipo, 
                estado
              FROM 
                antecedentes 
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


   function existeantecedente($activiadad,$empresa){

    $sql="SELECT 
            det.codantecedente
          FROM  
            actividaescontratadas act,
            detalleactividaescontratadas det
          WHERE   
          act.codigo=det.codcontrato and
          det.codantecedente='$activiadad' and 
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
                (codcontrato,codantecedente,valor,modificado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizar_antecedente($data,$codigo){

        $this->db->where('codigo', $codigo);
        return $this->db->update('antecedentes', $data); 
    }

    function guardar_antecedente($data){
        $query=$this->db->insert('antecedentes',$data);
    }

    function buscar_antecedentes_historia_edit($codhistoria){

        $sql="SELECT 
                a.codigo,
                a.nombre,
                ha.observacion,
                a.tipo
              from 
                antecedentes a,
                historias h,
                historias_antecedentes_personales ha 
              where 
                ha.codhistoria=h.codigo and
                ha.codantecedentes=a.codigo and 
                ha.codhistoria='$codhistoria' ";
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