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
    <div class="col s12 z-depth-4 card-panel" style="
    padding-left: 1px;
">
      <form class="login-form" method="POST" action="<?php echo $raiz?>home">
        <div class="row">
          <div class="input-field col s12 center">
            <br/>
            <img src="<?php echo $raiz.'resources/materialized/' ?>images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login">
            <p class="center login-form-text">Chat</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" type="text" required placeholder="Introduce tu nombre..." name="nomusuario">
            <!--<label for="username" class="center-align">Introduce tu nombre...</label>-->
          </div>
        </div>
        <!--<div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>-->
        <!--<div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
              <input type="checkbox" id="remember-me" />
              <label for="remember-me">Remember me</label>
          </div>
        </div>-->

        <!--<div class="file-field input-field">
          <div class="btn">
            <span>Subir</span>
            <input type="file" id="upimage" required name="imgusuario">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate valid" type="text" id="nameimage">
          </div>
          
        </div>


        <div class="row">
          <div class="input-field col s12">
            <div style="font-size: 13px; text-align: center">*Si no deseas subir una imagen,<br/> elige una de las nuestras</div>
            <center><button class="btn btn-warning-confirm waves-effect waves-light" type="button">Elige una imagen</button></center>
          </div>
        </div>

        <div class="row">
          <div class="col s12">
            <input type="text" id="selectimage" value="Seleccione una imagen..." readonly="true" name="nomimgusuario">
          </div>  
        </div>-->

        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light col s12" type="submit">Entrar</button>
          </div>
        </div>
        <br/>
        <!--<div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="page-register.html">Register Now!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="page-forgot-password.html">Forgot password ?</a></p>
          </div>          
        </div>-->

      </form>
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

  <script type="text/javascript">
    $(document).ready(function(){
        
        $('.btn-warning-confirm').click(function(){
          swal({
            title: "Elige tu imagen",
            icon: "<?php echo $raiz.'resources/perfiles/' ?>16.jpg",
            buttons: {
              catch: {
                text: "Male",
                value: "catch",
              },
              defeat: {
                text: "Female",
                value: "defeat",
              },
            },
          })
          .then((value) => {
            switch (value) {
           
              case "defeat":
                //swal("Pikachu fainted! You gained 500 XP!");
                select('female');
                break;
           
              case "catch":
                //swal("Gotcha!", "Pikachu was caught!", "success");
                select('male');
                break;
           
              default:
                //swal("Got away safely!");
            }
          });
        });
    });

    function select($data){
      switch($data) {
        case 'male':
          if($('#nameimage').val() == ""){
            document.getElementById("selectimage").value = "male.jpg";
            document.getElementById("upimage").removeAttribute('required');
            //console.log("male");
          } 
          break;
        case 'female':
          if($('#nameimage').val() == ""){
            document.getElementById("selectimage").value = "female.jpg";
            document.getElementById("upimage").removeAttribute('required');
            //console.log("female");
          }
          
          break;
        default:
          if($('#nameimage').val() == ""){
            document.getElementById("selectimage").value = "default.jpg";
            document.getElementById("upimage").removeAttribute('required');
            //console.log("default");
          }
      }
    }

    $('#nameimage').change(function() {
      if($('#nameimage').val() != ""){
        document.getElementById("selectimage").value =$('#nameimage').val();
        //console.log($('#nameimage').val());
      }else{
        document.getElementById("selectimage").value ='Seleccione una imagen...';
      }
      
    });
    /*$('#upimage').click(function() {
      $('#upimage').show();
      $('.btn').prop('disabled', false);
      $('#upimage').change(function() {
        var filename = $('#upimage').val();
        $('#nameimage').html(filename);
      });
      document.getElementById("selectimage").innerHTML = filename;
    });​*/

    /*
    swal({
            title: "Elige tu imagen",
            text:
                "<img onclick='select()' alt='image profile' src='<?php echo $raiz.'resources/perfiles/' ?>1.jpg' height='100' width='100'>"+
                "<img onclick='select()' alt='image profile' src='<?php echo $raiz.'resources/perfiles/' ?>6.jpg' height='100' width='100'>",
            //confirmButtonColor: '#DD6B55',
            //confirmButtonText: 'Cancelar',
            html: true
          });
    */

    /*
    swal("A wild Pikachu appeared! What do you want to do?", {
  buttons: {
    catch: {
      text: "<img onclick='select()' alt='image profile' src='<?php echo $raiz.'resources/perfiles/' ?>1.jpg' height='100' width='100'>",
      value: "catch",
      html: true,
    },
    defeat: true,
  },
})
.then((value) => {
  switch (value) {
 
    case "defeat":
      swal("Pikachu fainted! You gained 500 XP!");
      break;
 
    case "catch":
      swal("Gotcha!", "Pikachu was caught!", "success");
      break;
 
    default:
      swal("Got away safely!");
  }
});
    */
    </script>

</body>

</html>