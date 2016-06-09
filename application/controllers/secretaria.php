<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class recepcion extends CI_Controller{

    var $ses;
     function __construct() {
        parent::__construct();
        //$this->load->model('formatos');
        $this->ses=$this->session->all_userdata();
    }

    function index(){
       
        $usuario=$this->ses['usr_nombre'];

        $data['titulo']="Motos: ".$usuario;
        $data['contenido_principal']="cotizaciones/index";

        $this->load->view('includes/tpl_cotizaciones.php',$data);
    }

    function principal(){
        $this->load->view('cotizaciones/principal');


    }

    function buscar_marcas(){


        $data['marcas']=$this->marcas_model->buscar_marcas();
        $this->load->view('cotizaciones/loadmarcas',$data);


    }


    function informes(){
        $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['nombre_usuario'];

        $data['titulo']="Motos: ".$usuario;
        $data['contenido_principal']="cotizaciones/informes_main";
        $this->load->view('includes/tpl_cotizaciones.php',$data);

    }
	
	
	    function hacerseguimientos()
		{
        $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['nombre_usuario'];

        $data['titulo']="Motos: ".$usuario;
        $data['contenido_principal']="cotizaciones/seguimiento_main";
        $this->load->view('includes/tpl_cotizaciones.php',$data);

		}

    function buscar_cotizaciones(){
        $data['cotizaciones']=$lineas=$this->cotizaciones_model->buscarcotizaciones();
        $this->load->view("cotizaciones/mostrar_cotizaciones",$data);
    }
	
	
	function buscar_cotizacionesseguimiento(){
        $data['cotizaciones']=$lineas=$this->cotizaciones_model->buscarcotizacionesseguimiento();
        $this->load->view("cotizaciones/mostrar_cotizaciones_seguimiento",$data);
    }
	
	

    function loadlineas(){


        $marca = $this->uri->segment(3) ;
        $data['lineas']=$lineas=$this->lineas_model->buscar_lineas($marca);

        $this->load->view('cotizaciones/loadlineas',$data);
    }

   function buscarnombre(){


        $id = $this->input->get("id") ;
        $data['lineas']=$lineas=$this->lineas_model->buscar_detalle_lineas($id);

        $this->load->view('cotizaciones/loadlineas_agregar',$data);
    }
    function buscarfactor(){


        $id = $this->input->get("id") ;
        $data['factor']=$lineas=$this->lineas_model->buscar_factor($id);

        $this->load->view('cotizaciones/factor',$data);
    }

    function guardarpedido(){
         $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['numedeiden'];

        $cliente=$this->input->get("cliente");
        $codusuraio=$usuario;
        $observacion=$this->input->get("observacion");
        $codigo=$this->input->get("codigo");


         $data['lastid']=$this->cotizaciones_model->insertar_cotizacion($cliente,$codusuraio,$observacion,$codigo);

        $this->load->view('cotizaciones/lastid',$data);
    }

    function guardardetalle(){


        $codlinea           =$this->input->get("codlinea");
        $valorbase          =$this->input->get("valorbase");
        $matricula          =$this->input->get("matricula");
        $flete              =$this->input->get("flete");
        $estudiocredito     =$this->input->get("estudiocredito");
        $impuestorodamiento =$this->input->get("impuestorodamiento");
        $valorsoat          =$this->input->get("valorsoat");
        $cuotainicial       =$this->input->get("cuotainicial");
        $descuento          =$this->input->get("descuento");
        $cuota              =$this->input->get("cuota");
        $codigoactual       =$this->input->get("codigoactual");
        $plazo              =$this->input->get("plazo");






         $this->cotizaciones_model->insertar_detalle_cotizacion(
                                                                    $codlinea,
                                                                    $valorbase,
                                                                    $matricula,
                                                                    $flete,
                                                                    $estudiocredito,
                                                                    $impuestorodamiento,
                                                                    $valorsoat,
                                                                    $cuotainicial,
                                                                    $descuento,
                                                                    $cuota,
                                                                    $codigoactual,
                                                                    $plazo
                                                               );

        $this->load->view('cotizaciones/lastid',$data);
    }

     function buscarcodigocotizacion(){

         $data['lastid']=$this->cotizaciones_model->buacar_codigo_cotizacion();
         $this->load->view('cotizaciones/lastid',$data);
    }


    function recargar1(){
       // redirect("cotizaciones/informes");

$this->pdf2();
    }
	
	  function recargar(){
     
	 
	       $codigo = $this->input->post("codigoimprimir");

            $arr_data_session=$this->session->all_userdata();

                    $usuario=$arr_data_session['nombre_usuario'];
                    $data['titulo']="Motos: ".$usuario;
                    $data['contenido_principal']="cotizaciones/mostrarpdfhtml";
                    $data['codigo_formato']=$codigo;
					$data['cotizaciones']=$lineas=$this->cotizaciones_model->buscardetalle_cotizacionesseguimiento($codigo);
					             
                    $this->load->view('includes/tpl_cotizaciones',$data);
	 


    }

     function acceso_denegado(){

        $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['nombre_usuario'];
        $data['contenido_principal']="access/prohibido_1";
        $this->load->view('includes/tpl_usuarios_blank',$data);
    }


    function sin_resultados(){

        $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['nombre_usuario'];
        $data['contenido_principal']="access/sinresultado";
        $this->load->view('includes/tpl_usuarios_blank',$data);
    }


    function menu(){

        $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['nombre_usuario'];

        $data['titulo']="Motos: ".$usuario;
        $data['contenido_principal']="usuarios/venta/principal";

        $this->load->view('includes/tpl_usuarios',$data);

    }


     function facturacion(){

        $arr_data_session=$this->session->all_userdata();
        $usuario=$arr_data_session['nombre_usuario'];

        $data['titulo']="Motos: ".$usuario;
        $data['contenido_principal']="usuarios/venta/facturacion";

        $this->load->view('includes/tpl_usuarios',$data);

    }









    function guardar_venta(){
       if($this->validar_venta()==true){



        $arr_data_session=$this->session->all_userdata();


            $data=array(
                        "codigo"                =>"",
                        "valor_total"           =>"0",
                        "totaliva"              =>"0",
                        "fecha"                 =>date('Y-m-d'),
                        "codcliente"            =>$this->input->post('ced1'),
                        "coddeudor"             =>$this->input->post('ced2'),
                        "saldo"                 =>0,
                        "coutaini"              =>$this->input->post('cuota_inicial'),
                        "comentario"            =>$this->input->post('texto'),
                        "tipo"                  =>$this->input->post('tipo_negocio'),
                        "codusuario"            =>$arr_data_session['numedeiden'],
                        "codempresa"            =>$arr_data_session['codempresa'],
                        "codempleado"           =>$arr_data_session['numedeiden'],
                        "clase"                 =>$this->input->post('clase'),
                        "marca"                 =>$this->input->post('marca'),
                        "tipovehiculo"          =>"",
                        "color"                 =>$this->input->post('color'),
                        "modelo"                =>$this->input->post('modelo'),
                        "nmotor"                =>$this->input->post('numero_motor'),
                        "nserie"                =>$this->input->post('numero_de_chasis'),
                        "placa"                 =>$this->input->post('nplaca'),
                        "linea"                 =>$this->input->post('linea'),
                        "cilindraje"            =>$this->input->post('cilindraje'),
                        "servicio"              =>$this->input->post('servicio'),
                        "npuertas"              =>$this->input->post('npuertas'),
                        "capacidad"             =>$this->input->post('capacidad'),
                        "cascos"                =>$this->input->post('cascos'),
                        "chalecos"              =>$this->input->post('chalecos'),
                        "soat"                  =>$this->input->post('valor_soat'),
                        "placareflectivo"       =>$this->input->post('valor_pase'),
                        "bateria"               =>$this->input->post('bateria'),
                        "retrovisores"          =>$this->input->post('retrovisores'),
                        "herramietas"           =>$this->input->post('valor_kit'),
                        "carroceria"           =>$this->input->post('carroceria'),



                        "campo2"                =>$this->input->post('valor_pase'),
                        "consecutivodefactura"  =>$this->input->post('cod_fact'),
                        "recibocaja"            =>$this->input->post('numero_recibo'),
                        "ncuotas"               =>$this->input->post('numero_de_cuotas'),
                        "vcuotas"               =>$this->input->post('valor_cuotas'),
                        "fechalimite"           =>$this->input->post('fecha_limite'),
                        "estado"                =>0,
                        "nplaca"                =>$this->input->post('nplaca'),

                       );
                $codigo=$this->facturaventas_model->insertar_facura($data);
                redirect('venta/pdf/'.$codigo);


            }else{
                echo "no";
            }

    }



    function pdf(){



         if ($this->uri->segment(3) === FALSE){
            $codigo = 0;

        }else {

            $codigo = $this->uri->segment(3);

            $arr_data_session=$this->session->all_userdata();

                   $usuario=$arr_data_session['nombre_usuario'];
                    $data['titulo']="Motos: ".$usuario;
                    $data['contenido_principal']="cotizaciones/mostrarpdf";
                    $data['codigo_formato']=$codigo;
                    //$data['iframe']="<iframe frameborder='0' width='1000' height='700' src='".base_url()."'pdf/_eval_64.php?codigo=".$codigo."></iframe>";
                    redirect(base_url()."pdf/cotfor/impresiondecotizacion.php?codigo=".$codigo);
                   
                    ///$this->load->view('includes/tpl_cotizaciones',$data);

            }





    }



    function pdf1(){



         if ($this->uri->segment(3) === FALSE){
            $codigo = 0;

        }else {

            $codigo = $this->uri->segment(3);

            $arr_data_session=$this->session->all_userdata();

                   $usuario=$arr_data_session['nombre_usuario'];
                    $data['titulo']="Motos: ".$usuario;
                    $data['contenido_principal']="cotizaciones/mostrarpdf";
                    $data['codigo_formato']=$codigo;
                    //$data['iframe']="<iframe frameborder='0' width='1000' height='700' src='".base_url()."'pdf/_eval_64.php?codigo=".$codigo."></iframe>";
                    //redirect(base_url()."pdf/cotfor/impresiondecotizacion.php?codigo=".$codigo);
                  
                   $this->load->view('includes/tpl_cotizaciones',$data);

            }





    }
	
	
	
	
	
function hacerseguimiento(){



         if ($this->uri->segment(3) === FALSE){
            $codigo = 0;

        }else {

            $codigo = $this->uri->segment(3);

            $arr_data_session=$this->session->all_userdata();

                   $usuario=$arr_data_session['nombre_usuario'];
                    $data['titulo']="Motos: ".$usuario;
                    $data['contenido_principal']="cotizaciones/realizar_seguimiento";
                    $data['codigo_formato']=$codigo;
					
					$data['cotizaciones']=$lineas=$this->cotizaciones_model->buscardetalle_cotizacionesseguimiento($codigo);
					
					$data['seguimientosanteriores']=$lineas=$this->cotizaciones_model->buscar_seguimiento_anteriores($codigo);
					
                   $this->load->view('includes/tpl_cotizaciones',$data);

            }





    }
	
	
	
	
	
function guardar_seguimiento_ajax(){
            if($this->input->is_ajax_request()){
                
                $arr_data_session=$this->session->all_userdata();


                    $data=array(
                
                     
					  
					 
                "codigocot"             =>$this->input->post('codigocot'),
                "observacion"           =>$this->input->post('observacion'),
                "estado"          =>$this->input->post('estado'),
                "codusuario" =>$arr_data_session['numedeiden']
               
        



                    );
					
                $nuevocod=$this->cotizaciones_model->insertar_seguimientos($data);
                 
                $data["nuevocod"]=$nuevocod;
               // $this->load->view('clientes/show_codigo_cliente',$data);
                  
                



            }else{
                //hacer vista de acceso denegado
               // echo "acceso denegado";
            }
    }

function pdf2(){



        

            $codigo = $this->input->post("codigoimprimir");

            $arr_data_session=$this->session->all_userdata();

                   $usuario=$arr_data_session['nombre_usuario'];
                    $data['titulo']="Motos: ".$usuario;
                    $data['contenido_principal']="cotizaciones/mostrarpdf";
                    $data['codigo_formato']=$codigo;
                    //$data['iframe']="<iframe frameborder='0' width='1000' height='700' src='".base_url()."'pdf/_eval_64.php?codigo=".$codigo."></iframe>";
                    redirect(base_url()."pdf/cotfor/impresiondecotizacion.php?codigo=".$codigo);
                   
                    ///$this->load->view('includes/tpl_cotizaciones',$data);

            }





    




}


?>