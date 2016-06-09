<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class empresas_model extends CI_Model{

  
  function count_empresas(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  empresas 
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
  
  function buscar_empresas_select($value){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('select codigo, nit, razonsocial as nombre, telefono, direccion from empresas where razonsocial like "%'.$value.'%" limit 50');


        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data[]=$row;
            }

            return $data;
        }else{
            return false;
        }

    }

     function buscar_empresa($codigo){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT * from empresas where codigo="'.$codigo.'"');


        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data[]=$row;
            }

            return $data;
        }else{
            return false;
        }

    }
    
  function buscar_pacientes_codigo($codigo){
    // var_dump($data);

        $sql="SELECT 
                pac_codigo,
                pac_tipo_de_identificacion, 
                pac_identificacion, 
                pac_apellido1, 
                pac_apellido2,
                pac_nombre1,
                pac_nombre2,
                pac_sexo
              from 
                pacientes 
                where pac_codigo='$codigo' ";
        $query=$this->db->query( $sql);

        ///echo "<br><br>".$sql;
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
   function buscar_empresas($desde,$hasta){
       // var_dump($data);

        $sql="SELECT 
                codigo,
                nit, 
                razonsocial, 
                direccion, 
                telefono
              FROM 
                empresas 
                LIMIT $desde,$hasta ";
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




    function buscar_Clientes_edit($value){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('select * from Clientes where nombre like "%'.$value.'%" limit 100');


        if($query->num_rows() > 0){
            $i=1;
           foreach ($query->result_array() as $row){
               $data[]=array(
                   'tipodeinden'   =>$row['tipodeinden'],
                   'expedida'     =>$row['expedida'],
                   'email'        =>$row['email'],
                   'ciudad'       =>$row['ciudad'],
                   'departamento' =>$row['departamento'],
                   'nombre'       =>$row['nombre'],
                   'direccion'    =>$row['direccion'],
                   'numedeiden'   =>$row['numedeiden'],
                   'telefono'     =>$row['telefono'],
                   'estado'       =>$row['estado'],
                   'odd'          =>$this->esPar($i)

               );
               $i++;
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


   function existeEmpresa($empresa){


		 $sql="SELECT 
                
                nit 
               
              FROM 
              empresas
                where nit='$empresa'
               ";
        $query=$this->db->query( $sql);

		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}

    function guardar_empresa($data){
        var_dump($data);
        $query=$this->db->insert('empresas',$data);
    }

    function actualizar_empresa($data,$codigo){

        $this->db->where("codigo",$codigo);
        $query=$this->db->update('empresas',$data);
    }


    function existe_empresa_actualizar($codigo,$nit){

      $sql="SELECT 
              codigo, nit 
            from 
              empresas 
            where 
              nit='$nit' ";
      
      $query=$this->db->query($sql);
      //echo $sql;
      if($query->num_rows()>0){
        foreach ($query->result_array() as $row){
          if($row['codigo']==$codigo){
            return true;
          }else{
            return false;
          }
        }
      }else{
        return true;
      }

    }

   function buscar_empresas_paginacion($nombre,$ciudad_search,$estado,$cantidad_res){
       // var_dump($data);
      if($ciudad_search!=""){
        $ciudad_search="and nit='$ciudad_search'";  
      }
      if($estado!=""){
        $estado="estado='$estado' and";  
      }  

        $sql="SELECT 
                codigo,
                nit, 
                razonsocial, 
                direccion, 
                telefono,
                estado
              FROM 
                empresas 
              where 
                $estado
                razonsocial like '%$nombre%'  
                $ciudad_search

                LIMIT $cantidad_res  ";
        $query=$this->db->query( $sql);
       // echo  $sql;
        
        if($query->num_rows() > 0){
           
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        }

    }


    function empresa_certificado($codigo){
       $sql="SELECT 
             codigo,
             nit,
             razonsocial
          from 
            empresas
          where 
            codigo='$codigo' ";
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