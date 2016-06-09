<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pacientes_model extends CI_Model{

  
  function count_pacientes(){
       // var_dump($data);
        $data=  array();
        $query=$this->db->query('SELECT 
                                  COUNT(*) as cantidad
                                from 
                                  pacientes 
                                  ');


        if($query->num_rows() > 0){
            $i=1;
           foreach ($query->result_array() as $row){
               $data=$row['cantidad'];
           }

            return $data;
        }else{
            return "0";
        }

    }
  
  function buscar_paciente_codorden($codigo){
    // var_dump($data);
  


        $sql="SELECT 
                p.codigo,
                p.identificacion,
                p.nombres,
                p.apellidos,
                p.sexo,
                p.fechanacimiento,
                p.direccion,
                p.telefono,
                p.celular,
                p.estadocivil,
                p.numhijos,
                p.escolaridad,
                p.escolaridad_completa,
                p.eps,
                p.afp,
                p.arp,
                p.fechaingreso,
                p.observaciones,
                p.email,
                e.razonsocial,
                o.fecha as ord_fecha
              from 
                pacientes p,
                orden_actividades o,
                actividaescontratadas ac,
                empresas e
              where 
                p.codigo=o.codpaciente and
                o.codcontrato=ac.codigo and
                ac.codempresa=e.codigo and 
                o.codigo='$codigo' ";
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



  function buscar_paciente($identificacion){
    // var_dump($data);
       $sql="SELECT 
                *
              from 
                pacientes 
              where 
                identificacion='$identificacion' ";
        $query=$this->db->query( $sql);

        ///echo "<br><br>".$sql;
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
               $data[]=$row;
               $data[0]['ord_pen']=$this->tiene_ordenpendiente($row['codigo']);
           }

            return $data;
        }else{
            return "no data";
        }
  }

  function tiene_ordenpendiente($codigo){
    // var_dump($data);
       $sql="SELECT 
                *
              from 
                pacientes p,
                orden_actividades o
              where 
                o.codpaciente=p.codigo and
                p.codigo='$codigo' and
                (o.estado<>'finalizada' and o.estado<>'cancelada'  )

                ";
        $query=$this->db->query( $sql);

      //echo "<br><br>".$sql;
        if($query->num_rows() > 0){
           return true;
        }else{
            return false;
        }

  }

   function buscar_pacientes_imprimir($value){
       // var_dump($data);

       $sql="SELECT 
                codigo,
                identificacion, 
                nombres, 
                apellidos, 
                sexo,
                fechanacimiento,
                direccion,
                telefono,
                celular
              from 
                pacientes 
                where codigo='$value' ";
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

  function buscar_pacientes_select($valor,$criterio){
     // var_dump($data);
      $busqueda="";
      if($criterio=="nombres" || $criterio=="apellidos" ){
        $busqueda="$criterio like '%$valor%'";
      }else{
        $busqueda="$criterio = '$valor'";

      }


        $sql="SELECT 
                codigo,
                nombres, 
                identificacion, 
                apellidos
              from 
                pacientes 
              where
                $busqueda  
              order by  $criterio
              ";
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


   function existePaciente($usuario){

    $sql="SELECT identificacion from pacientes where identificacion='$usuario' ";
    
    $query=$this->db->query($sql);
   
    if($query->num_rows()>0){
      return true;
    }else{
      return false;
    }
  }

   function existePaciente_actualizar($codigo,$identificacion){

    $sql="SELECT 
            codigo, identificacion 
          from 
            pacientes 
          where 
            identificacion='$identificacion' ";
    
    $query=$this->db->query($sql);
    
    if($query->num_rows()>0){
      foreach ($query->result_array() as $row){
        if($row['codigo']!=$codigo){
          return true;
        }else{
          return false;
        }
      }
    }else{
      return false;
    }
  }




    function guardar_paciente($data){
      
        $query=$this->db->insert('pacientes',$data);
    }

    function actualizar_paciente($data,$codigo){
        
        
        $this->db->where("codigo",$codigo);
        $query=$this->db->update('pacientes',$data);
    }

    function pacientes_certificado($codhistoria){
       $sql="SELECT 
              p.nombres,
              p.apellidos,
              p.sexo,
              p.fechanacimiento,
              hp.direccion,
              hp.telefono,
              hp.celular,
              hp.estadocivil,
              hp.numhijos,
              hp.escolaridad,
              hp.escolaridad_completa,
              hp.email,
              io.cargo_atual,
              io.holario_laboral,
              io.turno,
              io.funciones,
              io.antiguedad
          from 
            pacientes p,
            historias_paciente hp,
            historias_informacion_ocupacional io
          where 
            hp.codpaciente=p.codigo and
            io.codhistoria=hp.codhistoria and
            hp.codhistoria='$codhistoria' ";
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

    function existe_en_historia($codigo){
      $sql="SELECT 
            codpaciente 
          from 
            historias_paciente 
          where 
            codpaciente='$codigo' ";
    
    $query=$this->db->query($sql);
    
    if($query->num_rows()>0){
      return true;
    }else{
      return false;
    }

    }

    function buscar_paciente_informacion_edit($codhistoria){

        $sql="SELECT 
                ha.cargo_atual,
                ha.holario_laboral,
                ha.turno,
                ha.funciones,
                ha.antiguedad
              from 
                historias h,
                historias_informacion_ocupacional ha 
              where 
                ha.codhistoria=h.codigo and
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
   
    function buscar_paciente_habitos_edit($codhistoria){

        $sql="SELECT 
                ha.*
              from 
                
                historias_habitos ha 
              where 
                
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
   

    function buscar_paciente_examen_imc_edit($codhistoria){

        $sql="SELECT 
                ha.*
              from 
                
                historias_examen_fisico_imc ha 
              where 
                
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
   

  function buscar_antecedentes_laborales_edit($codhistoria){

        $sql="SELECT 
                ha.*
              from 
                
                historias_antecedentes_laborales ha 
              where 
                
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


  function buscar_accidentes_edit($codhistoria){

        $sql="SELECT 
                ha.*
              from 
                
                historias_accidentes ha 
              where 
                
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