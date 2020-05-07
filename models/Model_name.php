<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_name extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function function1() {
    	$id=$this->session->idusuario;
        $this->db->select('
            field1,field2,field3
            ');
        $this->db->from('table');
        $this->db->where('idfield',$this->session->id);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
}