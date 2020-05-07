<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_chat extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_mensaje($idsala,$idusuario,$idtipo,$text){
        $fechaObj = new DateTime('NOW');
	   $fechaMod = $fechaObj->format('Y-m-d H:i:s');
        $datos = array(
            'idsala'=>$idsala,
            'idusuario'=>$idusuario,
            'idtipomensaje'=>$idtipo,
            'texto'=>$text,
            'dtmensaje'=>$fechaMod
            );
        $this->db->insert('mensajes', $datos);
        $res = $this->db->insert_id();
        if ($res > 0)
            return $res;
        else
            return FALSE;
    }
    
    public function take_mensaje($id) {
        $this->db->select('
            a.idmensaje,
            a.idsala,
            a.idusuario,
            a.idtipomensaje,
            a.texto,
            a.dtmensaje,
            b.nickusuario,
            b.imagen,
            (select estatus from bloqueos where idusuafectado=a.idusuario) bloqueo
            ');
        $this->db->from('mensajes a');
        $this->db->join('usuarios b','a.idusuario=b.idusuario');
        $this->db->where('a.idmensaje',$id);
        
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function countmessages($sala){
        $this->db->select('
            count(idmensaje)
            ');
        $this->db->from('mensajes a');
        $this->db->where('a.idsala',$sala);
        
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