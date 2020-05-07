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

<style>
form p {
    text-align: center;
}
.login-form {
    width: auto;
}
element.style {
    padding-left: 10px;
}
.row{
  margin-bottom:auto;
}
.input-field {
    margin-top: 0;
}
</style>

</head>

<body class="cyan">

  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel" style="padding-left: 1px;">
        <div class="row">
          <div class="input-field col s12 center">
            <br/>
            <img src="<?php echo $raiz.'resources/materialized/' ?>images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login">
            <p class="center login-form-text">Haz sido bloqueado, contacta al administrador.</p>
          </div>
        </div>
    </div>
  </div>

  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="<?php echo $raiz.'resources/materialized/' ?>js/plugins/jquery-1.11.2.min.js"></script>

  <!--angularjs-->
    <script type="text/javascript" src="<?php echo $raiz.'resources/materialized/' ?>js/plugins/angular.min.js"></script>

  <!--materialize js-->
  <script type="text/javascript" src="<?php echo $raiz.'resources/materialized/' ?>js/materialize.min.js"></script>
  <!--prism-->
  <script type="text/javascript" src="<?php echo $raiz.'resources/materialized/' ?>js/plugins/prism/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="<?php echo $raiz.'resources/materialized/' ?>js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!--sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="<?php echo $raiz.'resources/materialized/' ?>js/plugins.min.js"></script>
  <!--custom-script.js - Add your own theme custom JS-->
  <script type="text/javascript" src="<?php echo $raiz.'resources/materialized/' ?>js/custom-script.js"></script>
  
  <div class="fixed-action-btn click-to-toggle">
    <a href="<?php echo $raiz ?>" class="btn-floating btn-large" id="floatbtn">
        <i class="mdi-navigation-arrow-back"></i>
    </a>
  </div>
  
</body>

</html>