<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_login extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($ip) {
        $this->db->select('
            idusuario,
            nickusuario,
            imagen,
            ip,
            estatus
            ');
        $this->db->from('usuarios');
        $this->db->where('ip',$ip);
        //$this->db->where('estatus',1);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function deslogin($ip) {
        //$this->db->delete('usuarios', array('ip' => $ip));
        $info = array(
            'estatus' => 0
            );
        $this->db->where('ip', $ip);
        $this->db->update('usuarios', $info);
    }

    public function insertuser($user,$nomfile,$ip){
        $fechaObj = new DateTime('NOW');
	$fechaMod = $fechaObj->format('Y-m-d H:i:s');
        $datos = array(
            'nickusuario'    =>  $user,
            'imagen'  =>  $nomfile,
            'ip'=>$ip,
            'dtusuario'=>$fechaMod,
            'estatus'=>1
            );
        $this->db->insert('usuarios', $datos);
        $id = $this->db->insert_id();
        $res=array(
           'idusuario' => $id,
           'nickusuario' => $user, 
           'imagen' => $nomfile,
           'ip'=>$ip 
        );
        if ($res > 0)
            return $res;
        else
            return FALSE;
    }
    
    public function userpos($id) {
        $this->db->select('
            latitud,
            longitud
            ');
        $this->db->from('usuarios');
        $this->db->where('idusuario',$id);
        //$this->db->where('estatus',1);
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