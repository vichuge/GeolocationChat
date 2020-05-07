<?php
//ip y candado
$result['raiz'] = $this->INDEX;
$ipAddress = $_SERVER['REMOTE_ADDR'];
            if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
                $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
            }
            if($ipAddress==null || !isset($ipAddress)){
                $ipAddress="PRIVATE";
            }elseif($ipAddress=="::1"){
                $ipAddress="localhost";
            }
            $enter=$this->Model_login->login($ipAddress);
            if(isset($enter[0]['estatus'])){
                switch ($enter[0]['estatus']) {
                    case 0:
                        $keys = array('idusuario', 'nickusuario','imagen','ip');
                        $this->session->unset_userdata($keys);
                        //$this->load->view('deny',$result);
                        header('Location:'.$raiz.'deny');
                        break;
                    case 1:
                        break;
                    default:
                        //$this->load->view('error',$result);
                        header('Location:'.$raiz.'error');
                }
            }else{
                $keys = array('idusuario', 'nickusuario','imagen','ip');
                $this->session->unset_userdata($keys);
                //$this->load->view('login',$result);
                header('Location:'.$raiz);
            }
?>