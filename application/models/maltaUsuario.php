<?php if (! defined('BASEPATH') ) exit('No direct script access allowed');

class MaltaUsuario extends CI_Model {
	function __construct(){
            parent::__construct();
            //$this->load->database();
	}

	public function inserUsuario($datos){
            $insert_datos = array('clave_cliente'=> $datos['clvecle'],'nom_cliente'=> $datos['nombre'],
                                  'ape_paterno'=> $datos['apepaterno'],'ape_materno'=> $datos['apematerno'],
                                  'direccion'=> $datos['direccion'],'correo_electronico'=> $datos['email'],
                                  'telefono'=> $datos['telefono'],'municipio'=> $datos['muni']);
            $this->db->insert('cliente',$insert_datos);
	}
        
        public function inserFormapago($formapago){
            $insert_datos = array('clave_forma'=>$formapago['clvepago'],'tipo_tarjeta'=>$formapago['tipotar'],
                                 'numero_tarjeta'=>$formapago['numtar']);
            $this->db->insert('forma_pago',$insert_datos);
        }
        
        public function inserCompra($compra){
            $insert_datos=array('clave_compra'=>$compra['clvecomp'],'fecha_compra'=>$compra['fechcomp'],
                                'cliente_clave_cliente'=>$compra['clveclien'],'forpago_clave_forma'=>$compra['clvepago'],
                                'forpago_tipo_tarjeta'=>$compra['tipotar']);
            $this->db->insert('compra',$insert_datos);
        }
        
        public function inserTicket($ticket){
            $insert_datos=array('compra_clave_compra'=>$ticket['clvecompra'],'compra_clave_forma'=>$ticket['clvepag'],
                                'compra_tipo_tarjeta'=>$ticket['comptiptar'],'produc_clave_producto'=>$ticket['clveprod'],
                                'produc_nom_producto'=>$ticket['nomprod']);
            $this->db->insert('ticket',$insert_datos);
        }
}