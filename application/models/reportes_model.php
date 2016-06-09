<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reportes_model extends CI_Model{

   function buscar_contratos($fechainicio,$fechacorte,$codempresa){
        
        $arrvalores=$this->buscar_valores_contratos($codempresa);

        //var_dump($arrvalores);

        $sql="SELECT
                p.codigo as codpaciente,
                p.identificacion,
                p.nombres, 
                p.apellidos,
                o.fecha,
                o.codigo as codorden,
                deto.codactividad,
                a.nombre as nomexamen,
                ac.codigo as codcontrato,
                a.codigo as codactividad
            FROM
              orden_actividades o,
              detalle_orden_actividades deto,
              actividades a,
              pacientes p,
              actividaescontratadas ac
                
            WHERE 
                o.codigo=deto.codorden_actividad and 
                o.codcontrato=ac.codigo and
                deto.codactividad=a.codigo and
                p.codigo=o.codpaciente and 
                
              
              o.fecha>='$fechainicio 00:00:00' and
              o.fecha<='$fechacorte 23:59:59' and
              ac.codempresa='$codempresa' and

              o.codigo not in(select codorden from facturas_detalles)

              ORDER BY p.codigo, o.fecha";
        $query=$this->db->query( $sql);
        //echo "<br><br>".$sql;
        $i=0;
        if($query->num_rows() > 0){
         
           foreach ($query->result_array() as $row){

               $data[]=$row;
               foreach ($arrvalores as $dataval) {
                if($dataval['codactividad']==$row['codactividad']){
                  $data[$i]['valor']=$dataval['valor'];

                }

              }
              $i++;
        
           }
           
            return $data;
        }else{
            return false;
        }  
   }

   function buscar_valores_contratos($emrpesa){
      $sql="SELECT
                deta.codactividad,
                deta.valor

            FROM
              detalleactividaescontratadas deta,
              actividaescontratadas a
            WHERE 
            deta.codcontrato=a.codigo and
             a.codempresa='$emrpesa'
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


   function buscar_facturas($fechainicio,$fechacorte,$codempresa){

        $sql="SELECT
                *
            FROM
              facturas 
            WHERE 
             fecha>='$fechainicio 00:00:00' and
             fecha<='$fechacorte 23:59:59' and
             codempresa='$codempresa'
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

  function buscar_contratos_excel ($fechainicio,$fechacorte,$codempresa){

        $sql="SELECT
                p.codigo as codpaciente,
                p.identificacion,
                p.nombres, 
                p.apellidos,
                CASE
                WHEN (MONTH(p.fechanacimiento) < MONTH(current_date)) THEN YEAR(current_date) - YEAR(p.fechanacimiento)
                WHEN (MONTH(p.fechanacimiento) = MONTH(current_date)) AND (DAY(p.fechanacimiento) <= DAY(current_date)) THEN YEAR(current_date) - YEAR(p.fechanacimiento)
                ELSE (YEAR(current_date) - YEAR(p.fechanacimiento)) - 1
                END AS edad,
                p.sexo,
                p.estadocivil,
                p.numhijos,
                p.escolaridad,
                p.escolaridad_completa as escolaridadc,
                h.codigo,
                h.fecha as fechahistoria,
                hio.cargo_atual,
                himc.talla,
                himc.peso,
                himc.ta,
                himc.fc,
                himc.fr,
                himc.brazo,
                himc.imc,
                himc.temperatura,
                himc.observacion as observacionimc
               
            FROM
              historias h,
              orden_actividades o,
              pacientes p,
              historias_informacion_ocupacional hio,
              historias_examen_fisico_imc himc,
              actividaescontratadas act
         
            WHERE 
              h.codorden=o.codigo and
              o.codcontrato=act.codigo and 

              o.codpaciente=p.codigo and
              hio.codhistoria=h.codigo and
              himc.codhistoria=h.codigo and



              h.fecha>='$fechainicio 00:00:00' and
              h.fecha<='$fechacorte 23:59:59' and
              act.codempresa='$codempresa'
             
             ORDER BY h.fecha, o.codigo";
        $query=$this->db->query( $sql);
        //echo $sql;
        if($query->num_rows() > 0){
         $i=0;
           foreach ($query->result_array() as $row){
               $data[]=array(
                      "codpaciente"     =>$row["codpaciente"],
                      "identificacion"  =>$row["identificacion"],
                      "nombres"         =>$row["nombres"],
                      "apellidos"       =>$row["apellidos"],
                      "edad"            =>$row["edad"],
                      "sexo"            =>$row["sexo"],
                      "estadocivil"     =>$row["estadocivil"],
                      "numhijos"        =>$row["numhijos"],
                      "escolaridad"     =>$row["escolaridad"],
                      "escolaridadc"     =>$row["escolaridadc"],
                      "codigo"          =>$row["codigo"],
                      "fechahistoria"   =>$row["fechahistoria"],
                      
                      "cargo_atual"    =>$row["cargo_atual"],
                      "talla"           =>$row["talla"],
                      "peso"            =>$row["peso"],
                      "ta"              =>$row["ta"],
                      "fc"              =>$row["fc"],
                      "fr"              =>$row["fr"],
                      "brazo"           =>$row["brazo"],
                      "imc"             =>$row["imc"],
                      "temperatura"     =>$row["temperatura"],
                      "observacionimc"  =>$row["observacionimc"], 
                      "antecedentes"    =>$this->detalles_excel_antecedentes($row["codigo"]),
                      "accidentes"      =>$this->detalles_excel_accidentes($row["codigo"]),
                      "revision"        =>$this->detalles_excel_resvision($row["codigo"]),
                      "examen_fisico"   =>$this->detalles_excel_examen_fisico($row["codigo"]),
                      "interpretacion"  =>$this->detalles_excel_interpretacion($row["codigo"]),
                      "diagnosticos"    =>$this->detalles_excel_diagnosticos($row["codigo"]),
                      "conceptos"       =>$this->detalles_excel_conceptos($row["codigo"]),
                      "recomendaciones" =>$this->detalles_excel_recomendaciones($row["codigo"]),
                        
                      );
             
           }

            return $data;
            
        }else{
            return false;
        }  
   }

  
  function buscar_rips_excel ($fechainicio,$fechacorte){

        $sql="SELECT
                p.codigo as codpaciente,
                p.identificacion,
                p.nombres, 
                p.apellidos,
                CASE
                WHEN (MONTH(p.fechanacimiento) < MONTH(current_date)) THEN YEAR(current_date) - YEAR(p.fechanacimiento)
                WHEN (MONTH(p.fechanacimiento) = MONTH(current_date)) AND (DAY(p.fechanacimiento) <= DAY(current_date)) THEN YEAR(current_date) - YEAR(p.fechanacimiento)
                ELSE (YEAR(current_date) - YEAR(p.fechanacimiento)) - 1
                END AS edad,
                p.sexo,
                h.codigo,
                h.fecha as fechahistoria,
                e.razonsocial
            FROM
              historias h,
              orden_actividades o,
              pacientes p,
              actividaescontratadas act,
              empresas e
         
            WHERE 
              h.codorden=o.codigo and
              o.codcontrato=act.codigo and 
              o.codpaciente=p.codigo and
              e.codigo=act.codempresa and
              h.fecha>='$fechainicio 00:00:00' and
              h.fecha<='$fechacorte 23:59:59' 
              
             
             ORDER BY h.fecha, o.codigo";
        $query=$this->db->query($sql);
       //echo $sql;
        if($query->num_rows() > 0){
         $i=0;
           foreach ($query->result_array() as $row){
               $data[]=array(
                      "codpaciente"     =>$row["codpaciente"],
                      "identificacion"  =>$row["identificacion"],
                      "nombres"         =>$row["nombres"],
                      "apellidos"       =>$row["apellidos"],
                      "edad"            =>$row["edad"],
                      "sexo"            =>$row["sexo"],
                      "codigo"          =>$row["codigo"],
                      "fechahistoria"   =>$row["fechahistoria"],
                      "razonsocial"     =>$row["razonsocial"],
                      "diagnosticos"    =>$this->detalles_excel_diagnosticos($row["codigo"]),
                      "remision"        =>$this->detalles_excel_remision($row["codigo"]),
                        
                      );
             
           }

            return $data;
            
        }else{
            return false;
        }  
   }

   function detalles_excel_antecedentes($codhistoria){
    $sql="SELECT 
            a.tipo,
            GROUP_CONCAT(a.nombre,': ',hrps.observacion) AS antecedentes
          FROM 
            historias_antecedentes_personales hrps,
            antecedentes a
          where 
            hrps.codantecedentes=a.codigo and
            hrps.codhistoria='$codhistoria' and
            hrps.observacion<>'Niega'
            group by a.tipo
           
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


   function detalles_excel_accidentes($codhistoria){
    $sql="SELECT 
           
            CONCAT(accidentes,
                    accidentes1,
                    enfermedad,
                    enfermedad1,
                    fechaaccidente,
                    fechaaccidente1,
                    empresaaccidente,
                    empresaaccidente1,
                    tipodelesion,
                    tipodelesion1,
                    sitiodelesion,
                    sitiodelesion1,
                    incapacidad,
                    incapacidad1,
                    secuelas,
                    secuelas1
                  ) as accidentes
          FROM 
            historias_accidentes
          where 
           codhistoria='$codhistoria' and
          accidentes<>'Niega'
            
           
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


   function detalles_excel_resvision($codhistoria){
    $sql="SELECT 
           GROUP_CONCAT(a.nombre,': ',hrps.observacion) AS revision
          FROM 
            historias_revision_por_sistema hrps,
            revision_por_sistema a
          where 
            hrps.codrevision=a.codigo and
            hrps.codhistoria='$codhistoria' and
            hrps.observacion<>'Sin datos de importancia'
           
           
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

   function detalles_excel_examen_fisico($codhistoria){
    $sql="SELECT 
           GROUP_CONCAT(e.nombre,': ',he.observacion) AS examen_fisico
          FROM 
            historias_examen_fisico he,
            examen_fisico e
          where 
            he.codexamen=e.codigo and
            he.codhistoria='$codhistoria' and
            he.observacion<>'Sin datos de importancia'
           
           
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

   function detalles_excel_interpretacion($codhistoria){
        $sql="SELECT 
            a.nombre,
            hod.respuestas
          FROM 
            historias_otros_detalles hod,
            historias_otros ho,

            actividades_preguntas apre,
            actividades_nomformularios anom,
            actividadesdelaempresa ae,
            actividades a,
            historias h,
            orden_actividades o
          where
            hod.codhistoriaotros=ho.codigo and
            hod.codpregunta=apre.codigo and
            ho.codorden=o.codigo and
            h.codorden=o.codigo and
            apre.codnombreformulario=anom.codigo and
            anom.codactdelaempresa=ae.codigo and
            ae.codactividad=a.codigo and 
            h.codigo='$codhistoria' and
            anom.nombre like 'INTERPRETACI%'
          
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


   function detalles_excel_diagnosticos($codhistoria){
    
    $sql="SELECT 
           GROUP_CONCAT(d.nombre) AS diagnosticos
          FROM 
            historias_diagnosticos hd,
            diagnosticos d
          where 
            hd.coddiagnostico=d.codigo and
            hd.codhistoria='$codhistoria' 
           
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


   function detalles_excel_remision($codhistoria){
    
    $sql="SELECT 
           GROUP_CONCAT(remision,': ',motivo) AS remision
          FROM 
            historias_remision 
          where 
            codhistoria='$codhistoria' 
           
          ";

        $query=$this->db->query( $sql);
        //echo "<br><br>".$sql;
        if($query->num_rows() > 0){
         
           foreach ($query->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return null;
        }  


   }

function detalles_excel_conceptos($codhistoria){
    
    $sql="SELECT 
           GROUP_CONCAT(d.nombre) AS conceptos
          FROM 
            historias_concepto_actitud_medica_ocupcional hd,
            concepto_actitud_medica_ocupcional d
          where 
            hd.codconcepto=d.codigo and
            hd.codhistoria='$codhistoria' 
           
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



function detalles_excel_recomendaciones($codhistoria){
    
    $sql="SELECT 
           rl.nombre,
           d.nombre AS recomendacion
          FROM 
            historias_recomendaciones_laborales hd,
            detallesderecomendaciones_laborales d,
            recomendaciones_laborales rl
          where 
            rl.codigo=d.codrecomendaciones_laborales and
            hd.codrecomendacion=d.codigo and
            hd.codhistoria='$codhistoria'order by rl.codigo
           
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



   function guardar_facturas($data){

     $query=$this->db->insert('facturas',$data);
     return $codigo=$this->db->insert_id();
   }

   function guardar_detalle_values($data,$tabla){
     if($data!=""){
      $sql="insert into $tabla  values $data";
      //echo $sql;
        return $query=$this->db->query($sql);
      }

   }

   function buscar_empresas(){

    $sql="SELECT 
           razonsocial, nit, clave
          FROM 
            empresas 
           
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


}