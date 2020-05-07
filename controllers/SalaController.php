<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class SalaController extends CI_Controller {

	var $INDEX;

    public function __construct() {
    	parent:: __construct();
    	$this->load->helper('url');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
        $this->load->model('Model_salas');
        $this->load->model('Model_chat');
        $this->load->model('Model_login');
        $this->load->library('listadosalas');
    }
    
    public function index(){
        $result['raiz'] = $this->INDEX;
        //$this->load->view('welcome_message',$result);
        //$this->load->view('welcome_message');
        $this->load->view('addchat',$result);
    }
    
    public function chat($data){
        $result['raiz'] = $this->INDEX;
        //$this->load->view('welcome_message',$result);
        //$this->load->view('welcome_message');
        $this->load->view('chat',$result);
    }
    
    public function crearsala(){
        $result['raiz'] = $this->INDEX;
        $lat=$this->input->post('lat');
        $lon=$this->input->post('lon');
        $radio=$this->input->post('radio');
        $nomsala=$this->input->post('nomsala');
        $idusu=$this->session->idusuario;
        
        $fechaObj = new DateTime('NOW');
	$dt = $fechaObj->format('Y-m-d H:i:s');
        
        $list=$this->Model_salas->checksalanom($nomsala);
        
        if($list==0){
            //($idtipo,$idusucreador,$nomsala,$latitud,$longitud,$radio,$dtsala,$estatus,$etiqueta,$inbox)
            $idnewsala=$this->Model_salas->insertsala(6,$idusu,$nomsala,$lat,$lon,$radio,$dt,1,'general','general');
            //insertar el mensaje principal
            $this->Model_chat->insert_mensaje($idnewsala,$this->session->idusuario,2,'logo.png');
        }
           
        //listado de salas
        $result['salas']=$this->Model_salas->listado(0,$this->session->idusuario);
        $result['html']='cargando posición...';
        $this->load->view('home',$result);
    }
    
    public function crearinbox(){
        $result['raiz'] = $this->INDEX;
        //$idsala=$this->input->post('idsala');
        $invitado=$this->input->post('invitado');
        $idinvitado=$this->input->post('idinvitado');
        $creador=$this->input->post('creador');
        $idcreador=$this->input->post('idcreador');
        
        //checar si existe el inbox
        $etiqueta='inbox'.$creador.'x'.$invitado;

        $check=$this->Model_salas->checksala($idinvitado,$idcreador);
        
        if($check ==0){
            $nomsala=$invitado.'-'.$creador;
            $idusu=$this->session->idusuario;
            $fechaObj = new DateTime('NOW');
            $dt = $fechaObj->format('Y-m-d H:i:s');
            $idnewsala=$this->Model_salas->insertsala(5,$idusu,$nomsala,'','','',$dt,'na',$etiqueta,$idinvitado);
            
            //insertar el mensaje principal
            $this->Model_chat->insert_mensaje($idnewsala,$this->session->idusuario,2,'logo.png');
            $result['sala']=$this->Model_salas->chatsala($idnewsala);
            $this->load->view('inboxchat',$result);
        }else{
            if($check[0]['estatus']==1){
                $result['sala']=$this->Model_salas->chatsala($check[0]['idsala']);
                $this->load->view('inboxchat',$result);
            }else{
                $this->Model_salas->estatusInbox($check[0]['idsala'],1);
                $result['sala']=$this->Model_salas->chatsala($check[0]['idsala']);
                $this->load->view('inboxchat',$result);
            }
            
        }
        
        
    }
    
    public function listf(){
        $result['raiz'] = $this->INDEX;
        $raiz=$this->INDEX;
        $result['usuarios']=$this->Model_salas->usuarios();
        
        $usuarios=$result['usuarios'];
        $idusu=$this->session->idusuario;
        $position=$this->Model_login->userpos($idusu);
        $point1 = array("lat" => $position[0]['latitud'], "long" => $position[0]['longitud']); // Mi posición
        
        //$result['html']=$this->onlyfriends($idusu,$usuarios,$point1);
        $result['html']='<center>Cargando ubicación...<br><img src="'.$raiz.'resources/imagenes/loading.gif"/></center>';
        
        //$result['bloqueados']=$this->Model_salas->bloqueados($idusu);
        $this->load->view('listf',$result);
    }
    
    public function acceptInbox($id){
        $result['raiz'] = $this->INDEX;
        $this->Model_salas->estatusInbox($id,1);
        $this->load->view('setinbox',$result);
    }
    
    public function declineInbox($id){
        $result['raiz'] = $this->INDEX;
        $this->Model_salas->estatusInbox($id,0);
        $this->load->view('setinbox',$result);
    }
    
    public function salas(){
        $result['raiz'] = $this->INDEX;
        $lat=$this->input->post('latitud');
        $lon=$this->input->post('longitud');
        $point1 = array("lat" => $lat, "long" => $lon); // Mi posición
        
        $idusuario=$this->session->idusuario;
        $salas=$this->Model_salas->listado(0,$idusuario);
        $html=$this->listadosalas->tomarListado($salas,$idusuario,$point1,$result['raiz']);
        
        header('Content-Type: application/json');
        echo json_encode($html);
    }
    
    public function friends(){
        $lat=$this->input->post('latitud');
        $lon=$this->input->post('longitud');
        $point1 = array("lat" => $lat, "long" => $lon); // Mi posición
        $idusuario=$this->session->idusuario;
        $usuarios=$this->Model_salas->usuarios();
        $html=$this->onlyfriends($idusuario,$usuarios,$point1);
        
        header('Content-Type: application/json');
        echo json_encode($html);
    }
    
    public function onlyfriends($id,$usuarios,$point1){
        $point1;
        $raiz= $this->INDEX;
        $html="";
        
        if($usuarios !=0){
            $acomodador=0;
            $contador=0;
            foreach ($usuarios as $key => $value) {
                
                //aqui ira el comparativo de posición
                $posicion=0;
                $distancia=$this->listadosalas->distancecalculation($point1['lat'],$point1['long'],$usuarios[$key]['latitud'],$usuarios[$key]['longitud']);
                if($distancia<=200){
                    $posicion=1;
                }
                
                if($posicion==1){
                    //if($usuarios[$key]['idusuario'] != $this->session->idusuario){
                    $contador++;
                    if($acomodador==0){
                        $html.='<div class="row" align="center">';
                    }
                    $html.='
                        <form class="login-form" method="POST" action="'.$raiz.'inbox/'.$usuarios[$key]['idusuario'].'">
                            <input type="hidden" value="'.$usuarios[$key]['nickusuario'].'" name="invitado">
                            <input type="hidden" value="'.$usuarios[$key]['idusuario'].'" name="idinvitado">
                            <input type="hidden" value="'.$id.'" name="creador">
                            <input type="hidden" value="'.$id.'" name="idcreador">
                            <div class="col s6">
                                
                                <div class="avatar" style="background-image: url('.$raiz.'resources/users/'.$usuarios[$key]['imagen'].')"></div>

                                <p>'.$usuarios[$key]['nickusuario'].'</p>
                                <div id="changer'.$contador.'">';
                                if(isset($usuarios[$key]['estatus'])){
                                    if($usuarios[$key]['idcreador']!=$id){
                                        //Cuando entras de invitado
                                        if($usuarios[$key]['estatus']=='na'){
                                            //Invitado y aún no te decides
                                            $html.='
                                                <button class="btn-floating waves-effect waves-light green" type="submit" ><i class="mdi-navigation-check"></i></button>
                                                <button class="btn-floating waves-effect waves-light red" type="submit" ><i class="mdi-navigation-close"></i></button>
                                            ';
                                        }elseif($usuarios[$key]['estatus']==1){
                                            //Invitado y aceptaste
                                            $html.='
                                                <button class="btn-floating waves-effect waves-light red" type="submit" ><i class="mdi-navigation-close"></i></button>
                                                <button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button>                
                                            ';
                                        }elseif($usuarios[$key]['estatus']==0){
                                            //Invitado y rechazaste
                                            $html.='
                                                <button class="btn-floating waves-effect waves-light green" type="submit" ><i class="mdi-navigation-check"></i></button>
                                                <div class="chip gray white-text">
                                                    <i class="mdi-communication-messenger"></i>
                                                </div>
                                            ';
                                        }
                                    }else{
                                        //El mismo creador consulta si existe el inbox, en su caso aparecera vacio
                                        $html.='<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button>';
                                    }

                                }else{
                                    $html.='<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button>';
                                }  
                                $html.='
                                </div>  
                            </div>
                        </form>
                    ';
                    $acomodador++;
                    if($acomodador==2){
                        $html.='</div>';
                        $acomodador=0;
                    }
                            //}  
                }
                
                
            }
            if($acomodador==1){
                $html.='</div>';
            }
            $contador=0;
        }else{
            $html.='<h5>Parece que no hay usuarios cerca :/</h5>';
        }
        
        return $html;
    }
}
