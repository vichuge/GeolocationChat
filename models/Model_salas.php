<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_salas extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listado($id,$tipo) {
        $this->db->select('
            a.idsala,
            a.nomsala,
            a.latitud,
            a.longitud,
            a.radio,
            a.dtsala,
            a.estatus,
            a.idusuariocreador,
            a.idtiposala,
            (select nickusuario from usuarios where idusuario=a.idusuariocreador) creador,
            (select latitud from usuarios where idusuario=a.idusuariocreador) latcreador,
            (select longitud from usuarios where idusuario=a.idusuariocreador) loncreador,
            a.inbox idinvitado,
            (select nickusuario from usuarios where idusuario=a.inbox) invitado,
            (select latitud from usuarios where idusuario=a.inbox) latinvitado,
            (select longitud from usuarios where idusuario=a.inbox) loninvitado,
            b.tipo,
            c.nickusuario,
            c.imagen
            ');
        $this->db->from('salas a');
        $this->db->join('tiposala b','a.idtiposala=b.idtiposala');
        $this->db->join('usuarios c','a.idusuariocreador=c.idusuario');
        $this->db->order_by('idinvitado','desc');
        
        if($id !=0){
            $this->db->where('a.idsala',$id);
        }
        if($tipo !=0){
            $this->db->where('(a.inbox="general" or a.inbox='.$tipo.') or a.idusuariocreador='.$tipo);
        }else{
            $this->db->where('a.inbox','general');
        }
        $this->db->order_by('a.idtiposala','asc');
        
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function checksala($invitado,$creador) {
        //select idsala,estatus from salas a where (a.idusuariocreador="36" and a.inbox="37") or (a.idusuariocreador="37" and a.inbox="36");
        $this->db->select('
            idsala,
            estatus
            ');
        $this->db->from('salas a');
        if(isset($invitado)){
            $this->db->where('(a.idusuariocreador='.$creador.' and a.inbox='.$invitado.') or (a.idusuariocreador='.$invitado.' and a.inbox='.$creador.')');
        }    

        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function checksalanom($nomsala) {
        $this->db->select('
            idsala
            ');
        $this->db->from('salas a');
        if(isset($nomsala)){
            $this->db->where('a.nomsala',$nomsala);
        }    

        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function insertsala($idtipo,$idusucreador,$nomsala,$latitud="",$longitud="",$radio="",$dtsala,$estatus,$etiqueta="",$inv=""){
        
        $datos = array(
            'idtiposala'=> $idtipo,
            'idusuariocreador'=> $idusucreador,
            'nomsala'=>$nomsala,
            'latitud'=>$latitud,
            'longitud'=>$longitud,
            'radio'=>$radio,
            'etiqueta'=>$etiqueta,
            'dtsala'=>$dtsala,
            'estatus'=>$estatus,
            'inbox'=>$inv
        );
        
        $this->db->insert('salas', $datos);
        $res = $this->db->insert_id();
        
        if ($res > 0)
            return $res;
        else
            return false;
    }
    
    public function chatsala($idsala){
        $this->db->select('
            a.idsala,
            a.nomsala,
            a.latitud,
            a.longitud,
            a.radio,
            b.idmensaje,
            b.idusuario,
            b.idtipomensaje,
            b.texto,
            b.dtmensaje,
            c.nickusuario,
            c.imagen,
            c.latitud latusuario,
            c.longitud lonusuario
            ');
        $this->db->from('salas a');
        $this->db->join('mensajes b','a.idsala=b.idsala');
        $this->db->join('usuarios c','b.idusuario=c.idusuario');
        $this->db->where('b.idsala',$idsala);
        $this->db->order_by('b.dtmensaje');
        
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function usuarios(){
        $id=$this->session->idusuario;
        $this->db->select('
            a.idusuario,
            a.nickusuario,
            a.imagen,
            a.latitud,
            a.longitud,
            (select estatus from salas where etiqueta like "inbox%" and ( idusuariocreador='.$id.' or inbox='.$id.' ) and (idusuariocreador=a.idusuario or inbox=a.idusuario)) estatus,
            (select idusuariocreador from salas where etiqueta like "inbox%" and ( idusuariocreador='.$id.' or inbox='.$id.' ) and (idusuariocreador=a.idusuario or inbox=a.idusuario)) idcreador
            ');
        $this->db->from('usuarios a');
        //$this->db->from('salas a');
        //$this->db->from('mensajes b');
        //$this->db->join('mensajes b','a.idsala=b.idsala');
        //$this->db->join('usuarios c','b.idusuario=c.idusuario');
        //$this->db->where('b.idsala',$idsala);
        $this->db->where('a.estatus',1);
        $this->db->where('a.idusuario !='.$id);
        $this->db->group_by('a.idusuario');
        $this->db->order_by('a.nickusuario');
        
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function estatusInbox($id,$val){
        $info = array(
            'estatus' => $val
            );
        $this->db->where('idsala', $id);
        $this->db->update('salas', $info);
        $n = $this->db->affected_rows();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }
    
    /*public function bloqueados($id){
        $this->db->select('
            idbloqueo,
            idusuafectado,
            estatus
            ');
        $this->db->from('bloqueos');
        $this->db->where('idususolicitante',$id);
        
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }*/
    
}