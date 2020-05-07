<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class UserController extends CI_Controller {

	var $INDEX;

    public function __construct() {
    	parent:: __construct();
    	$this->load->helper('url');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
        $this->load->model('Model_usuario');
        $this->load->model('Model_login');
    }

    public function index(){
        $result['raiz'] = $this->INDEX;
        $result['nomusuario']=$this->session->nickusuario;
        $result['imagen']=$this->session->imagen;
        $this->load->view('edituser',$result); 
    }
     
    public function editarNombre(){
        $result['raiz'] = $this->INDEX;
        $username=$this->input->post('newname');
        $idusuario=$this->session->idusuario;
        //$enter=$this->Model_login->login($ipAddress);
        if(isset($username)){
            $this->Model_usuario->changename($username,$idusuario);
        }
        $keys = array('nickusuario');
        $this->session->unset_userdata($keys);
        $arraydata=array('nickusuario' => $username);
        $this->session->set_userdata($arraydata);
        //return $val;
    }
    
    public function denyuser(){
        $result['raiz'] = $this->INDEX;
        $userafectado=$this->input->post('idusuafectado');
        $user=$this->session->idusuario;
        $check=$this->Model_usuario->checkdeny($user,$userafectado);
        
        if($check ==0){
            $this->Model_usuario->createdeny($user,$userafectado);
        }else{
            if($check[0]['estatus']==1){
                $this->Model_usuario->updatedeny($user,$userafectado,0);
            }else{
                $this->Model_usuario->updatedeny($user,$userafectado,1);
            }
            
        }
        
    }
    
    public function changepos(){
        $result['raiz'] = $this->INDEX;
        $lat=$this->input->post('latitud');
        $lon=$this->input->post('longitud');
        $idusuario=$this->session->idusuario;
        $this->Model_usuario->changepos($lat,$lon,$idusuario);
    }
    
}
