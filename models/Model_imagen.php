<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_imagen extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function cambioNombre($nom,$id) {
        $info = array(
            'imagen' => $nom
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
    
}