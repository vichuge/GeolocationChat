<?php
include_once('candado.php');
?>

<?php
include_once('head.php');
?>

<style>
    label {
    font-size: 1rem;
    color: #9e9e9e;
    }
    #date {
    float: right;
    color: #ff4081;
    }
    /*.sidebar-collapse {
    position: absolute;
    left: -170px;
    top: 30px;
    }*/
</style>
</head>
<body>

    <?php
    //include_once('header.php');
    ?>

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <?php
            //include_once('navbar.php');
            ?>
            <!-- START CONTENT -->
            <section id="content">
                <ul id="task-card" class="collection with-header">
                    <li class="collection-header cyan">
                      <h5 class="task-card-title">Hola <?php echo $this->session->nickusuario ?></h5>
                    </li>
                    
                    <!--<li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <div class="row" align="center">
                            <div class="col s12">
                                <div class="chip blue white-text">
                                    Salas generales
                                </div>                      
                            </div>    
                        </div>

                        <div class="row" align="center">
                            <div class="col s12">                       
                                <div class="chip green white-text">
                                    Inbox
                                </div>
                            </div>    
                        </div>
                        
                        <div class="row" align="center">
                            <div class="col s12">
                                <div class="chip red white-text">
                                    Solicitudes de Inbox
                                </div>                      
                            </div>    
                        </div>
                    </li>-->
                    <br/>
                    <h5 align="center">Salas disponibles</h5> 
                    <br/>
                    <div class="divider"></div>
                    
                    <div class="row" id="listsalas" >
                    <?php echo $html ?>
                    <?php
                    /*if($salas != ""){
                        foreach ($salas as $key => $value) {
                            $fechaObj = new DateTime($salas[$key]["dtsala"]);
                            $fechaMod = $fechaObj->format('D d M y');
                            $bandera=0;
                            
                            //checar el nombre de la sala
                            if($salas[$key]['idinvitado'] != "general"){
                                if($salas[$key]['idinvitado']==$this->session->idusuario){
                                    $nomsala=$salas[$key]["creador"];
                                }else{
                                    $nomsala=$salas[$key]["invitado"];
                                }
                                
                            }else{
                                $nomsala=$salas[$key]["nomsala"];        
                            }
                            
                            if($salas[$key]['estatus']!='null'){
                                if($salas[$key]['estatus']==1){
                                    echo '                                
                                        <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            <a href="chat/'.$salas[$key]["idsala"].'">
                                            <label for="task1" style="text-decoration: none;">'.$nomsala.'
                                                <span class="ultra-small" id="date">'.$fechaMod.'</span>
                                            </label>';
                                            switch ($salas[$key]['tipo']) {
                                                case "general":
                                                    echo '<span class="task-cat blue">'.$salas[$key]["nickusuario"].'</span>';
                                                    break;
                                                case "privada":
                                                    if($salas[$key]['estatus']==1){
                                                        echo '<span class="task-cat green">Inbox</span>';
                                                    }
                                                    break;
                                                default:
                                                    echo '<span class="task-cat black">'.$salas[$key]["nickusuario"].'</span>';
                                                    break;
                                            }

                                        echo '</a></li>
                                    
                                    <div class="divider"></div>
                                    ';
                                }else{
                                }   
                                
                            }else{
                                if($salas[$key]['idusuariocreador']!=$this->session->idusuario){
                                    if($bandera==0){
                                        echo '<br/><br/><br/><h5 align="center" >Solicitudes pendientes</h5><div class="divider"></div>';
                                        $bandera=1;
                                    }
                                    echo'
                                        <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            <div class="row">
                                                <div class="col s4">
                                                    <img src="'.$raiz.'resources/users/'.$salas[$key]['imagen'].'" height="100%" width="100%" alt="Contact Person" class="circle responsive-image">
                                                </div>
                                                <div class="col s6">
                                                    <label for="task1" style="text-decoration: none;">'.$salas[$key]['nickusuario'].'</label>
                                                    <span class="task-cat red">Inbox</span>
                                                </div>
                                                <div class="col s2">
                                                    <a id="send" href="yes/'.$salas[$key]['idsala'].'" class="btn-floating waves-effect waves-light green"><i class="mdi-navigation-check"></i></a>
                                                    <a id="send" href="no/'.$salas[$key]['idsala'].'" class="btn-floating waves-effect waves-light red"><i class="mdi-navigation-close"></i></a>
                                                </div>
                                            </div>    
                                        </li>
                                        <div class="divider"></div>
                                    ';
                                }else{
                                    echo '                                
                                        <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            <a href="chat/'.$salas[$key]["idsala"].'">
                                                <label for="task1" style="text-decoration: none;">'.$nomsala.'
                                                    <span class="ultra-small" id="date">'.$fechaMod.'</span>
                                                </label>                                           
                                                <span class="task-cat green">Inbox</span>
                                            </a>
                                        </li>
                                    <div class="divider"></div>
                                    ';
                                }
                                
                            } 
                        }
                    }else{
                        echo '  
                            <div class="row" align="center">
                                <div class="col s12">
                                    <p>No hay salas disponibles...</p><br/>
                                    <a class="btn btn-warning-confirm waves-effect waves-light" href="'.$raiz.'newroom">Crear una</a>
                                </div>
                            </div>
                        ';
                    }
                    */
                    ?>
                        </div>
                    <!--<h5 align="center" >Solicitudes de inbox pendientes</h5>-->
                        <!--<li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                            <div class="row">
                                <div class="col s6">
                                    <label for="task1" style="text-decoration: none;">Juanito</label>
                                    <span class="task-cat red">Inbox</span>
                                </div>
                                <div class="col s6">
                                    <a id="send" class="btn-floating waves-effect waves-light green"><i class="mdi-navigation-check"></i></a>
                                    <a id="send" class="btn-floating waves-effect waves-light red"><i class="mdi-navigation-close"></i></a>
                                </div>
                            </div>    
                        </li>
                    <div class="divider"></div>-->
                    <!--<li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                      <label for="task2" style="text-decoration: none;">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                      </label>
                      <span class="task-cat purple">Web API</span>
                    </li>
                    <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                      <label for="task3" style="text-decoration: none;">Check the new Mockup of ABC. <a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                      </label>
                      <span class="task-cat pink">Mockup</span>
                    </li>
                    <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                      <label for="task4" style="text-decoration: none;">I did it !</label>
                      <span class="task-cat cyan">Mobile App</span>
                    </li>-->
                </ul>
            </section>
            <!-- END CONTENT -->
        </div>
        <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <?php
        include_once('scripts.php');
    ?>
    
    <?php
        include_once('floatbtn.php');
    ?>
    
    <script type="text/javascript">
        
        $( document ).ready(function() {
            //console.log('document.ready');
            //prueba de distancia
            //$point1 = array("lat" => "48.8666667", "long" => "2.3333333"); // París (Francia)
            //$point2 = array("lat" => "19.4341667", "long" => "-99.1386111"); // Ciudad de México (México)
            loadPosition();
        });
        
        var change='';
        function loadLog(lat,lon){
            //console.log('loadLog');
            //var demo='<li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><a href="chat/19"><label for="task1" style="text-decoration: none;">La sala de pepe<span class="ultra-small" id="date">Tue 17 Jul 18</span></label></a></li><div class="divider"></div>                                <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><a href="chat/21"><label for="task1" style="text-decoration: none;">Pedro infante<span class="ultra-small" id="date">Tue 17 Jul 18</span></label></a></li><div class="divider"></div>                                <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><a href="chat/20"><label for="task1" style="text-decoration: none;">Victorcini<span class="ultra-small" id="date">Tue 17 Jul 18</span></label><span class="task-cat green">Inbox</span></a></li><div class="divider"></div>';
            var uri='<?php echo $raiz ?>';
            if(lon !="" && lat !=""){
                $.ajax({
                    url: uri+'onlysalas/',
                    cache: false,
                    type : 'POST',
                    //dataType : 'json',
                    data: {
                        longitud: lon, 
                        latitud: lat
                    },
                    success: function(data){
                        $('#listsalas').html('');
                        $('#listsalas').html(data); //Inserta el log de chat en el div #chatbox
                        //console.log('data='+data);
                        //console.log(lon+'---'+lat);
                        },
                    error: function(data){
                        console.log('error');
                    }
                }); 
            }else{
                console.log('Error, no position data');
            }
            
        }
    </script>
    
    <?php
        include_once('position.php');
    ?>
    
</body>
</html>