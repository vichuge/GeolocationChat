<?php
/*$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "rol1" && $nomrol !="rol2") { //esta línea ira dependiendo quienes se desea que puedan entrar al script.
    header('Location: ' . $raiz . '');
}*/
?>

<?php
include_once('head.php');
?>
</head>
<body>

    <?php
    include_once('header.php');
    ?>

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <?php
            include_once('navbar.php');
            ?>
            <!-- START CONTENT -->
            <section id="content">
                <!-- Aqui va el código-->
                <div class="row">
                    <div class="col s12">
                        <h1>Hola mundo, página en blanco</h1>
                    </div>
                    <div class="col s12">

                    </div>
                </div>
            </section>
            <!-- END CONTENT -->
        </div>
        <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <?php
    include_once('scripts.php');
    ?>
</body>
</html>