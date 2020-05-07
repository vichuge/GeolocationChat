<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class SystemController extends CI_Controller {

    var $INDEX;

    public function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
        $this->load->model('Model_login');
        $this->load->model('Model_salas');
        //$this->load->library('session');
        }
        
        public function index(){
	}
        
        public function deny(){
            $result['raiz'] = $this->INDEX;
            $this->load->view('deny',$result);
        }
        
        public function error(){
            $result['raiz'] = $this->INDEX;
            $this->load->view('error',$result);
        }

}
