<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class Welcome extends CI_Controller {

	var $INDEX;

    public function __construct() {
    	parent:: __construct();
    	$this->load->helper('url');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $result['raiz'] = $this->INDEX;
            
            //ip
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
                $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
            }
            if($ipAddress==null || !isset($ipAddress) || $ipAddress=="::1"){
                $ipAddress="localhost";
            }
            $enter=$this->Model_login->login($ipAddress);
                
            $keys = array('idusuario', 'nickusuario','imagen','ip');
            if(isset($this->session))
                $this->load->view('home',$result);
            else
                $this->load->view('login',$result);
	}
}
