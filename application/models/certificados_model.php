<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class certificados_model extends CI_Model{

  
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
  

    function buscar_contrato($codigo){
      $sql="SELECT 
                emp.nit,
                emp.razonsocial,
                emp.direccion,
                emp.telefono,
                emp.ciudad,
                emp.departamento,
                a.nombre,
                a.descripcion,
                act.fecha,
                det.valor

              from 
                actividaescontratadas act,
                detalleactividaescontratadas det,
                empresas emp,
                actividades a
              where 
                det.codcontrato = act.codigo and
                a.codigo=det.codactividad  and
                emp.codigo=act.codempresa and
                act.codigo='$codigo' ";


        $query=$this->db->query( $sql);

        echo "<br><br>".$sql;
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




  function buscar_ordenes($paciente,$fecha1,$fecha2){
    $fecha="";
    if($fecha2==""){
      $fecha=" and o.fecha>='$fecha1 00:00:01' and o.fecha<='$fecha1 23:59:59' ";
    }else{
      $fecha="and  o.fecha>='$fecha1 00:00:01' and o.fecha<='$fecha2 23:59:59'";
    }


     $sql="SELECT 
                det.codactividad,
                a.nombre,
                a.descripcion,
                o.fecha,
                det.codigo as codetalle,
                o.codigo as codorden
              from 
                orden_actividades o,
                detalle_orden_actividades det,
                actividades a 
              where 
                o.codigo=det.codorden_actividad and 
                det.codactividad=a.codigo and
                o.codpaciente='$paciente' and
                o.estado='pendiente'
                $fecha
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

    function buscar_orden_codigo($codigo){
      $sql="SELECT 
                det.codactividad,
                a.nombre,
                a.descripcion,
                o.fecha,
                det.codigo as codetalle,
                o.codigo as codorden
              from 
                orden_actividades o,
                detalle_orden_actividades det,
                actividades a
              where 
                o.codigo=det.codorden_actividad and 
                det.codactividad=a.codigo and
                o.codigo='$codigo' 
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

    function guardar_orden($fecha,$codcontrato,$codpaciente,$data,$usuario,$soloexamenes){

      $sql="INSERT INTO 
                orden_actividades 
                ( fecha,codcontrato,codpaciente,usuario,soloexamenes)
            VALUES
                ('$fecha','$codcontrato','$codpaciente','$usuario','$soloexamenes')";
          $query=$this->db->query( $sql);       
          $codigo=$this->db->insert_id();


          
          $data=str_replace("{codigorden}",$codigo,$data);
          $res=$this->guardar_orden_detalle($data);
          
          if($res==0){
            return 0;
          }else{
            return $codigo;
          }
     
         
       
    }

    function guardar_orden_detalle($data){

      $sql="INSERT INTO 
                detalle_orden_actividades 
                (codorden_actividad,codactividad,estado)
            VALUES
                $data";
                //echo $sql;
        return $query=$this->db->query( $sql);       
       
        
       
    }

    function actualizarestado($estado,$codorden){

      $sql="UPDATE 
              orden_actividades
            set 
              estado='$estado'
            where 
              codigo='$codorden'
            ";
    
       return $query=$this->db->query( $sql); 
     
    }


    function numerodepaginas($por_pagina,$pagina){
    	$this->db->where('estado',"finalizada");
      $consulta = $this->db->get('historias');
      $cantidad= $consulta->num_rows();

      $num_paginas = ceil($cantidad/$por_pagina);   
      //echo "<br>num paginas:".$num_paginas." cantidad:".$cantidad." por_pagina:".$por_pagina;
      return $num_paginas;
    }

    function paginacion($por_pagina,$pagina,$data){

      if($data['codpaciente']!=""){
        $data['codpaciente']=" and p.codigo='". $data['codpaciente']."' ";   
      }
      if($data['fechainicial']!=""){
        $data['fechainicial']=" and h.fecha>='". $data['fechainicial']." 00.00.01' ";   
      }
      if($data['fechafinal']!=""){
        $data['fechafinal']=" and h.fecha<='". $data['fechafinal']." 23:59:59' ";   
      } 




      $inicio = ($pagina-1)*$por_pagina;

      $sql = "SELECT 
                p.nombres,
                p.apellidos,
                h.fecha,
                o.codigo as codorden,
                o.estado,
                h.codigo
              from 
                orden_actividades o,
                historias h,
                pacientes p
              where 
                o.codpaciente=p.codigo and 
                h.codorden=o.codigo and
                o.estado='finalizada' and 
                o.soloexamenes='no'
                ".$data['codpaciente']."
                ".$data['fechainicial']."
                ".$data['fechafinal']."

              limit $inicio,$por_pagina";
//      echo $sql;
      $data="";
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
    
     
  function buscar_soloexamenes($codigo){
    $sql="SELECT 
     soloexamenes
    from 
      orden_actividades
    where 
     codigo='$codigo' 
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


  function buscar_emamenes($codigo){
    $sql="SELECT 
        codactividad
    from 
      detalle_orden_actividades
    where 
        codorden_actividad='$codigo' 
    ";

    $query=$this->db->query( $sql);

   // echo "<br><br>".$sql;
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