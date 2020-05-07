<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class ImagenController extends CI_Controller {

    var $INDEX;

    public function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
        $this->load->helper('string');
        $this->load->model('Model_login');
        $this->load->model('Model_salas');
        $this->load->model('Model_imagen');
        $this->load->model('Model_chat');
        //$this->load->library('session');
        }
        
        public function index(){
            $result['raiz'] = $this->INDEX;
	}
        
        public function editarimagen() {
            $result['raiz'] = $this->INDEX;
            //if ($_FILES["archivos"]['name'] != "") {
            if (isset($_FILES["archivos"]['name'])) {
                $tamano = $_FILES["archivos"]['size'];
                $tipo = $_FILES["archivos"]['type'];
                $archivo = $_FILES["archivos"]['name'];
                $espacios = false;
                $acentos=false;
                $enie=false;
                $especiales=false;
                $cont = 0;
                $nombrerandom = random_string('alnum', 8);

                /*while (!$espacios && ($cont < strlen($archivo))) {
                    if (substr($archivo, $cont, 1) == " " or substr($archivo, $cont, 1) == "´") {
                        $espacios = true;
                    }
                    if (substr($archivo, $cont, 1) == "á" or substr($archivo, $cont, 1) == "é" or substr($archivo, $cont, 1) == "í" or substr($archivo, $cont, 1) == "ó" or substr($archivo, $cont, 1) == "ú" ) {
                        $acentos = true;
                    }
                    if (substr($archivo, $cont, 1) == "ñ"){
                        $enie=true;
                    }
                    if (substr($archivo, $cont, 1) == "|" || 
                        substr($archivo, $cont, 1) == "°" || substr($archivo, $cont, 1) == "¬" || substr($archivo, $cont, 1) == "<" ||                                              
                        substr($archivo, $cont, 1) == ">" || substr($archivo, $cont, 1) == "!" || substr($archivo, $cont, 1) == "#" ||                                    
                        substr($archivo, $cont, 1) == "$" || substr($archivo, $cont, 1) == "%" || substr($archivo, $cont, 1) == "&" ||                                              
                        substr($archivo, $cont, 1) == "/" || substr($archivo, $cont, 1) == "(" || substr($archivo, $cont, 1) == ")" ||                         
                        substr($archivo, $cont, 1) == "=" || substr($archivo, $cont, 1) == "¡" || substr($archivo, $cont, 1) == "¿" ||
                        substr($archivo, $cont, 1) == "'" || substr($archivo, $cont, 1) == "?" || substr($archivo, $cont, 1) == "´" ||
                        substr($archivo, $cont, 1) == "+" || substr($archivo, $cont, 1) == "*" || substr($archivo, $cont, 1) == "~" ||
                        substr($archivo, $cont, 1) == "{" || substr($archivo, $cont, 1) == "[" || substr($archivo, $cont, 1) == "^" ||
                        substr($archivo, $cont, 1) == "}" || substr($archivo, $cont, 1) == "]" || substr($archivo, $cont, 1) == "`" ||
                        substr($archivo, $cont, 1) == "," || substr($archivo, $cont, 1) == ";" || substr($archivo, $cont, 1) == "." ||
                        substr($archivo, $cont, 1) == ":" || substr($archivo, $cont, 1) == "-" || substr($archivo, $cont, 1) == "_" ||
                        substr($archivo, $cont, 1) == ":") 
                        {
                            $especiales=true;
                        }
                    $cont++;
                }*/

                $prefijo = substr(md5(uniqid(rand())), 0, 6);

                if ($archivo != "") {

                    /*if ($espacios == True) {
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene espacios, por favor, verifiquelo e inténtelo de nuevo');
                    } elseif($acentos== True){
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene acentos en alguna letra, por favor, verifiquelo e inténtelo de nuevo');
                    } elseif($enie== True){
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene la letra ñ, por favor, verifiquelo e inténtelo de nuevo');
                    } elseif($especiales== True){
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene caracteres especiales (|°¬!"#$%&/()=?\¿¡´¨+*~{[^}]`,;.:-_), por favor, verifiquelo e inténtelo de nuevo');
                    }  
                    else 
                        {*/
                        $sep = explode('image/', $tipo); // Separamos image/ 
                        $tipo2 = $sep[1];

                        if ($tipo2 == "jpeg" || $tipo2 == "jpg" || $tipo2 == "png") 
                        {
                            //$carpetacreada = $this->session->userdata('cUsuarioPrimerNombre') . $this->session->userdata('cUsuarioPrimerApellido') . '_' . $this->session->userdata('iUsuarioId');
                            $destino = "resources/users/";
                            //$fichero_subido = $destino . basename($_FILES['archivos']['name']); //supongo aqui va el nombre del archivo (antes)
                            $nombrecompleto=$nombrerandom.".".$tipo2;
                            $fichero_subido = $destino . basename($nombrerandom.".".$tipo2);
                            if (move_uploaded_file($_FILES['archivos']['tmp_name'], $fichero_subido)){
                                
                                //eliminar la foto anterior
                                $nameimagen=$this->session->imagen;
                                if($nameimagen != 'no_user.png' && $nameimagen != 'female.jpg' && $nameimagen != 'male.jpg'){
                                   unlink("resources/users/".$this->session->imagen);
                                }
                                $keys = array('imagen');
                                $this->session->unset_userdata($keys);
                                $keys=array('imagen' => $nombrecompleto);
                                $this->session->set_userdata($keys);
                                $idusuario=$this->session->idusuario;
                                $this->Model_imagen->cambioNombre($nombrecompleto,$idusuario);
                                $this->load->view('upimg',$result);                                                            
                            } 
                            else 
                                {
                                print_r('<h5>Ocurrió un error al intentar subir la imagen, inténtelo de nuevo</h5>');
                                $this->load->view('edit',$result);
                                }
                        } 
                        else
                        {
                            print_r('<h5>Verifique la extensión de su imagen (debe ser .jpeg , .jpg o .png )e inténtelo de nuevo</h5>');
                            $this->load->view('edit',$result);
                        }     
                    //}
                }
                else {
                    print_r('<h5>Ocurrió un error al intentar subir la imagen, inténtelo de nuevo</h5>');
                    $this->load->view('edit',$result);
                }
                //$_FILES["archivos"]['name']="";
            } else {
            }
        }
        
        public function subirimagen() {
            $result['raiz'] = $this->INDEX;
            $idsala=$this->input->post('idsala');
            //if ($_FILES["archivos"]['name'] != "") {
            if (isset($_FILES["archivos"]['name'])) {
                $tamano = $_FILES["archivos"]['size'];
                $tipo = $_FILES["archivos"]['type'];
                $archivo = $_FILES["archivos"]['name'];
                $espacios = false;
                $acentos=false;
                $enie=false;
                $especiales=false;
                $cont = 0;
                $nombrerandom = random_string('alnum', 8);

                while (!$espacios && ($cont < strlen($archivo))) {
                    if (substr($archivo, $cont, 1) == " " or substr($archivo, $cont, 1) == "´") {
                        $espacios = true;
                    }
                    if (substr($archivo, $cont, 1) == "á" or substr($archivo, $cont, 1) == "é" or substr($archivo, $cont, 1) == "í" or substr($archivo, $cont, 1) == "ó" or substr($archivo, $cont, 1) == "ú" ) {
                        $acentos = true;
                    }
                    if (substr($archivo, $cont, 1) == "ñ"){
                        $enie=true;
                    }
                    if (substr($archivo, $cont, 1) == "|" || 
                        substr($archivo, $cont, 1) == "°" || substr($archivo, $cont, 1) == "¬" || substr($archivo, $cont, 1) == "<" ||                                              
                        substr($archivo, $cont, 1) == ">" || substr($archivo, $cont, 1) == "!" || substr($archivo, $cont, 1) == "#" ||                                    
                        substr($archivo, $cont, 1) == "$" || substr($archivo, $cont, 1) == "%" || substr($archivo, $cont, 1) == "&" ||                                              
                        substr($archivo, $cont, 1) == "/" || substr($archivo, $cont, 1) == "(" || substr($archivo, $cont, 1) == ")" ||                         
                        substr($archivo, $cont, 1) == "=" || substr($archivo, $cont, 1) == "¡" || substr($archivo, $cont, 1) == "¿" ||
                        substr($archivo, $cont, 1) == "'" || substr($archivo, $cont, 1) == "?" || substr($archivo, $cont, 1) == "´" ||
                        substr($archivo, $cont, 1) == "+" || substr($archivo, $cont, 1) == "*" || substr($archivo, $cont, 1) == "~" ||
                        substr($archivo, $cont, 1) == "{" || substr($archivo, $cont, 1) == "[" || substr($archivo, $cont, 1) == "^" ||
                        substr($archivo, $cont, 1) == "}" || substr($archivo, $cont, 1) == "]" || substr($archivo, $cont, 1) == "`" ||
                        substr($archivo, $cont, 1) == "," || substr($archivo, $cont, 1) == ";" || substr($archivo, $cont, 1) == "." ||
                        substr($archivo, $cont, 1) == ":" || substr($archivo, $cont, 1) == "-" || substr($archivo, $cont, 1) == "_" ||
                        substr($archivo, $cont, 1) == ":") 
                        {
                            $especiales=true;
                        }
                    $cont++;
                }

                $prefijo = substr(md5(uniqid(rand())), 0, 6);

                if ($archivo != "") {

                    /*if ($espacios == True) {
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene espacios, por favor, verifiquelo e inténtelo de nuevo');
                    } elseif($acentos== True){
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene acentos en alguna letra, por favor, verifiquelo e inténtelo de nuevo');
                    } elseif($enie== True){
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene la letra ñ, por favor, verifiquelo e inténtelo de nuevo');
                    } elseif($especiales== True){
                        $this->cargar_imagenes($avs = 'el nombre de su imagen seguramente tiene caracteres especiales (|°¬!"#$%&/()=?\¿¡´¨+*~{[^}]`,;.:-_), por favor, verifiquelo e inténtelo de nuevo');
                    }  
                    else 
                        {*/
                        $sep = explode('image/', $tipo); // Separamos image/ 
                        $tipo2 = $sep[1];

                        if ($tipo2 == "jpeg" || $tipo2 == "jpg" || $tipo2 == "png") 
                        {
                            //$carpetacreada = $this->session->userdata('cUsuarioPrimerNombre') . $this->session->userdata('cUsuarioPrimerApellido') . '_' . $this->session->userdata('iUsuarioId');
                            $destino = "resources/mensajes/";
                            //$fichero_subido = $destino . basename($_FILES['archivos']['name']); //supongo aqui va el nombre del archivo (antes)
                            $nombrecompleto=$nombrerandom.".".$tipo2;
                            $fichero_subido = $destino . basename($nombrerandom.".".$tipo2);
                            if (move_uploaded_file($_FILES['archivos']['tmp_name'], $fichero_subido)){
                                
                                $idusuario=$this->session->idusuario;
                                $this->Model_chat->insert_mensaje($idsala,$idusuario,2,$nombrecompleto);
                                $result['idsala']=$idsala;
                                $this->load->view('enterchat',$result);                                                           
                            } 
                            else 
                                {
                                print_r('<h5>Ocurrió un error al intentar subir la imagen, inténtelo de nuevo</h5>');
                                //$this->load->view('edit',$result);
                                }
                        } 
                        else
                        {
                            print_r('<h5>Verifique la extensión de su imagen (debe ser .jpeg , .jpg o .png )e inténtelo de nuevo</h5>');
                            //$this->load->view('edit',$result);
                        }     
                    //}
                }
                else {
                    print_r('<h5>Ocurrió un error al intentar subir la imagen, inténtelo de nuevo</h5>');
                    //$this->load->view('edit',$result);
                }
                //$_FILES["archivos"]['name']="";
            } else {
            }
        }

}
