<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class ChatController extends CI_Controller {

    var $INDEX;

    public function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
        $this->load->model('Model_salas');
        $this->load->model('Model_login');
        $this->load->model('Model_chat');
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
        $result['sala']=$this->Model_salas->chatsala($data);
        
        $raiz=$this->INDEX;
        $sala=$result['sala'];
        $user=$this->session->idusuario;
        $result['html']=$this->conversation($raiz,$sala,$user);
        $result['idsala']=$sala[0]['idsala'];
        $result['nomsala']=$sala[0]['nomsala'];
        $this->load->view('chat',$result);
    }
    
    public function onlyconv($datas){
        $result['raiz'] = $this->INDEX;
        $result['sala']=$this->Model_salas->chatsala($datas);
        $latitud=$this->input->post('latitud');
        $longitud=$this->input->post('longitud');
        $sala=$result['sala'];
        if( $sala[0]['latitud'] !=0 && $sala[0]['longitud'] !=0 ){
            $distance=$this->listadosalas->distanceCalculation($latitud,$longitud,$sala[0]['latitud'],$sala[0]['longitud']);
        }else{
            $distance=$this->listadosalas->distanceCalculation($latitud,$longitud,$sala[0]['latusuario'],$sala[0]['lonusuario']);
        } 
    
        $raiz=$this->INDEX;
        
        $user=$this->session->idusuario;
        $html=$this->conversation($raiz,$sala,$user);
        
        //$salir=0;
        if($distance>$sala[0]['radio']){
            $html='1';
        }
        
        /*$data=array(
            'html' => $html,
            'salir' => $salir
        );*/
        //$down=$this->Model_chat->countmessages($data);
        //$down2=$down[0]['count(idmensaje)'];
        header('Content-Type: application/json');
        echo json_encode($html);
    }
    
    public function addmessage(){
        $idsala=$this->input->post('idsala');
        $idusuario=$this->input->post('idusuario');
        $idtipomensaje=$this->input->post('idtipomensaje');
        $texto=$this->input->post('texto');
        $idmensaje=$this->Model_chat->insert_mensaje($idsala,$idusuario,$idtipomensaje,$texto);
        //$datamensaje=$this->Model_chat->take_mensaje($idmensaje);
    }
    
    public function conversation($raizc,$salac,$userc){
        $raiz=$raizc;
        $sala=$salac;
        $user=$userc;
        
        $html="";
        $band=0;
        foreach ($sala as $key => $value) {
            $fechaObj = new DateTime($sala[$key]['dtmensaje']);
            $dt = $fechaObj->format('D H:i');
            
            $dia = $fechaObj->format('D');
            $horas = $fechaObj->format('H');
            $minutos = $fechaObj->format('i');
            
            switch ($dia) {
                case 'Mon':
                    $diaesp='Lun';
                    break;
                case 'Tue':
                    $diaesp='Mar';
                    break;
                case 'Wed':
                    $diaesp='Mie';
                    break;
                case 'Thu':
                    $diaesp='Jue';
                    break;
                case 'Fri':
                    $diaesp='Vie';
                    break;
                case 'Sat':
                    $diaesp='Sab';
                    break;
                case 'Sun':
                    $diaesp='Dom';
                    break;
                default:
                    $diaesp='Error!';
            }

            $completo=$dia.' '.$horas.':'.$minutos;
            
            if($band ==0){
                $html .='
                    <div class="row" id="messagebox">
                        <div class="col s12 myimage">
                            <p></p>
                            <img src="'.$raiz.'resources/mensajes/'.$sala[$key]['texto'].'" alt="sample" class="convimage">
                        </div>
                    </div>
                ';
                $band=1;
            }else{
                if($sala[$key]['idtipomensaje']==1){
                    if($sala[$key]['idusuario']==$user){
                        //mensajes del mismo usuario
                        $html .='
                            <div class="row" id="messagebox">
                                <div class="chip" id="chipme">
                                    '.$sala[$key]['texto'].'<div class="time" style="text-align: right; font-size: 11px;">'.$dt.'</div>
                                </div>
                            </div>
                        ';
                    }else{
                        //mensajes de otros usuarios
                        $html .='
                            <div class="row" id="messagebox">
                                <div class="col s12">
                                    <img src="'.$raiz.'resources/users/'.$sala[$key]['imagen'].'" alt="Contact Person" class="circle responsive-image" width="50px" height="50px">
                                    <div class="chip" id="chipfriend">
                                        <b>'.$sala[$key]['nickusuario'].'</b><br/>
                                        '.$sala[$key]['texto'].'<div class="time" style="text-align: right; font-size: 11px;">'.$dt.'</div>
                                    </div>

                                </div>    
                            </div>
                        ';
                    }                          
                }elseif($sala[$key]['idtipomensaje']==2){
                    if($sala[$key]['idusuario']==$user){
                        //mensajes del mismo usuario
                        $html .='
                            <div class="row" id="messagebox">
                                <div class="col s12 myimage">
                                    <p></p>
                                    <img src="'.$raiz.'resources/mensajes/'.$sala[$key]['texto'].'" alt="sample" class="convimage">
                                    <div class="time" style="text-align: right; font-size: 11px;">'.$dt.'</div>
                                </div>
                            </div>
                        ';
                    }else{
                        //mensajes de otros usuarios
                        $html .='
                            <div class="row" id="messagebox">
                                <div class="col s12 divimage">
                                    <p><b>'.$sala[$key]['nickusuario'].'</b></p>
                                    <img src="'.$raiz.'resources/mensajes/'.$sala[$key]['texto'].'" alt="sample" class="convimage">
                                    <div class="time" style="text-align: right; font-size: 11px;">'.$dt.'</div>
                                </div>
                            </div>
                        ';
                    }
                }
            }                           
        }
        $html.='<br/><br/>';
        //$result['html']=$html;
        return $html;
    }
    
}
