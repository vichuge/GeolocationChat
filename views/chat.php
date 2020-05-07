<?php
include_once('candado.php');
?>

<?php
include_once('head.php');
?>

<style>
    body {
        background-color: #ffffff;
    }
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
    .chip {
        height: auto;
        line-height: 20px;
        font-weight: 400;
        padding: 6px 12px;
    }
    .chip .time{
        line-height: 15px;
    }
    #me{
        margin-left: 35px;
        float:right;
        /*position: absolute;
        right: 0;*/
    }

    #chipme{
        background-color: #ff5a92;
        color: #ffffff;
        margin-left: 65px;
        float:right;
    }

    #chipfriend{
        background-color: #e4e4e4;
        max-width: 157px;
    }
    img{
        bottom:0;
    }
    #type{
        position: fixed;
    }

    .fixed-action-btn{
        background-color: #00bcd4;
        right: 0px;
        bottom: 0px;
        padding-top: 6px;
        width:100%;
        color: #ffffff;
    }
    #typerow{
        margin-bottom: 0px;
    }
    #inputype{
        margin: 0 0 0 0;
        max-width: 64%;
    }

    ::placeholder {
    color: white;
    opacity: 1; /* Firefox */
    }

    .collection.with-header .collection-header {
    border-bottom: 0px solid #e0e0e0;
    }

    a i{
        color:#ffffff;
    }

    #task-card{
        position: fixed;
        min-width: 100%;
    }

    ul li a{
        color:#ffffff;
    }

    #task-card .collection-header {
    padding: 5px;
    }

    .convimage {
    width: 100%;
    height: auto;
    border-radius: 20px;
    }

    .divimage{
        background-color: #e4e4e4;
        border-radius: 20px;
    }

    .myimage{
        /*background-color: #ff5a92;
        border-radius: 20px;
        color: #ffffff;*/
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
                        <h5 class="task-card-title"><a id="btnleave" href="<?php echo $raiz?>home"><i class="mdi-navigation-arrow-back"></i></a><?php echo $sala[0]['nomsala']; ?> <!--<a href="<?php echo $raiz?>friends/<?php echo $sala[0]['idsala']; ?>" class="btn-floating btn-flat waves-effect waves-light pink accent-2 white-text"><i class="mdi-social-people"></i></a>--></h5>
                    </li>
                </ul>
                <br/><br/><br/>
                
                <div id="msgbox">
                <?php
                    echo $html;
                ?>
                </div>

            </section>
            <!-- END CONTENT -->
        </div>
        <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->

    <!-- Boton prueba-->
    <!-- Boton prueba-->
    <div class="fixed-action-btn" id="escribirmensaje">
        <div class="row" id="typerow">
            <div class="col s12" id="typecol">
                <input placeholder="Escribe aqui..." id="inputype" type="text" required>
                <a id="media" onclick="formimage()" class="btn-floating waves-effect waves-light "><i class="mdi-editor-attach-file"></i></a>
                <a id="send" class="btn-floating waves-effect waves-light "><i class="mdi-content-send"></i></a>
                <form class="login-form" method="POST" action="<?php echo $raiz?>imageconversation" enctype="multipart/form-data" style="display:none;" id="form">
                    <input type="hidden" value="<?php echo $sala[0]['idsala']; ?>" name="idsala">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Elegir</span>
                            <input type="file" name="archivos" required>
                        </div>
                                
                        <div class="file-path-wrapper">
                            <input class="file-path validate valid" type="text" name="nameimage" required>
                        </div>                                  
                    </div>
                            
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light col s12" type="submit">Subir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once('scripts.php');
    ?>

    <script type="text/javascript">
        $( document ).ready(function() {
            var lon="";
            var lat="";
            //prueba de distancia
            //$point1 = array("lat" => "48.8666667", "long" => "2.3333333"); // París (Francia)
            //$point2 = array("lat" => "19.4341667", "long" => "-99.1386111"); // Ciudad de México (México)
            loadPosition();
        });
        
        $(window).load(function() {
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        });

        $('#media').click(function(){
            //console.log("proximamente!");
        });

        $('#send').click(function(){
            var uri=<?php echo $raiz ?>;
            var text=$('#inputype').val();
            var section = document.getElementsByTagName('section');
            if(text != ""){
            //console.log(text);
            //console.log("sendy!");
            
            //ejemplo
            var address=uri+'addtext';
            $.post(address, {
                idsala: '<?php echo $sala[0]['idsala'] ?>',
                idusuario: '<?php echo $this->session->idusuario ?>',
                idtipomensaje:'1',
                texto:text
            });
            $('#inputype').val('');
            //termina ejemplo
        
            }else{
                //console.log ("is empty!");
                Materialize.toast('Escribe algo primero...', 800, 'rounded');
            }
        });
        
        var bandelog=0;
        var change='';
        
        function loadLog(){
            if(bandelog===0){
                setInterval(loadLog2, 1000);
                bandera=1;
            } 
        }
        
        function loadLog2(){
            //console.log('loadLog2');
            var uri='<?php echo $raiz ?>';
            if(lon !=="" && lon !== 'undefined' && lat !=="" && lat !== 'undefined'){
                var idsala='<?php echo $idsala ?>';
                $.ajax({
                    url: uri+'only/'+idsala,
                    cache: false,
                    type : 'POST',
                    //dataType : 'json',
                    data: {
                        longitud: lon, 
                        latitud: lat
                    },
                    success: function(data){
                        if(data==='1'){
                            //clearInterval(interval);
                            $('#msgbox').html('');
                            $('#escribirmensaje').html('');
                            $('#msgbox').html('<h5>Chat fuera de rango!!</h5>');
                            //header('Location:'+uri+'salirchat');
                            //$('#btnleave').click();
                            window.location=uri+'salirchat';
                        }else{
                            if(change!=data){
                            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
                            console.log('down');
                            }
                            $('#msgbox').html('');
                            $('#msgbox').html(data); //Inserta el log de chat en el div #chatbox
                            //console.log('change conv');
                            change=data;
                        }
                    },
                    error: function(){
                        console.log('error');
                    }
                });
            }else{
                console.log('Error, no position data');
            }
            bandelog=1;
        }
        
        function formimage() {
            var x = document.getElementById("form");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>
    <?php
    include_once('position.php');
    ?>
    <!--<footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                <span>Copyright © 2018 <a class="grey-text text-lighten-4" href="http://www.educacion.yucatan.gob.mx/" target="_blank">CCCCCCCCC</a></span>
            </div>
        </div>
    </footer>-->
</body>
</html>