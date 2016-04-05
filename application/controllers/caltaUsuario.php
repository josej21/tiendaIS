<?php if (! defined('BASEPATH') ) exit('No direct script access allowed');
class CaltaUsuario extends CI_Controller {
    function __construct(){
        parent::__construct();
        session_start();
        $this->load->model('maltaUsuario');
    }

    public function index(){
        echo $_SESSION['usuario'];
        $this->load->view('administrador/headers');
        $this->load->view('administrador/formaltaUsuario');		
    }

    public function recibirDatos(){
        $opcion = $this->input->post('cobrar');
        switch ($opcion) {
            case 'Regresar':
                $direccion = base_url();
                $direccion.= "ctienda";
                redirect($direccion);//Mandamos a llamar al controlador de Datos personales
            break;
            default:
                if(isset($_SESSION['carrito'])){
                    $muni = $this->input->post('municipio');
                    $tiptar = $this->input->post('tipotarjeta');
                    //Si el formulario es valido se inserta en la base 
                    if ($this->validarForm()!= FALSE && $muni != 'Municipio' && $tiptar != 'Tipo de tarjeta' ) { 
                        //Se crea el array para el nuevo cliente
                        $cliente = $this->nuevoUsuario();
                        //$this->maltaUsuario->inserUsuario($cliente);
                        //Se crea el array para la tabla de forma_pago
                        $formapago= $this->nuevoPago();
                        //$this->maltaUsuario->inserFormapago($formapago);
                        //Se crea el array para la tabla de compra
                        $compra = $this->nuevaCompra($formapago['clvepago']);
                        //$this->maltaUsuario->inserCompra($compra);
                        //Se crea el array para la tabla de ticket
                        foreach ($_SESSION['carrito'] as $indice){
                            $ticket = array('clvecompra'=>$compra['clvecomp'],'clvepag'=>$formapago['clvepago'],
                                            'comptiptar'=>$compra['tipotar'],'clveprod'=>$indice['id'],
                                            'nomprod'=>$indice['nombre']);
                            //Inserto a la base de datos
                          //  $this->maltaUsuario->inserTicket($ticket);
                        }
                        $datos = array('numcompra'=>$compra['clvecomp'],'direccion'=>$cliente['direccion'],$_SESSION['carrito']);
                        $this->load->view('administrador/headers');
                        $this->load->view('administrador/datosEnvio',$datos);
                    }	
                    else{ //En caso de que no sea valido se recarga el formulario 
                        echo "<h1 align=\"center\">Error</h1>";
                        if($muni == 'Municipio')
                            echo "El campo Municipio debe ser valido";
                        if($tiptar == 'Tipo de tarjeta')
                            echo "<br>Debe de selecionar un tipo de tarjeta";
                        $this->load->view('administrador/headers');
                        $this->load->view('administrador/formaltaUsuario');
                    }
                }
                else{
                    unset($_SESSION['carrito']);
                    $direccion = base_url();
                    $direccion.= "ctienda";
                    redirect($direccion);//Mandamos a llamar al controlador de Datos personales
                }
            break;
        }
    }
    
    public function terminar(){
        unset($_SESSION['carrito']);
        $direccion = base_url();
        $direccion.= "ctienda";
        redirect($direccion);//Mandamos a llamar al controlador de Datos personales
    }
    
    private function  reglas(){
        return (array('nmpersonal' =>'required|min_length[4]','apepatpersonal'=>'required|min_length[4]',
                      'emailpersonal'=>'required|valid_email','direcpersonal'=>'required|min_length[4]',
                      'telepersonal'=>'integer','fechcompra'=>'required','numtarjeta'=>'required|integer'));
    }
    
    private function mensajes(){
        return (array('required' =>'El campo %s es obligatorio',
                      'min_length'=>'El campo %s debe tener una longitud minima de 4',
                      'valid_email'=>'El campo %s debe tener una direccion de correo valida',
                      'integer'=>'El campo %s debe contener solo numeros'));
    }
    
    private function nuevoUsuario(){
        return (array('clvecle'=>$_SESSION['usuario'],'nombre'=>$this->input->post('nmpersonal'),'apepaterno'=>$this->input->post('apepatpersonal'),
                      'apematerno'=>$this->input->post('apematpersonal'),'direccion'=>$this->input->post('direcpersonal'),
                      'email'=>$this->input->post('emailpersonal'),'telefono'=>$this->input->post('telepersonal'),
                      'muni'=>  $this->input->post('municipio')));
    }
    
    private function validarForm(){
        //Reglas para validar
        $validacion = $this->reglas();
        //Titulos para las etiquetas
        $etiquetas =array('Nombre','Apellido Paterno','Correo Electronico','Direccion','Telefono',
                          'Fecha de compra','Numero de tarjeta');
        //Mensajes para mostrar
        $mensajes = $this->mensajes();
        $indice=0;
        foreach ($validacion as $llave => $condicion){
            $this->form_validation->set_rules($llave,$etiquetas[$indice],$condicion);
            $indice++; 
        }
        foreach ($mensajes as $indice => $valor)
            $this->form_validation->set_message($indice,$valor);
        
        return($this->form_validation->run());
    }
    
    private function nuevoPago(){
        $clave = $this->input->post('numtarjeta').$_SESSION['usuario'];
        $tabforma_pago = array('clvepago'=>$clave,'tipotar'=>$this->input->post('tipotarjeta'),
                               'numtar'=>$this->input->post('numtarjeta'));
        return ($tabforma_pago);
    }
    
    private function nuevaCompra($clveforma){
        $clave =$clveforma.$this->input->post('fechcompra').mt_rand();
        $tabcompra = array('clvecomp'=>$clave,'fechcomp'=>$this->input->post('fechcompra'),
                           'clveclien'=>$_SESSION['usuario'],'clvepago'=>$clveforma,
                           'tipotar'=>$this->input->post('tipotarjeta'));
        return($tabcompra);
    }
}