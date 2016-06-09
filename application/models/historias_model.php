<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class historias_model extends CI_Model{

  

    function guardar_tipo($data){
    	//var_dump($data);
        $query=$this->db->insert('historias',$data);
        return $codigo=$this->db->insert_id();
    }

    function guardar_detalle($data,$tabla){
        return $query=$this->db->insert($tabla,$data);
    }


    function guardar_detalle_values($data,$tabla){
      if($data!=""){
    	$sql="insert into $tabla  values $data";
      //echo $sql;
        return $query=$this->db->query($sql);
      }
    }

   

    
  function buscar_historias_pendientes_proceso(){
    // var_dump($data);
  
        $sql="SELECT 
                h.fecha,
                h.codigo,
                h.estado,
                p.nombres,
                h.codorden

              from 
                historias h,
                pacientes p
              where
                p.codigo=h.paciente and 
                h.estado ='proceso' ";
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
    

  function buscar_historias_imprimir($codigo){
    // var_dump($data);
  
        $sql="SELECT 
                fecha,
                codigo,
                tipo,
                paciente
         
              from 
                historias 
              where
                codigo ='$codigo' ";
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

    function buscar_examenes_realizados_imprimir($codhistoria){

        $sql="SELECT 
                e.nombre
              from 
                historias_examenes_realizados he,
                examenes_realizados e
              where
                
                he.codexamen=e.codigo and
                he.codhistoria ='$codhistoria' ";
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

  
    function buscar_concepto_actitud_medica_imprimir($codhistoria){
        
        $sql="SELECT 
                e.nombre
              from 
                historias_concepto_actitud_medica_ocupcional he,
                concepto_actitud_medica_ocupcional e
              where
                
                he.codconcepto=e.codigo and
                he.codhistoria ='$codhistoria' ";
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


  function buscar_codorden($codhistoria){
    $sql="SELECT 
     codorden
    from 
      historias
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

    function buscar_historia_edit($tabla,$tablapadre,$clavefk,$codhistoria,$campos){
      $sql="SELECT 
                $campos
              from 
                $tabla t,
                $tablapadre tp
              where
                t.$clavefk=tp.codigo and
                codhistoria ='$codhistoria' ";
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

    function buscar_historia_paciente_edit($codhistoria){
      $sql="SELECT 
                p.nombres,
                p.apellidos,
                p.identificacion,
                hp.direccion,
                hp.telefono,
                hp.celular,
                hp.estadocivil,
                hp.numhijos,
                hp.escolaridad,
                hp.escolaridad_completa,
                hp.email

              from 
                pacientes p,
                historias_paciente hp
              where
                p.codigo=hp.codpaciente and 
                hp.codhistoria ='$codhistoria' ";
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
   
    function buscar_historia_informacion_ocupacional_edit($codhistoria){
      $sql="SELECT 
                cargo_atual,
                holario_laboral,
                turno,
                funciones,
                antiguedad
              from 
                historias_informacion_ocupacional
              where
                codhistoria ='$codhistoria' ";
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


    function buscar_historia_examen_fisico_imc_edit($codhistoria){
      $sql="SELECT 
                *
              from 
                historias_examen_fisico_imc
              where
                codhistoria ='$codhistoria' ";
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


    function buscar_historias_habitos_edit($codhistoria){
      $sql="SELECT 
               *
              from 
                historias_habitos
              where
                codhistoria ='$codhistoria' ";
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
   
    function buscar_historias_examen_fisico_osteo_edit($codhistoria){
      $sql="SELECT 
               *
              from 
                historias_examenfisico_osteo
              where
                codhistoria ='$codhistoria' ";
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
   

   function historia_certificado($codhistoria){
       $sql="SELECT 
             codigo,
             codempresa,
             fecha,
             fechasalida,
             tipo,
             paciente,
             enmision,
             eps,
             afp,
             arp
          from 
            historias
          where 
            codigo='$codhistoria' ";
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

    function buscar_audiometria_grafica_historia_edit($codhistoria){
      $sql="SELECT 
             *
          from 
            historias_audiometria_grafica
          where 
            codhistoria='$codhistoria' ";
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


  function buscar_historias_codorden($codorden){
    // var_dump($data);
  
        $sql="SELECT 
                codigo
              from 
                historias 
              where
                codorden ='$codorden' LIMIT 1";
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


    function delete_from_historias($tabla,$codigo){
      $sql="DELETE 
            from 
              $tabla
            where
              codhistoria ='$codigo' ";
       return  $query=$this->db->query( $sql);


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


    function actualizar_detalle_values($sql){
      
      return $query=$this->db->query($sql);

    }


    function actualizarestado($estado,$codhistoria){

      $sql="UPDATE 
              historias
            set 
              estado='$estado'
            where 
              codigo='$codhistoria'
            ";
    
       return $query=$this->db->query( $sql); 
     
    }


    function paginacion($por_pagina,$pagina,$data){

      if($data['codpaciente']!=""){
        $data['codpaciente']=" and p.codigo='". $data['codpaciente']."' ";   
      }
      if($data['fechainicial']!=""){
        $data['fechainicial']=" and h.fecha>='". $data['fechainicial']."' ";   
      }
      if($data['fechafinal']!=""){
        $data['fechafinal']=" and h.fecha<='". $data['fechafinal']."' ";   
      } 




      $inicio = ($pagina-1)*$por_pagina;

      $sql = "SELECT 
                p.nombres,
                p.apellidos,
                h.fecha,
                h.codigo as codhistoria,
                h.codigo
              from 
              
                historias h,
                pacientes p,
                empresas e
              where 
                h.codempresa=e.codigo and
                h.paciente=p.codigo and
                h.estado='finalizada'  
                
                ".$data['codpaciente']."
                ".$data['fechainicial']."
                ".$data['fechafinal']."

              limit $inicio,$por_pagina";
      //echo $sql;
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
    

    function numerodepaginas($por_pagina,$pagina){
      $this->db->where('estado',"finalizada");
      $consulta = $this->db->get('historias');
      $cantidad= $consulta->num_rows();

      $num_paginas = ceil($cantidad/$por_pagina);   
      //echo "<br>num paginas:".$num_paginas." cantidad:".$cantidad." por_pagina:".$por_pagina;
      return $num_paginas;
    }

    function buscar_historias_finalizada(){

      
    }


  function clonar_historias($paciente,$orden){
    // var_dump($data);
    $aleatorio=$this->aleatorio();
   // echo "p: ".$paciente." o:".$orden." ".$aleatorio;
      $data="";
        $sql="call clonarhistoria('$paciente','$orden',@".$aleatorio.")";
      $query=$this->db->query($sql);
      if($query->num_rows() > 0){
       
         foreach ($query->result_array() as $row){
             $data[]=$row;
         }
          echo "<br><br>".$sql;
        

       
      }

      return $this->returnclon($aleatorio);
        
  }
    



  function returnclon($aleatorio){
    
    
        $sql="SELECT 
                @$aleatorio as codigo
              ";
        $query1=$this->db->query( $sql);

        //echo "<br><br>".$sql;
        if($query1->num_rows() > 0){
         
           foreach ($query1->result_array() as $row){
               $data[]=$row;
           }

            return $data;
        }else{
            return false;
        }
    
  }


  function aleatorio(){
    $str="";
    $DesdeLetra = "a";
    $HastaLetra = "z";
    $DesdeNumero = 1;
    $HastaNumero = "";
    for($i=0;$i<10;$i++){
      $aux[$i]=chr(rand(ord($DesdeLetra), ord($HastaLetra))); 
      //$aux[$i]=$aux[$i].rand($DesdeNumero, $HastaNumero);
    }
    foreach($aux as $value1){
      $str=$str.$value1;
    } 
    
    return strtolower($str);
  }


  function   actualizarcampo($campo,$valor,$codhistoria){

      $sql="UPDATE 
              historias
            set 
             $campo='$valor'
            where 
              codigo='$codhistoria'
            ";
    
       return $query=$this->db->query( $sql); 

  }


  function clonar_historias1($paciente,$orden){
  
        $sql="SELECT 
                h.codigo, 
                h.tipo,
                h.enmision,
                h.eps,
                h.afp,
                h.arp 
              FROM   
                historias h,  
                orden_actividades o,  
                pacientes p 
            where 
              h.codorden=o.codigo and 
              o.codpaciente=p.codigo and 
              p.codigo='$paciente' and
              h.estado='finalizada'
              order by 
              h.codigo desc limit 1";
      $query=$this->db->query($sql);
       //echo "<br>".$sql."<br>";
      if($query->num_rows() > 0){
       
         foreach ($query->result_array() as $row){
             $data[]=$row;
         }
        
        

       
      }

      $empresa=$this->buscar_empresa_orden($orden);
      $maxcodigo=$this->buscar_max_codigo();

      $this->insertar_historia($data[0],$orden,$empresa,$paciente, $maxcodigo);
      $this->clonarantecedentes($maxcodigo,$data[0]['codigo']);
      $this->clonardiagnosticos($maxcodigo,$data[0]['codigo']);
      $this->clonarexamenfisico($maxcodigo,$data[0]['codigo']);
      $this->clonarexamenfisicoimc($maxcodigo,$data[0]['codigo']);
      $this->clonarfactores($maxcodigo,$data[0]['codigo']);
      $this->clonarhabitos($maxcodigo,$data[0]['codigo']);
      $this->clonarinformacionocupacional($maxcodigo,$data[0]['codigo']);
      $this->clonarpaciente($maxcodigo,$data[0]['codigo']);
      $this->clonarrevision($maxcodigo,$data[0]['codigo']);
      $this->clonartipo($maxcodigo,$data[0]['codigo']);

      //echo "<br>".$empresa."<br>";
     return  $maxcodigo;
        
  }
    
  function buscar_empresa_orden($orden){
    $sql="SELECT 
            a.codempresa 
          from 
            orden_actividades o,
            actividaescontratadas a
          where 
            o.codcontrato=a.codigo and
            o.codigo='$orden'";
      $query=$this->db->query($sql);
      //echo "<br><br>".$sql;
      if($query->num_rows() > 0){

        foreach ($query->result_array() as $row){
           $data=$row['codempresa'];
        }
      
      }
      return  $data;
  }

  function insertar_historia($data,$orden,$empresa,$paciente,$maxcodigo){
  
    $sql="INSERT INTO 
            historias (codigo,codorden,fecha,tipo,codempresa,paciente,enmision,orden,eps,afp,arp,estado)
          VALUES
            (
              '$maxcodigo',
              '".$orden."',
              now(),
              '".$data['tipo']."',
              '".$empresa."',
              '".$paciente."',
              '".$data['enmision']."',
              '".$orden."',
              '".$data['eps']."',
              '".$data['afp']."',
              '".$data['arp']."',
              'concepto');
      ";
      $query=$this->db->query($sql);

     return $codigo=$this->db->insert_id();

  
  }




  function buscar_max_codigo(){
    $sql="SELECT max(codigo)+1 as codigo from historias";
      $query=$this->db->query($sql);
      if($query->num_rows() > 0){

        foreach ($query->result_array() as $row){
           $data=$row['codigo'];
        }
      }
      return  $data;
    
  }

  function clonarantecedentes($hcodigo,$oldcodigo){
  
    $sql="SELECT
            codantecedentes,
            observacion
          FROM  
              historias_antecedentes_personales 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
      //echo "<br>".$sql;
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values."('".$hcodigo."','".$row['codantecedentes']."','".$row['observacion']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_antecedentes_personales");
      
      return $codigo=$this->db->insert_id();
  }


  function clonardiagnosticos($hcodigo,$oldcodigo){
  
    $sql="SELECT
            coddiagnostico,
            observacion
            
          FROM  
              historias_diagnosticos 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
      ///echo "<br>".$sql;
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values."('".$hcodigo."','".$row['coddiagnostico']."','".$row['observacion']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
   
      $this->guardar_detalle_values($insert_values,"historias_diagnosticos");
      
      return $codigo=$this->db->insert_id();

  }


  function clonarexamenfisico($hcodigo,$oldcodigo){
  
    $sql="SELECT
            codexamen,
            observacion
          FROM  
              historias_examen_fisico 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
      //echo "<br>".$sql;
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values."('".$hcodigo."','".$row['codexamen']."','".$row['observacion']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_examen_fisico");
      
      return $codigo=$this->db->insert_id();
  }


  function clonarexamenfisicoimc($hcodigo,$oldcodigo){
  
    $sql="SELECT
            talla,
            peso,
            ta,
            fc,
            fr,
            brazo,
            imc,
            temperatura,
            observacion
          FROM  
              historias_examen_fisico_imc 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
     
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values.
                  "('".$hcodigo."','".
                    $row['talla']."','".
                    $row['peso']."','".
                    $row['ta']."','".
                    $row['fc']."','".
                    $row['fr']."','".
                    $row['brazo']."','".
                    $row['imc']."','".
                    $row['temperatura']."','".
                    $row['observacion']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_examen_fisico_imc");
      
      return $codigo=$this->db->insert_id();
  }



  function clonarfactores($hcodigo,$oldcodigo){
  
    $sql="SELECT
            codfactor
            
          FROM  
              historias_factores_deriesgo 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
      //echo "<br>".$sql;
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values."('".$hcodigo."','".$row['codfactor']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_factores_deriesgo");
      
      return $codigo=$this->db->insert_id();
  }



  function clonarhabitos($hcodigo,$oldcodigo){
  
    $sql="SELECT
            fumador,
            fuma_frecuencia,
            fuma_anios,
            fuma_tipo,
            alcohol,
            alcohol_frecuencia,
            deportes,
            deportes_frecuencia,
            lesiones,
            observaciones
          FROM  
              historias_habitos 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
     
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values.
                  "('".$hcodigo."','".
                    $row['fumador']."','".
                    $row['fuma_frecuencia']."','".
                    $row['fuma_anios']."','".
                    $row['fuma_tipo']."','".
                    $row['alcohol']."','".
                    $row['alcohol_frecuencia']."','".
                    $row['deportes']."','".
                    $row['deportes_frecuencia']."','".
                    $row['lesiones']."','".
                    $row['observaciones']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_habitos");
      
      return $codigo=$this->db->insert_id();
  }




  function clonarinformacionocupacional($hcodigo,$oldcodigo){
  
    $sql="SELECT
             codhistoria,
             cargo_atual,
             holario_laboral,
             turno,
             funciones,
             antiguedad
            
          FROM  
              historias_informacion_ocupacional 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
     
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values.
                  "('".$hcodigo."','".
                    $row['cargo_atual']."','".
                    $row['holario_laboral']."','".
                    $row['turno']."','".
                    $row['funciones']."','".
                    $row['antiguedad']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_informacion_ocupacional");
      
      return $codigo=$this->db->insert_id();
  }

  function clonarpaciente($hcodigo,$oldcodigo){
  
    $sql="SELECT
            h.codhistoria,
            h.codpaciente,
            p.direccion,
            p.telefono,
            p.celular,
            p.estadocivil,
            p.numhijos,
            p.escolaridad,
            p.escolaridad_completa,
            p.email
            
          FROM  
              historias_paciente h,
              pacientes p 
          where 
            p.codigo=h.codpaciente and
            h.codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
     
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values.
                  "('".$hcodigo."','".
                    $row['codpaciente']."','".
                    $row['direccion']."','".
                    $row['telefono']."','".
                    $row['celular']."','".
                    $row['estadocivil']."','".
                    $row['numhijos']."','".
                    $row['escolaridad']."','".
                    $row['escolaridad_completa']."','".
                    $row['email']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_paciente");
      
      return $codigo=$this->db->insert_id();
  }


  function clonarrevision($hcodigo,$oldcodigo){
  
    $sql="SELECT
            codrevision,
            observacion
          FROM  
              historias_revision_por_sistema 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
      //echo "<br>".$sql;
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values."('".$hcodigo."','".$row['codrevision']."','".$row['observacion']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_revision_por_sistema");
      
      return $codigo=$this->db->insert_id();
  }



  function clonartipo($hcodigo,$oldcodigo){
  
    $sql="SELECT
            codexamen
            
          FROM  
              historias_tipo_examenes 
          where 
            codhistoria='$oldcodigo'";

      $query=$this->db->query($sql);
      //echo "<br>".$sql;
      $insert_values="";
      if($query->num_rows() > 0){
        $i=0;
        foreach ($query->result_array() as $row){
           $insert_values=$insert_values."('".$hcodigo."','".$row['codexamen']."')$";
           $i++;
        }
      }
    
     
      $insert_values=array_filter(explode("$",$insert_values));
      $insert_values=implode(",",$insert_values);
      //var_dump($insert_values);
      
      $this->guardar_detalle_values($insert_values,"historias_tipo_examenes");
      
      return $codigo=$this->db->insert_id();
  }

  function actualizar_informacion($codhistoria,$data){
    $this->db->where("codhistoria",$codhistoria);
    $query=$this->db->update('historias_informacion_ocupacional',$data);
  }

  function actualizar_examen_imc($codhistoria,$data){
    var_dump($data);
    $this->db->where("codhistoria",$codhistoria);
    $query=$this->db->update('historias_examen_fisico_imc',$data);
  }
  
  function actualizar_habitos($codhistoria,$data){
    $this->db->where("codhistoria",$codhistoria);
    $query=$this->db->update('historias_habitos',$data);
  }
  function update_table($codhistoria,$data,$tabla){
    $this->db->where("codhistoria",$codhistoria);
    $query=$this->db->update($tabla,$data);
  }
    
  

  function buscar_historia_otros_diagnosticos_edit(){

  }

  function buscar_historia_otros_diagnosticos_add($codhistoria){
    $sql="SELECT 
                *
              from 
                historias h,
                orden_actividades o,
                detalle_orden_actividades det,
                actividades a,
                diagnosticos d
              where
                h.codorden=o.codigo and
                det.codorden_actividad=o.codigo and
                det.codactividad=a.codigo and
                d.codactividad=a.codigo and 
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


    function buscar_historia_otros_diagnosticos($codhistoria){
      $sql="SELECT 
                d.codigo, d.nombre
              from 
                historias_diagnosticos h,
                diagnosticos d

              where
                h.coddiagnostico=d.codigo and
                d.codactividad<>'58' and
                h.codhistoria ='$codhistoria' ";
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

    function buscar_antecedentes_laborales_edit($codhistoria){
       $sql="SELECT 
                *
              from 
                historias_antecedentes_laborales
              where
                codhistoria ='$codhistoria' ";
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
    function buscar_accidentes_edit($codhistoria){
       $sql="SELECT 
                *
              from 
                historias_accidentes
              where
                codhistoria ='$codhistoria' ";
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

    function buscar_ayudasdiasgnosticas($codhistoria){
             
      $sql = "SELECT 
                codigo
              from 
                historias_otros
              where
                codorden=(
                  SELECT 
                    codigo
                  from 
                    orden_actividades
                  where 
                    codigo=(
                      SELECT 
                        codorden 
                        from 
                        historias
                        where 
                        codigo='$codhistoria'
                      )
                  )
              ";
          //echo $sql;
          $query=$this->db->query( $sql);
          $otrosexamenes="";
          $arrexamenes="";
          $codhistoriaotros="";
          if($query->num_rows() > 0){
           
             foreach ($query->result_array() as $row){
                $codhistoriaotros[]=$row;
                $sqlotrosexamenes = 
                    "SELECT 
                      h.codigo as codhistoriaotros,
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
                      ap.certificado='ok' and
                      h.codigo ='".$row['codigo']."'    
                     ORDER BY ap.orden,ap.codigo,ah.codigo, ah.orden
                  ";
                  //echo $sqlotrosexamenes;
                   $query2=$this->db->query($sqlotrosexamenes);

                   if($query2->num_rows() > 0){
           
                      foreach ($query2->result_array() as $row2){
                        $otrosexamenes[]=$row2;
                      }  
                    }



             }

              return $otrosexamenes;
          }else{
              return false;
          }
    



         
          while ($filaref= $bd->obtener_fila($resultref,0)){
          


          }




       $sql="SELECT 
                *
              from 
                historias_accidentes
              where
                codhistoria ='$codhistoria' ";
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

    

    function eseditable($codhistoria){
      $sql="SELECT 
                estado
              from 
                historias
              where
                codigo ='$codhistoria' ";
        $query=$this->db->query( $sql);

        //echo "<br><br>".$sql;
        if($query->num_rows() > 0){
         
           foreach ($query->result_array() as $row){
               if($row['estado']=="finalizada" || $row['estado']=="cancelada"){
                  return false;
               }else{
                return true;
               }
           }

            return true;
        }else{
            return false;
        }

    }


}
