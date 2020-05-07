<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_usuario extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function changename($user,$id) {
        $info = array(
            'nickusuario' => $user
            );
        $this->db->where('idusuario', $id);
        $this->db->update('usuarios', $info);
        $n = $this->db->affected_rows();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }
    
    public function checkdeny($int,$afe){
        $this->db->select('
            idbloqueo,
            estatus
            ');
        $this->db->from('bloqueos');
        $this->db->where('idususolicitante',$int);
        $this->db->where('idusuafectado',$afe);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function createdeny($int,$afe){
        $datos = array(
            'idususolicitante'    =>  $int,
            'idusuafectado'  =>  $afe,
            'estatus'=>1,
            );
        $this->db->insert('bloqueos', $datos);
        $res = $this->db->insert_id();
        if ($res > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    public function updatedeny($int,$afe,$est){
        $info = array(
            'estatus' => $est
            );
        $this->db->where('idususolicitante', $int);
        $this->db->where('idusuafectado', $afe);
        $this->db->update('bloqueos', $info);
        $n = $this->db->affected_rows();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }
    
    public function changepos($lat,$lon,$idusu){
        $info = array(
            'latitud' => $lat,
            'longitud' => $lon
            );
        $this->db->where('idusuario', $idusu);
        $this->db->update('usuarios', $info);
        $n = $this->db->affected_rows();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }
    
}