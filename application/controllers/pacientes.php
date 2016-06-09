<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pacientes extends CI_Controller{
    /*la variable ses asigana en cada controlador 
    los datos de la secion para poder utilizarlos en todo el controlador
    en la session se encuentran dodos los datos del usuario 
    que esta administradno el software
    */

    var $ses;
     function __construct() {
        parent::__construct();

        $this->load->model('pacientes_model');
        $this->load->model('certificados_model');
        $this->load->model('proveedores_model');
        $this->load->model('otros_examenes_model');
        

        /*
            asigno los datos de la sesion ala variable ses
        */
       // date_default_timezone_set('America/New_York');
        $this->ses=$this->session->all_userdata();
    }

    function index(){

        $usuario=$this->ses['nombres'];
        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="pacientes/nuevo";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="admpacientes";
        $this->load->view('includes/empresas/tpl_empresas.php',$data);
    }

     function nuevo(){
         $usuario=$this->ses['usr_nombre'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="pacientes/nuevo";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_recepcion.php',$data);
        
    }

    function orden(){

        
       $data['codigo']=$this->input->post("or_cod");
       $data['nombres']=$this->input->post("or_nom");
       $data['identificacion']=$this->input->post("or_id");     
      

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="pacientes/orden_actividades";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="orden_atencion";

        $this->load->view('includes/empresas/tpl_empresas.php',$data);


    }
 
  
    function guardar(){
       
        if($this->_validar_paciente()){
           $data=array(
                "identificacion"        =>$this->input->post('identificacion'),
                "nombres"               =>$this->input->post('nombres'),
                "apellidos"             =>$this->input->post('apellidos'),
                "sexo"                  =>$this->input->post('sexo'),
                "fechanacimiento"       =>$this->input->post('fechanac'),
                "direccion"             =>$this->input->post('direccion'),
                "telefono"              =>$this->input->post('telefono'),
                "celular"               =>$this->input->post('celular'),
                "estadocivil"           =>$this->input->post('estadocivil'),
                "numhijos"              =>$this->input->post('numhijos'),
                "escolaridad"           =>$this->input->post('escolaridad'),
                "escolaridad_completa"  =>$this->input->post('escolaridad_completa'),
                "eps"                   =>$this->input->post('eps'),
                "afp"                   =>$this->input->post('afp'),
                "arp"                   =>$this->input->post('arp'),
                "fechaingreso"          =>$this->input->post('fechaingreso'),
                "fechacreacion"         =>date("Y/m/d H:m:s"),
                "observaciones"         =>$this->input->post('objetosocial'),
                "email"                 =>$this->input->post('email'),
                "firma"                 =>$this->input->post('firmap'),
                "foto"                  =>$this->input->post('fotop'),
                "estado"                =>"activo",

            );
        //var_dump($data);
        $this->pacientes_model->guardar_paciente($data);
            echo "si";
        }else{
            echo "no";
        }

    }   


    function actualizar(){
       
        if($this->_validar_paciente()){

            $codigo=$this->input->post("codigo");
          
           $data=array(
                "identificacion"        =>$this->input->post('identificacion'),
                "nombres"               =>$this->input->post('nombres'),
                "apellidos"             =>$this->input->post('apellidos'),
                "sexo"                  =>$this->input->post('sexo'),
                "fechanacimiento"       =>$this->input->post('fechanac'),
                "direccion"             =>$this->input->post('direccion'),
                "telefono"              =>$this->input->post('telefono'),
                "celular"               =>$this->input->post('celular'),
                "estadocivil"           =>$this->input->post('estadocivil'),
                "numhijos"              =>$this->input->post('numhijos'),
                "escolaridad"           =>$this->input->post('escolaridad'),
                "escolaridad_completa"  =>$this->input->post('escolaridad_completa'),
                "eps"                   =>$this->input->post('eps'),
                "afp"                   =>$this->input->post('afp'),
                "arp"                   =>$this->input->post('arp'),
                "observaciones"         =>$this->input->post('objetosocial'),
                "email"                 =>$this->input->post('email'),
                "firma"                 =>$this->input->post('firmap'),
                "foto"                  =>$this->input->post('fotop'),
                "estado"                =>"activo",

            );
        //var_dump($data);
        $this->pacientes_model->actualizar_paciente($data,$codigo);
            echo "si";
        }else{
            echo "no";
        }

    }   




    function hora_local($zona_horaria = 0){
        if ($zona_horaria > -12.1 and $zona_horaria < 12.1)
        {
            $hora_local = time() + ($zona_horaria * 3600);
            return $hora_local;
        }
        return 'error';
    }


    public function _validar_paciente(){
        return true;
        $this->form_validation->set_rules('identificacion','identificacion','required|trim');
        $this->form_validation->set_rules('identificacion','identificacion','required|trim');
        $this->form_validation->set_rules('nombres','nombres','required|trim');
        $this->form_validation->set_rules('apellidos','apellidos','required|trim');
        $this->form_validation->set_rules('sexo','sexo','required|trim');
        $this->form_validation->set_rules('fechanacimiento','fechanacimiento','required|trim');

   

        //_existe_usuarioack

        if ($this->form_validation->run() == FALSE){
            return false;
        }else{
            return true;
            //$this->enviar_email($this->input->post('email'),$cod_activacion);
        }

    }



    function guardar_cliente_ajax(){
        if($this->input->is_ajax_request()){
                


            }else{
                //hacer vista de acceso denegado
               // echo "acceso denegado";
            }
    }


    

    function existe_paciente_ajax(){
        if($this->input->is_ajax_request()){
            if($this->_existe_paciente($this->input->post('identificacion'))){
                echo "si";
            }else{
                echo "no";
            }
        }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }

    }

    function _existe_paciente($valor){

        return $this->pacientes_model->existePaciente($valor);
    }

    function existe_paciente_actualizar(){
         if($this->input->is_ajax_request()){
            $codigo=$this->input->post("codigo");
            $identificacion=$this->input->post("identificacion");
            if($this->pacientes_model->existePaciente_actualizar($codigo,$identificacion)){
                echo "si";
            }else{
                echo "no";
            }
        }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }
       
    }

     function buscar_pacientes(){
        $valor=$this->input->get('valor');
        $criterio=$this->input->get('criterio');

        $respuesta= $this->pacientes_model->buscar_pacientes_select($valor,$criterio);
        $data['empresas']=$respuesta;
        $data['quien']=$this->input->get('cli');

        $this->load->view('pacientes/pagination_pacientes',$data);

    }

    function mostrar(){
       $limit="";
        if($this->input->get('limit')){
            $limit="limit ".$this->input->get('limit');

        }
        
        

        $cantidad= $this->pacientes_model->count_pacientes();
        $respuesta= $this->pacientes_model->buscar_pacientes($limit);

        $data['pacientes']=$respuesta;
        $data['cantidad']=$cantidad;
      
        $data['titulo']="Ultraclinica: ";
        $data['contenido_principal']="pacientes/paginacion";
        $data['ses']=$this->ses;

        $this->load->view('includes/tpl_recepcion.php',$data);
    }
    
    function buscar_paciente(){
        //busca el paciente por el numero de identificacion 
        //para devolverlo en un array de Json
        if($this->input->is_ajax_request()){
            $identificacion=$this->input->post('identificacion');
            $respueta=$this->pacientes_model->buscar_paciente($identificacion);
            $data['paciente']=$respueta;
            $this->load->view('pacientes/data_paciente',$data);
         }else{
                //hacer vista de acceso denegado
                //echo "acceso denegado";
       }

        
    }

    function subirimg(){
        //Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
        $carpeta = $this->uri->segment(4) ;
        $identificacion = $this->uri->segment(3) ;
        $ruta="fotos/".$carpeta."/";
        
        
        foreach ($_FILES as $key) {
            if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
                $nombre = $key['name'];//Obtenemos el nombre del archivo
                $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
                //echo "nom:".$nombre." temp:".$temporal;      
                $extension = explode(".",$nombre);
                $num = count($extension)-1;
                if($extension[$num] == "jpg" || $extension[$num] == "JPG" 
                    || $extension[$num] == "png" || $extension[$num] == "PNG"){
                    if($tamano < 1500){
                        $nombre=$identificacion.".".$extension[$num];
                        move_uploaded_file($temporal, $ruta.$nombre); //Movemos el archivo temporal a la ruta especificada
                        $this->redimensionar($nombre,$ruta);
                        echo $extension[$num];
                    }else{
                        echo "1";
                    }
                }else{
                    echo "2";
                }

            }else{
                echo "3"; //Si no se cargo mostramos el error
            }
        }
    }

    function redimensionar($nombre,$ruta){
        $rutaImagenOriginal=$ruta.$nombre;
        //echo $rutaImagenOriginal."<br>";
        //Creamos una variable imagen a partir de la imagen original
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);
        
        //Se define el maximo ancho o alto que tendra la imagen final
        $max_ancho = 200;
        $max_alto = 200;
        
        //Ancho y alto de la imagen original
        list($ancho,$alto)=getimagesize($rutaImagenOriginal);
        
        //Se calcula ancho y alto de la imagen final
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;
        
        //Si el ancho y el alto de la imagen no superan los maximos, 
        //ancho final y alto final son los que tiene actualmente
        if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
            $ancho_final = $ancho;
            $alto_final = $alto;
        }
        /*
         * si proporcion horizontal*alto mayor que el alto maximo,
         * alto final es alto por la proporcion horizontal
         * es decir, le quitamos al alto, la misma proporcion que 
         * le quitamos al alto
         * 
        */
        elseif (($x_ratio * $alto) < $max_alto){
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        }
        /*
         * Igual que antes pero a la inversa
        */
        else{
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }
        
        //Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
        $tmp=imagecreatetruecolor($ancho_final,$alto_final);    
        
        //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
        imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
        
        //Se destruye variable $img_original para liberar memoria
        imagedestroy($img_original);
        
        //Definimos la calidad de la imagen final
        $calidad=100;
        
        //Se crea la imagen final en el directorio indicado
        imagejpeg($tmp,$ruta.$nombre,$calidad);
        
        /* SI QUEREMOS MOSTRAR LA IMAGEN EN EL NAVEGADOR
         * 
         * descomentamos las lineas 64 ( Header("Content-type: image/jpeg"); ) y 65 ( imagejpeg($tmp); ) 
         * y comentamos la linea 57 ( imagejpeg($tmp,"./imagen/retoque.jpg",$calidad); )
         */ 
        //Header("Content-type: image/jpeg");
        //imagejpeg($tmp);
        

    }

    function buscar_certificados(){

        $usuario=$this->ses['nombres'];

        $data['codigo']=$this->input->post("or_cod");
        $data['nombres']=$this->input->post("or_nom");
        $data['identificacion']=$this->input->post("or_id");   

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="certificados/buscar_certificados";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="buscar_certificados";
        $this->load->view('includes/ordenes/tpl_ordenes',$data);


    }

    function buscar_otros(){

        $usuario=$this->ses['nombres'];

        $data['codigo']=$this->input->post("or_cod");
        $data['nombres']=$this->input->post("or_nom");
        $data['identificacion']=$this->input->post("or_id");   

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="otros_examenes/buscar_otros";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="buscar_otros_certificados";
        $this->load->view('includes/ordenes/tpl_ordenes',$data);


    }


    function paginar_certificados(){
        //por pagina me indica de manera automatica cuantos registros 
        //se van a mostrar por defecto 30

        //para crear la cantidad de paginas para la paginacion
       
        
        //el numero de la pagina para hacer 
        //la consulta de cuales registros mostrar{}
        $por_pagina=$this->input->post("porpagina");
        $pagina=$this->input->post("pagina");
        $data['codpaciente']=$this->input->post("codpaciente");
        $data['fechainicial']=$this->input->post("fechainicial");
        $data['fechafinal']=$this->input->post("fechafinal");


        $this->_pagination_data($por_pagina,$pagina,$data);
        
        

    }

    function _pagination_data($por_pagina,$pagina,$data){

        $data["por_pagina"]         =$por_pagina;
        $data["pagina"]             =$pagina;
        $data["ses"]                =$this->ses;
        $data["numerodepaginas"]    =$this->certificados_model->
                                        numerodepaginas($por_pagina,$pagina);
        
        $data["certificados"]         =$this->certificados_model->
                                        paginacion($por_pagina,$pagina,$data);


         $this->load->view('certificados/paginar_resultados',$data);

    }



    function paginar_otrosexamenes(){
        //por pagina me indica de manera automatica cuantos registros 
        //se van a mostrar por defecto 30

        //para crear la cantidad de paginas para la paginacion
       
        
        //el numero de la pagina para hacer 
        //la consulta de cuales registros mostrar{}
        $por_pagina=$this->input->post("porpagina");
        $pagina=$this->input->post("pagina");
        $data['codpaciente']=$this->input->post("codpaciente");
        $data['fechainicial']=$this->input->post("fechainicial");
        $data['fechafinal']=$this->input->post("fechafinal");
        $data['codactdelaempresa']=$this->input->post("codactdelaempresa");


        $this->_pagination_data_otros($por_pagina,$pagina,$data);
        
        

    }

    function _pagination_data_otros($por_pagina,$pagina,$data){

        $data["por_pagina"]         =$por_pagina;
        $data["pagina"]             =$pagina;
        $data["ses"]                =$this->ses;
        $data["numerodepaginas"]    =$this->certificados_model->
                                        numerodepaginas($por_pagina,$pagina);
        
        $data["resultados"]         =$this->otros_examenes_model->
                                        paginacion_otros($por_pagina,$pagina,$data);


         $this->load->view('otros_examenes/paginar_resultados_consulta',$data);

    }


    function remision(){

        
       $data['codigo']=$this->input->post("or_cod");
       $data['nombres']=$this->input->post("or_nom");
       $data['identificacion']=$this->input->post("or_id");     
      

        $usuario=$this->ses['nombres'];

        $data['titulo']="Ultraclinica: ".$usuario;
        $data['contenido_principal']="pacientes/orden_remision";
        $data['ses']=$this->ses;
        $data['active']="pacientes";
        $data['active2']="remision";

        $this->load->view('includes/empresas/tpl_empresas.php',$data);


    }
 

    function generar_remision(){
       
      
       //var_dump($this->input->post());
       
       /*los codigos de las actividades
       array_filter elimina el elemeto vacio del aaray 
       */
       $ca=array_filter(explode(",",$this->input->post("cods_acts")));

       $find=false;
        $array_post=$this->input->post();
        //echo sizeof($array_post);
       $codproveedor=$this->input->post("codproveedor");
       $codpaciente=$this->input->post("codpaciente");
       //echo  $soloexamenes;
        $insert_values="";

        for($i=0;$i<sizeof($ca);$i++){
            //se pregunta si existe el elemento de array con el valor del post
            if(isset($array_post["ch-".$ca[$i]])){

                $find=true;
                $insert_values=
                    $insert_values.
                    "({codigorden},'".
                    $array_post["codigo-act-".$ca[$i]].
                    "')$"
                   
                    ;



                
            }
           

        }

        if($find){


            $insert_values=array_filter(explode("$",$insert_values));
            $insert_values=implode(",",$insert_values);

            $codigo=$this->proveedores_model->guardar_remision(
                    date("Y/m/d H:m:s"),
                    $codproveedor,
                    $codpaciente,
                    $insert_values
                    );

           if($codigo==0){
            echo "no";
           }else{
            echo $codigo;
           }

        }else{
            echo "no";
        }

    }

    function mostrar_ajax_remisiones(){
        if($this->input->is_ajax_request()){
            $codigo=$this->input->post("codigo");
            
            $data['remision']= $this->proveedores_model->buscar_remision_codigo($codigo);
          // var_dump($data['remision']);
            $this->load->view('proveedores/mostrar_remision',$data);

        }
       
    }
    

    function change_historia_ocupacional(){
        if($this->input->is_ajax_request()){
            $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->pacientes_model->buscar_paciente_informacion_edit($data["codhistoria"]);
            $data['informacion']=$respuesta;
            $this->load->view('pacientes/change_informacion_ocu_historia',$data);

        } 
    }


    function change_historia_examen_fisico_imc(){
        if($this->input->is_ajax_request()){
            $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->pacientes_model->buscar_paciente_examen_imc_edit($data["codhistoria"]);
            $data['examen_imc']=$respuesta;
            $this->load->view('pacientes/change_examen_imc_historia',$data);

        } 
    }



    function change_historia_habitos(){
        if($this->input->is_ajax_request()){
            $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->pacientes_model->buscar_paciente_habitos_edit($data["codhistoria"]);
            $data['habitos']=$respuesta;
            $this->load->view('pacientes/change_habitos_historia',$data);

        } 
    }

    function change_historia_antecedentes_laborales(){
        if($this->input->is_ajax_request()){
            $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->pacientes_model->buscar_antecedentes_laborales_edit($data["codhistoria"]);
            $data['antecedentes']=$respuesta;

            $this->load->view('pacientes/change_antecedentes_laborales_historia',$data);

        } 
    }

    function change_historia_accidentes(){
        if($this->input->is_ajax_request()){
            $data["codhistoria"]=$this->input->post("codhistoria");
            $respuesta= $this->pacientes_model->buscar_accidentes_edit($data["codhistoria"]);
            $data['accidentes']=$respuesta;
            $this->load->view('pacientes/change_accidentes_historia',$data);

        } 
    }



}




?>