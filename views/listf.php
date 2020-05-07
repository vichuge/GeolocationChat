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
    ul li a{
        color:#ffffff;
    }
    h5 {
    font-size: 1.58rem;
    }
    
    .avatar {
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 100px;
    width: 100px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    background-size: 100% auto;
    }
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
                        <h5 class="task-card-title"><a href="<?php echo $raiz?>home"><i class="mdi-navigation-arrow-back"></i></a>Usuarios conectados</h5>
                    </li>
                </ul>
                <br/> 
                
                <div class="row" align="center">
                    <div class="col s12">
                        <div class="chip blue white-text">
                            <i class="mdi-communication-messenger"></i>
                            Ir a inbox
                        </div>                      
                    </div>    
                </div>
                
                <div class="row" align="center">
                    <div class="col s12">                       
                        <div class="chip red white-text">
                            <i class="mdi-communication-dnd-on"></i>
                            Bloquear inbox
                        </div>
                    </div>    
                </div>
                
                <div class="row" align="center">
                    <div class="col s12">                       
                        <div class="chip green white-text">
                            <i class="mdi-navigation-check"></i>
                            Aceptar inbox
                        </div>
                    </div>    
                </div>
                
                <!--<div class="row" align="center">
                    <div class="col s12">                       
                        <div class="chip green white-text">
                            <i class="mdi-navigation-check"></i>
                            Admitir inbox
                        </div>
                    </div>    
                </div>-->
                
                <div id="listfriends">
                <?php
                echo $html;
                /*
                    if($usuarios !=0){
                        $acomodador=0;
                        $contador=0;
                        foreach ($usuarios as $key => $value) {
                        //if($usuarios[$key]['idusuario'] != $this->session->idusuario){
                            $contador++;
                            if($acomodador==0){
                                echo'<div class="row" align="center">';
                            }
                            echo'
                                <form class="login-form" method="POST" action="'.$raiz.'inbox/'.$usuarios[$key]['idusuario'].'">
                                    <input type="hidden" value="'.$usuarios[$key]['nickusuario'].'" name="invitado">
                                    <input type="hidden" value="'.$usuarios[$key]['idusuario'].'" name="idinvitado">
                                    <input type="hidden" value="'.$this->session->nickusuario.'" name="creador">
                                    <input type="hidden" value="'.$this->session->idusuario.'" name="idcreador">
                                    <div class="col s6">
                                        <img src="'.$raiz.'resources/users/'.$usuarios[$key]['imagen'].'" height="100%" width="100%" alt="Contact Person" class="circle responsive-image">
                                        <p>'.$usuarios[$key]['nickusuario'].'</p>
                                        <div id="changer'.$contador.'">';
                                            if(isset($usuarios[$key]['estatus'])){
                                                if($usuarios[$key]['idcreador']!=$this->session->idusuario){
                                                    //Cuando entras de invitado
                                                    if($usuarios[$key]['estatus']=='na'){
                                                        //Invitado y aún no te decides
                                                        echo '
                                                        <button class="btn-floating waves-effect waves-light green" type="submit" ><i class="mdi-navigation-check"></i></button>
                                                        <button class="btn-floating waves-effect waves-light red" type="submit" ><i class="mdi-navigation-close"></i></button>
                                                        ';

                                                    }elseif($usuarios[$key]['estatus']==1){
                                                        //Invitado y aceptaste
                                                        echo '
                                                            <button class="btn-floating waves-effect waves-light red" type="submit" ><i class="mdi-navigation-close"></i></button>
                                                            <button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button>
                                                            
                                                        ';
                                                    }elseif($usuarios[$key]['estatus']==0){
                                                        //Invitado y rechazaste
                                                        echo '
                                                            <button class="btn-floating waves-effect waves-light green" type="submit" ><i class="mdi-navigation-check"></i></button>
                                                            <div class="chip gray white-text">
                                                                <i class="mdi-communication-messenger"></i>
                                                            </div>
                                                        ';
                                                    }
                                                }else{
                                                    //El mismo creador consulta si existe el inbox, en su caso aparecera vacio
                                                    echo'<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button>';
                                                }
                                                
                                            }else{
                                                echo '<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button>';
                                            }
                                            
                                             
                                        echo '</div>  
                                    </div>
                                </form>
                            ';
                            $acomodador++;
                            if($acomodador==2){
                                echo'</div>';
                                $acomodador=0;
                            }
                        //}
                        
                    }
                    if($acomodador==1){
                        echo'</div>';
                    }
                    $contador=0;
                    }else{
                        echo '<h5>Parece que no hay usuarios cerca :/</h5>';
                    }
                    
                  */  
                ?>
                </div>
                <br/><br/><br/><br/>
                
                
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
            //prueba de distancia
            //$point1 = array("lat" => "48.8666667", "long" => "2.3333333"); // París (Francia)
            //$point2 = array("lat" => "19.4341667", "long" => "-99.1386111"); // Ciudad de México (México)
            loadPosition();
        });
        
        var change='';
        function loadLog(lat,lon){
            console.log('loadLog');
            //var demo='<li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><a href="chat/19"><label for="task1" style="text-decoration: none;">La sala de pepe<span class="ultra-small" id="date">Tue 17 Jul 18</span></label></a></li><div class="divider"></div>                                <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><a href="chat/21"><label for="task1" style="text-decoration: none;">Pedro infante<span class="ultra-small" id="date">Tue 17 Jul 18</span></label></a></li><div class="divider"></div>                                <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><a href="chat/20"><label for="task1" style="text-decoration: none;">Victorcini<span class="ultra-small" id="date">Tue 17 Jul 18</span></label><span class="task-cat green">Inbox</span></a></li><div class="divider"></div>';
            var uri='<?php echo $raiz ?>';
            if(lon !="" && lat !=""){
                $.ajax({
                    url: uri+'onlyfriends/',
                    cache: false,
                    type : 'POST',
                    //dataType : 'json',
                    data: {
                        longitud: lon, 
                        latitud: lat
                    },
                    success: function(data){
                        $('#listfriends').html('');
                        $('#listfriends').html(data); //Inserta el log de chat en el div #chatbox
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
        
        /*function block(id,contador,estatus){
            var idother=id;
            var uri=<?php echo $raiz ?>;
            $.ajax({
                type: "POST",
                url : uri + "blockuser",
                data : {idusuafectado: idother},
                cache: false,
                beforeSend: function(){
                    $("#changer"+contador).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/loading.gif"></center>');
                    //$("#btnchangename").html('<button class="btn waves-effect waves-light col s12" id="btnchangename" type="button" onclick="changename();" >Cambiar Nombre</button>');
                },
                success: function()
                {
                    $("#changer"+contador).html('');
                    $("#changer"+contador).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/ready.gif"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#changer"+contador).html('');
                        if(estatus==0){
                            $("#changer"+contador).html('<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button><button type="button" onclick="block('+<?php echo $usuarios[$key]["idusuario"] ?>+','+contador+',1);" class="btn-floating waves-effect waves-light green"><i class="mdi-navigation-check"></i></button>');
                        }else if (estatus==1){
                            $("#changer"+contador).html('<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button><button type="button" onclick="block('+<?php echo $usuarios[$key]["idusuario"] ?>+','+contador+',0);" class="btn-floating waves-effect waves-light red"><i class="mdi-communication-dnd-on"></i></button>');
                        }

                    }, 1500);
                },
                error: function ()
                {
                    $("#changer"+contador).html('');
                    $("#changer"+contador).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/x.png"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#changer"+contador).html('');
                        if(estatus==0){
                            $("#changer"+contador).html('<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button><button type="button" onclick="block('+<?php echo $usuarios[$key]["idusuario"] ?>+','+contador+',0);" class="btn-floating waves-effect waves-light red"><i class="mdi-communication-dnd-on"></i></button>');
                        }else if (estatus==1){
                            $("#changer"+contador).html('<button class="btn-floating waves-effect waves-light blue" type="submit" ><i class="mdi-communication-messenger"></i></button><button type="button" onclick="block('+<?php echo $usuarios[$key]["idusuario"] ?>+','+contador+',1);" class="btn-floating waves-effect waves-light green"><i class="mdi-navigation-check"></i></button>');
                        }
                    }, 500);
                }
            });
        }*/
        
    </script>
    
    <?php
    include_once('position.php');
    ?>
    
</body>
</html>