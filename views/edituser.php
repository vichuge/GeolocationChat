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
    .collection.with-header .collection-item {
        padding-left: 0px;
    }
    a{
        color: #ffffff;
    }
    img{
        width: auto;
        height: 150px;
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
                      <h5 class="task-card-title"><a href="<?php echo $raiz?>home"><i class="mdi-navigation-arrow-back"></i></a>Editar usuario</h5>
                    </li>
                    <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <div class="row margin">
                            <div class="input-field col s12">
                                <input placeholder="Pon tu nombre aqui..." name="nombreusuario" id="first_name" type="text" class="validate" required value="<?php echo $nomusuario ?>">
                                <label for="first_name" class="active">Nombre de usuario</label>
                            </div>
                            </div>
                        <div class="row">
                            <div class="input-field col s12" id="btnchangename">
                                <a class="btn waves-effect waves-light" onclick="changename();" >
                                    <!--<i class="mdi-navigation-check left"></i>-->
                                    Cambiar nombre
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="collection-item dismissable" style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">      
                            
                        <div class="row">
                            <div class="col s12">
                                <img src="<?php echo $raiz.'resources/users/'.$imagen ?>" alt="sample" class="circle convimage">
                            </div>
                        </div>
                        
                        <form class="login-form" method="POST" action="<?php echo $raiz?>editimage" enctype="multipart/form-data">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Subir</span>
                                    <input type="file" name="archivos" required>
                                </div>
                                
                                <div class="file-path-wrapper">
                                    <input class="file-path validate valid" type="text" name="nameimage" required>
                                </div>                                  
                            </div>
                            
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light col s12" type="submit">Cambiar imagen</button>
                                </div>
                            </div>
                        </form>
                    </li>
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
        
        function changename(){
            var name=$('#first_name').val();
            var uri=<?php echo $raiz ?>;
            $.ajax({
                type: "POST",
                url : uri + "editname",
                data : {newname: name},
                cache: false,
                beforeSend: function(){
                    $("#btnchangename").html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/loading.gif"></center>');
                    //$("#btnchangename").html('<button class="btn waves-effect waves-light col s12" id="btnchangename" type="button" onclick="changename();" >Cambiar Nombre</button>');
                },
                success: function()
                {
                    $("#btnchangename").html('');
                    $("#btnchangename").html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/ready.gif"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#btnchangename").html('');
                        $("#btnchangename").html('<a id="btnchangename" class="btn waves-effect waves-light" onclick="changename();" >Cambiar nombre</a>');
                    }, 1500);
                },
                error: function ()
                {
                    $("#btnchangename").html('');
                    $("#btnchangename").html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/x.png"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#btnchangename").html('');
                        $("#btnchangename").html('<a id="btnchangename" class="btn waves-effect waves-light" onclick="changename();" >Cambiar nombre</a>');
                    }, 1500);
                }
            });
        }
        
    </script>
</body>
</html>