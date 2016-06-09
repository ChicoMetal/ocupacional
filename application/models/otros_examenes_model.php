<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class otros_examenes_model extends CI_Model{

  

  
  function buscar_custionarios($codactividad){
    // var_dump($data);
  
        $sql="SELECT 
        		    n.codigo as codnombre,
                n.nombre,
                n.x as px,
                n.y as py,
                p.codigo as codpregunta,
                p.pregunta,
                p.tipo,
                p.campos,
                p.valorpordefecto,
                p.observacion,
                p.x as hx,
                p.y as hy

              from 
                actividades_nomformularios n,
                actividades_preguntas p,
                actividadesdelaempresa a
              where
               n.codactdelaempresa=a.codigo and 
               p.codnombreformulario=n.codigo and 
               p.estado='activo' and 
               n.estado='activo' and
               a.codactividad='$codactividad'
               order by p.orden, n.orden";
        $query=$this->db->query( $sql);
//echo $sql;
        
        if($query->num_rows() > 0){
         $i=0;
           foreach ($query->result_array() as $row){
              $data[]=$row;
              $i++;
           }
               $row=array( "codnombre"=>"",
                            "nombre"=>"",
                            "px"=>"",
                            "py"=>"",
                            "codpregunta"=>"",
                            "pregunta"=>"",
                            "tipo"=>"",
                            "campos"=>"",
                            "valorpordefecto"=>"",
                            "observacion"=>"",
                            "hx"=>"",
                            "hy"=>""
                            );
               $data[]=$row;
           //$data[$i]['codnombre']='-1' ;
           //var_dump($data);

            return $data;
        }else{
            return false;
        }
  }
    
   function guardar_tipo($data){
      //var_dump($data);
        $query=$this->db->insert('historias_otros',$data);
        return $codigo=$this->db->insert_id();
    }

     function guardar_detalle_values($data,$tabla){
      if($data!=""){
      $sql="insert into $tabla values  $data";
      //echo $sql;
        return $query=$this->db->query($sql);
      }
    }

    function buscar_tipo($codhistoria){
       $sql="SELECT 
                t.codigo, 
                t.nombre
              from 
               historias_otros h,
               tipo_examenes t
              where
                h.tipo=t.codigo and
                h.codigo='$codhistoria' limit 1 ";
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


    function buscar_otros_examanes_edit($codhistoria,$codactividad){
      $sql="SELECT 
                hd.respuestas,
                hd.observacion resobservacion, 
                ah.codigo as codpregunta,
                ah.pregunta,
                ah.tipo,
                ah.campos,
                ah.valorpordefecto,
                ah.observacion preobservacion,
                ah.codigo as codpregunta,
                ap.codigo as codpadre,
                ap.nombre as nompadre,
                a.nombre as nomactividad
              from 
                historias_otros h,
                historias_otros_detalles hd,
                actividades_preguntas ah,
                actividades_nomformularios ap,
                actividadesdelaempresa ade,
                actividades a

              where
                hd.codhistoriaotros=h.codigo and
                hd.codpregunta=ah.codigo and
                ah.codnombreformulario=ap.codigo and
                ade.codigo=ap.codactdelaempresa and 
                ade.codactividad=a.codigo and
                h.codigo ='$codhistoria' and 
                a.codigo='$codactividad' order by ap.codigo,ah.codigo, ap.orden, ah.orden";
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

    function buscar_diagnosticos_edit($codhistoria,$codactividad){
      $sql="SELECT 
                d.codigo,
                d.nombre

              from 
                diagnosticos d,
                historias_otros_disgnosticos hd,
                historias_otros h
              where
                hd.codhistoria=h.codigo and 
                hd.coddiagnostico=d.codigo and  
                h.codigo ='$codhistoria' ";
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

   function delete_from_historias_data($tabla,$codhistoria,$codigo,$fk){
      $sql="DELETE 
            from 
              $tabla
            where
              codhistoria ='$codhistoria' and 
              $fk=$codigo limit 1" ;

       return  $query=$this->db->query( $sql);

    }


  function buscar_codorden($codhistoria){
    $sql="SELECT 
     codorden
    from 
      historias_otros
    where 
     codigo='$codhistoria' 
      ";

    $query=$this->db->query( $sql);

    //echo "<br><br>".$sql;
    if($query->num_rows() > 0){
        $i=1;
       foreach ($query->result_array() as $row){
           return $row["codorden"];
       }

        
    }else{
        return false;
    }

  }


    function paginacion_otros($por_pagina,$pagina,$data){

      if($data['codpaciente']!=""){
        $data['codpaciente']=" and p.codigo='". $data['codpaciente']."' ";   
      }
      if($data['fechainicial']!=""){
        $data['fechainicial']=" and ho.fecha>='". $data['fechainicial']." 00.00.01' ";   
      }
      if($data['fechafinal']!=""){
        $data['fechafinal']=" and ho.fecha<='". $data['fechafinal']." 23:59:59' ";   
      } 

      if($data['codactdelaempresa']!=""){
        $data['codactdelaempresa']="and  an.codactdelaempresa=".$data['codactdelaempresa'];
      } 




      $inicio = ($pagina-1)*$por_pagina;

      $sql = "SELECT distinct
                p.nombres,
                p.apellidos,
                h.fecha,
                o.codigo as codorden,
                o.estado,
                ho.codigo,
                an.codactdelaempresa,
                actp.codactividad
              from 
                orden_actividades o,
                historias h,
                pacientes p,
                historias_otros ho,
                historias_otros_detalles hod,
                actividades_preguntas ap,
                actividades_nomformularios an,
                actividadesdelaempresa actp
              where 
                o.codpaciente=p.codigo and 
                h.codorden=o.codigo and
                ho.codorden=o.codigo and
                ho.codorden= h.codorden and
                hod.codhistoriaotros=ho.codigo and
                ap.codigo=hod.codpregunta and
                ap.codnombreformulario=an.codigo and
                h.paciente=p.codigo and
                actp.codigo=an.codactdelaempresa and

                o.estado='finalizada' and 
                o.soloexamenes='no'
                ".$data['codpaciente']."
                ".$data['fechainicial']."
                ".$data['fechafinal']."
                 ".$data['codactdelaempresa']."


              limit $inicio,$por_pagina";
      //echo $sql; 
      //mejorar consulta
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
    


}
