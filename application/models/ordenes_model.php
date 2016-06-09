<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ordenes_model extends CI_Model{

  
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

     function buscar_codempresa($codigo){
      $sql="SELECT 
                det.codempresa
               from 
                orden_actividades o,
                actividaescontratadas det
              where 
                o.codcontrato = det.codigo and
                o.codigo='$codigo' ";


        $query=$this->db->query( $sql);

      
        if($query->num_rows() > 0){
            $i=1;
           foreach ($query->result_array() as $row){
               $data=$row['codempresa'];
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
      $fecha=" and o.fecha>='$fecha1 00:00:01'  ";
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


  function buscar_ordenes_otros_examanes($paciente,$fecha1,$fecha2){
    $fecha="";
    if($fecha2==""){
      $fecha=" and o.fecha>='$fecha1 00:00:01'  ";
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
                actividades a ,
                actividadesdelaempresa ade
              where 
                o.codigo=det.codorden_actividad and 
                det.codactividad=a.codigo and
                ade.codactividad=a.codigo and
                o.codpaciente='$paciente' and
                o.estado='pendiente'
                $fecha
                 ";


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
      $consulta = $this->db->get('orden_actividades');
      $cantidad= $consulta->num_rows();

      $num_paginas = ceil($cantidad/$por_pagina);   
      //echo "<br>num paginas:".$num_paginas." cantidad:".$cantidad." por_pagina:".$por_pagina;
      return $num_paginas;
    }

    function paginacion($por_pagina,$pagina,$paciente){

      if($paciente!=""){
        $paciente="and p.nombres like '%$paciente%'";
      }

      $inicio = ($pagina-1)*$por_pagina;
      $sql = "SELECT 
                p.nombres,
                p.apellidos,
                o.fecha,
                o.codigo as codorden,
                o.estado,
                e.razonsocial
              from 
                orden_actividades o,
                pacientes p,
                actividaescontratadas ac,
                empresas e
              where 
                o.codcontrato=ac.codigo and
                ac.codempresa=e.codigo and
                o.codpaciente=p.codigo and 
                ( o.estado='pendiente' or o.estado='llenando'or o.estado='concepto') and 
                o.soloexamenes='no'  
                $paciente
              limit $inicio,$por_pagina";
      //echo $sql;
      $query=$this->db->query( $sql);  
      $fil=0;
      if($query->num_rows() > 0){
       
       foreach ($query->result_array() as $row){
           $data[]=$row;

           if($row['estado']=="concepto"){
              $data[$fil]['codhistoria']=$this->buscar_historia_codorden($row['codorden']);
           }
           $fil++;
       }
       //var_dump($data);
        return $data;
      }else{
        return false;
      }      

    }
    
    function paginacion_audiometrias($por_pagina,$pagina){

      

      $inicio = ($pagina-1)*$por_pagina;

      $sql = "SELECT 
                p.nombres,
                p.apellidos,
                o.fecha,
                o.codigo as codorden,
                o.estado
              from 
                orden_actividades o,
                pacientes p
              where 
                o.codpaciente=p.codigo and 
                (o.estado='pendiente' or o.estado='llenando') and
                o.codigo in(select codorden_actividad from detalle_orden_actividades where codactividad=11)
              limit $inicio,$por_pagina";
      //echo $sql;
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


    function buscar_historia_codorden($codorden){
      $sql="SELECT 
                codigo as codhistoria
              from 
                historias
              where
                codorden ='$codorden' ";
        $query=$this->db->query( $sql);

        //echo "<br><br>".$sql;
        if($query->num_rows() > 0){
         
           foreach ($query->result_array() as $row){
              return $row['codhistoria'];
           }

           
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

  function numerodepaginas_otros($por_pagina,$pagina){
      $sql="SELECT 
                count(a.codigo)
              from 
                orden_actividades o,
                detalle_orden_actividades det,
                actividades a ,
                actividadesdelaempresa ade,
                pacientes p
              where 
                o.codigo=det.codorden_actividad and 
                det.codactividad=a.codigo and
                ade.codactividad=a.codigo and
                o.codpaciente=p.codigo and
                ( o.estado='pendiente' or o.estado='llenando'or o.estado='concepto')

              ";

      $consulta = $this->db->get('orden_actividades');
      
      $cantidad= $consulta->num_rows();

      $num_paginas = ceil($cantidad/$por_pagina);   
      //echo "<br>num paginas:".$num_paginas." cantidad:".$cantidad." por_pagina:".$por_pagina;
      return $num_paginas;
    }


    function paginacion_otros($por_pagina,$pagina,$paciente){


      if($paciente!=""){
        $paciente="and p.nombres like '%$paciente%'";
      }
      $inicio = ($pagina-1)*$por_pagina;
      $sql = "SELECT 
                p.nombres,
                p.apellidos,
                o.fecha,
                o.codigo as codorden,
                o.estado,
                a.nombre as actividad,
                a.codigo as codactividad

              from 
                orden_actividades o,
                detalle_orden_actividades det,
                actividades a ,
                actividadesdelaempresa ade,
                pacientes p
              where 
                o.codigo=det.codorden_actividad and 
                det.codactividad=a.codigo and
                ade.codactividad=a.codigo and
                o.codpaciente=p.codigo and
                o.estado<>'cancelada' and
                o.estado<>'finalizada' and
                (det.estado='pendiente' or o.estado='llenando') 
                $paciente
                  limit $inicio,$por_pagina";
      //echo $sql;
      $query=$this->db->query( $sql);  
      $fil=0;
      if($query->num_rows() > 0){
       
       foreach ($query->result_array() as $row){
           $data[]=$row;

           if($row['estado']=="concepto"){
              $data[$fil]['codhistoria']=$this->buscar_historia_codorden($row['codorden']);
           }
           $fil++;
       }
       //var_dump($data);
        return $data;
      }else{
        return false;
      }      

    }
    

    function actualizarestado_detalle($estado,$codorden,$codactividad){

      $sql="UPDATE 
              detalle_orden_actividades
            set 
              estado='$estado'
            where 
              codactividad='$codactividad' and
              codorden_actividad='$codorden'
            ";
    
       return $query=$this->db->query( $sql); 
     
    }


    function actualizarestado_detalle_all($estado,$codorden){

      $sql="UPDATE 
              detalle_orden_actividades
            set 
              estado='$estado'
            where 
              
              codorden_actividad='$codorden'
            ";
    
       return $query=$this->db->query( $sql); 
     
    }

  function buscar_orden_data($orden){
    $sql="SELECT 
        a.nombre,
        do.codigo,
        c.codempresa,
        c.codigo as contrato
    from 
      orden_actividades  o, 
      detalle_orden_actividades do,
      actividades a ,
      actividaescontratadas c
    where 
        o.codigo=do.codorden_actividad and
        do.codactividad=a.codigo  and 
        o.codcontrato=c.codigo and
        o.codigo= '$orden' 
    ";

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

   
    function buscar_contrato_codempresa_edit($orden, $contrato,$codorden){
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
                act.codigo='$contrato' and 
                act.estado>='activo' and 
                a.codigo not in (
                  SELECT 
                    codactividad
                  FROM 
                    detalle_orden_actividades
                  WHERE 
                    codorden_actividad='$codorden'

                  )
                
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


}