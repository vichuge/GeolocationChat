<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class LoginController extends CI_Controller {

    var $INDEX;

    public function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
        $this->load->model('Model_login');
        $this->load->model('Model_salas');
        $this->load->library('listadosalas');
        //$this->load->library('session');
        }
        
        public function index(){
            $result['raiz'] = $this->INDEX;
            $raiz=$this->INDEX;
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
                $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
            }
            if($ipAddress==null || !isset($ipAddress)){
                $ipAddress="PRIVATE";
            }elseif($ipAddress=="::1"){
                $ipAddress="localhost";
            }
                       
            $enter=$this->Model_login->login($ipAddress);
            
            if(isset($enter[0]['estatus'])){
                switch ($enter[0]['estatus']) {
                    case 0:$bd='0';break;
                    case 1:$bd='1';break;
                    default:$bd='Error';
                }
            }else{
                $bd='N';
            }
            
            //para probar
            //$keys = array('idusuario', 'nickusuario','imagen','ip');
            //$this->session->unset_userdata($keys);
            
            switch (isset($this->session->idusuario)) {
                case false:$se='0';break;
                case true:$se='1';break;
                default:$se='Error';
            }
            
            //para entrar como quiera
            /*$keys = array('idusuario', 'nickusuario','imagen','ip');
            $this->session->unset_userdata($keys);
            $arraydata=array(
                'idusuario' => 22,
                'nickusuario' => 'paco el chato',
                'imagen' => 'no_user.png',
                'ip'=>'localhost'
            );
            $this->session->set_userdata($arraydata);
            $this->session->unset_userdata($keys);
            $ejemplillo=4;
            $se='1';
            $bd='1';*/
            
            $position=$bd.$se; 
            switch ($position) {
                case '00':
                    $this->load->view('deny',$result);
                    break;
                case '01':
                    $keys = array('idusuario', 'nickusuario','imagen','ip');
                    $this->session->unset_userdata($keys);
                    $this->load->view('deny',$result);
                    break;
                case '10':
                    $arraydata=array(
                        'idusuario' => $enter[0]['idusuario'],
                        'nickusuario' => $enter[0]['nickusuario'], 
                        'imagen' => $enter[0]['imagen'],
                        'ip'=>$enter[0]['ip']
                    ); 
                    $this->session->set_userdata($arraydata);
                    
                    //$result['salas']=$this->Model_salas->listado(0,$enter[0]['idusuario']);
                    
                    $idusu=$this->session->idusuario;
                    $position=$this->Model_login->userpos($idusu);
                    $point1 = array("lat" => $position[0]['latitud'], "long" => $position[0]['longitud']); // Mi posición
                    $idusuario=$this->session->idusuario;
                    $salas=$this->Model_salas->listado(0,$idusu);
                    //$result['html']=$this->listadosalas->tomarListado($salas,$idusuario,$point1,$result['raiz']);
                    $result['html']='<center>Cargando ubicación...<br><img src="'.$raiz.'resources/imagenes/loading.gif"/></center>';
                    
                    $this->load->view('home',$result);
                    break;
                case '11':
                    //$result['salas']=$this->Model_salas->listado(0,$enter[0]['idusuario']);
                    
                    $idusu=$this->session->idusuario;
                    $position=$this->Model_login->userpos($idusu);
                    $point1 = array("lat" => $position[0]['latitud'], "long" => $position[0]['longitud']); // Mi posición
                    $idusuario=$this->session->idusuario;
                    $salas=$this->Model_salas->listado(0,$idusu);
                    
                    //$result['html']=$this->listadosalas->tomarListado($salas,$idusuario,$point1,$result['raiz']);
                    $result['html']='<center>Cargando ubicación...<br><img src="'.$raiz.'resources/imagenes/loading.gif"/></center>';
                    
                    $this->load->view('home',$result);
                    break;
                case 'N0':
                    $this->load->view('login',$result);
                    break;
                case 'N1':
                    $keys = array('idusuario', 'nickusuario','imagen','ip');
                    $this->session->unset_userdata($keys);
                    $this->load->view('login',$result);
                    break;
                default:
                    $this->load->view('error',$result);
            }
            
	}
        
	public function home(){
            $result['raiz'] = $this->INDEX;
            $raiz = $this->INDEX;
            $user=$this->input->post('nomusuario');
            
            //ip
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
                $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
            }
            
            if($ipAddress==null || !isset($ipAddress) || $ipAddress=="::1"){
                $ipAddress="localhost";
            }
           
            $nomfile="no_user.png";
            $enter=$this->Model_login->login($ipAddress);
            if($enter==0 && isset($user)){
                $id=$this->Model_login->insertuser($user,$nomfile,$ipAddress);
                $arraydata=array(
                    'idusuario' => $id['idusuario'],
                    'nickusuario' => $id['nickusuario'], 
                    'imagen' => $id['imagen'],
                    'ip'=>$id['ip']
                        );
                $this->session->set_userdata($arraydata);
            }
            
            //reinicia la sessión (para hacer pruebas y cambias datos de la bd y session al mismo tiempo).
            $erasedata=array('idusuario','nickusuario','imagen','ip');
            $this->session->unset_userdata($erasedata);
            $arraydata=array(
                'idusuario' => $enter[0]['idusuario'],
                'nickusuario' => $enter[0]['nickusuario'], 
                'imagen' => $enter[0]['imagen'],
                'ip'=>$enter[0]['ip']
                );
            $this->session->set_userdata($arraydata);             
            
            //$result['salas']=$this->Model_salas->listado(0,$this->session->idusuario);
            
            $idusu=$this->session->idusuario;
            $position=$this->Model_login->userpos($idusu);
            //$point1 = array("lat" => $position[0]['latitud'], "long" => $position[0]['longitud']); // Mi posición
            //$idusuario=$this->session->idusuario;
            //$salas=$this->Model_salas->listado(0,$idusu);
            
            //$result['html']=$this->listadosalas->tomarListado($salas,$idusuario,$point1,$result['raiz']);
            $result['html']='<center>Cargando ubicación...<br><img src="'.$raiz.'resources/imagenes/loading.gif"/></center>';
            $this->load->view('home',$result);
	}
        
	public function salir(){
            $result['raiz'] = $this->INDEX;
            //$this->Model_login->deslogin($this->session->ip);
            $keys = array('idusuario', 'nickusuario','imagen','ip');
            $this->session->unset_userdata($keys);
            $this->load->view('salir',$result);
	}
        
        public function salirchat(){
            $result['raiz'] = $this->INDEX;
            $this->load->view('salir',$result);
	}

}
